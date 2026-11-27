<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PinResource;
use App\Models\Pin;
use App\Services\FeedService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\Rule;

class FeedController extends Controller
{
    public function __construct(private FeedService $feed)
    {
    }

    public function index(Request $request): AnonymousResourceCollection
    {
        $filters = $request->validate([
            'category' => ['nullable', Rule::in(Pin::CATEGORIES)],
            'user' => ['nullable', 'integer'],
        ]);

        // Endpoint publik, tetapi jika token dikirim, status 'liked_by_me' ikut terisi.
        $viewerId = $request->user('sanctum')?->id;

        return PinResource::collection($this->feed->getFeed($filters, $viewerId));
    }
}