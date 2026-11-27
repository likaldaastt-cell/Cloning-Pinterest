<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Services\FeedService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class FeedController extends Controller
{
    public function __construct(private FeedService $feed)
    {
    }

    public function index(Request $request): View
    {
        $filters = $request->validate([
            'category' => ['nullable', Rule::in(Pin::CATEGORIES)],
            'user' => ['nullable', 'integer'],
        ]);

        return view('feed.index', [
            'pins' => $this->feed->getFeed($filters, $request->user()?->id),
            'categories' => Pin::CATEGORIES,
            'active' => $filters['category'] ?? null,
        ]);
    }
}