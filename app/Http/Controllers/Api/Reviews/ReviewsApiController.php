<?php

namespace App\Http\Controllers\Api\Reviews;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Reviews\ReviewsRequest;
use App\Models\Reviews;
use App\Traits\ApiResponseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReviewsApiController extends Controller
{
    use ApiResponseTrait;

    public function store(ReviewsRequest $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $existing = Reviews::where('product_id', $request->product_id)
            ->where('user_id', $user->id)
            ->first();

        $review = Reviews::create([
            'product_id'  => $request->product_id,
            'user_id'     => $user->id,
            'rating'      => $request->rating,
            'comment'     => $request->comment,
            'emoji'       => $request->emoji,
            'is_approved' => true,
        ]);

        $review->load('user:id,name,email');

        return $this->successResponse($review, 'Review created successfully.', 201);
    }

    public function update(ReviewsRequest $request, Reviews $review)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($review->user_id !== $user->id) {
            return $this->errorResponse('You are not allowed to edit this review.', 403);
        }

        $review->update([
            'rating'  => $request->rating,
            'comment' => $request->comment,
            'emoji'   => $request->emoji,
        ]);

        $review->load('user:id,name,email');

        return $this->successResponse($review, 'Review updated successfully.');
    }
}
