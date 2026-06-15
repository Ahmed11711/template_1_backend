<?php

namespace App\Http\Middleware;

use App\Models\ProviderVisit;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;

class TrackProviderVisits
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        if ($response->getStatusCode() === 200) {
            try {
                $agent = new Agent();
                $visitorId = auth('api')->id();

                $providerId = $request->route('id');
                $serviceId = $request->route('service_id') ?? $request->input('service_id');

                // لو service route — جيب الـ provider_id من الـ DB
                if (!$providerId && $serviceId) {
                    $service = \App\Models\Service::find($serviceId);
                    if (!$service) return;
                    $providerId = $service->user_id; // ← غيّر لو الـ column اسمه provider_id
                }

                if (!$providerId) return;

                $alreadyVisited = ProviderVisit::where('provider_id', $providerId)
                    ->when($serviceId, function ($q) use ($serviceId) {
                        return $q->where('service_id', $serviceId);
                    })
                    ->where(function ($q) use ($visitorId, $request) {
                        if ($visitorId) {
                            $q->where('visitor_id', $visitorId);
                        } else {
                            $q->where('ip_address', $request->ip());
                        }
                    })
                    ->where('visited_at', '>', now()->subDay())
                    ->exists();

                if (!$alreadyVisited) {
                    ProviderVisit::create([
                        'visitor_id'  => $visitorId,
                        'provider_id' => $providerId,
                        'service_id'  => $serviceId,
                        'ip_address'  => $request->ip(),
                        'country'     => $request->header('cf-ipcountry') ?? 'N/A',
                        'device_type' => $agent->isMobile() ? 'Mobile' : 'Desktop',
                        'os'          => $agent->platform(),
                        'browser'     => $agent->browser(),
                        'visited_at'  => now(),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error("Tracking Middleware Error: " . $e->getMessage());
            }
        }
    }
}
