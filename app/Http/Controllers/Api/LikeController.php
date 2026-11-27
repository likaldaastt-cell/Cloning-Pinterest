<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pin;
use App\Services\LikeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct(private LikeService $likes)
    {
    }

    public function store(Request $request, Pin $pin): JsonResponse
    {
        $count = $this->likes->like($request->user(), $pin);

        return response()->json(['message' => 'Pin disukai.', 'likes_count' => $count]);
    }

    public function destroy(Request $request, Pin $pin): JsonResponse
    {
        $count = $this->likes->unlike($request->user(), $pin);

        return response()->json(['message' => 'Like dibatalkan.', 'likes_count' => $count]);
    }
}