<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\UserPacakgesFeatures;
use Symfony\Component\HttpFoundation\Response;

class CheckFeatureLimit
{





    /**
     * Handle an incoming request and verify the user's feature quota.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $featureKey
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, string $featureKey): Response
    {
        // 1. Ensure the user is authenticated via API
        $user = $request->user('api');

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Please log in to continue.'
            ], 401);
        }

        try {
            /**
             * 2. Execute quota check within a DB Transaction
             * Using lockForUpdate() prevents race conditions during concurrent requests.
             */
            return DB::transaction(function () use ($request, $next, $user, $featureKey) {

                $feature = UserPacakgesFeatures::where('user_id', $user->id)
                    ->where('active', true)
                    ->whereHas('packageFeature.feature', function ($query) use ($featureKey) {
                        $query->where('key', $featureKey);
                    })
                    ->lockForUpdate()
                    ->first();

                // 3. Validation: Check if the feature exists for this user
                if (!$feature) {
                    return response()->json([
                        'success' => false,
                        'message' => "The requested feature ({$featureKey}) is not available in your current package.",
                    ], 403);
                }

                // 4. Validation: Check if the user has remaining balance
                if ($feature->remaining_count <= 0) {
                    return response()->json([
                        'success' => false,
                        'message' => "Quota exceeded for feature: {$featureKey}. Please upgrade your plan.",
                        'remaining_count' => 0
                    ], 403);
                }

                // 5. Smart Decrement
                // Note: decrement() automatically saves the model and updates timestamps
                $feature->decrement('remaining_count');

                return $next($request);
            });
        } catch (\Throwable $e) {
            // Log the error for internal debugging while keeping the response user-friendly
            Log::error("Quota Management Error: " . $e->getMessage(), [
                'user_id' => $user->id,
                'feature' => $featureKey,
                'trace'   => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'An internal error occurred while verifying your subscription. Please try again later.'
            ], 500);
        }
    }
}
