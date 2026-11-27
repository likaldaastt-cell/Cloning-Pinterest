<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Services\LikeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct(private LikeService $likes)
    {
    }

    public function store(Request $request, Pin $pin): RedirectResponse
    {
        $this->likes->like($request->user(), $pin);

        return back();
    }

    public function destroy(Request $request, Pin $pin): RedirectResponse
    {
        $this->likes->unlike($request->user(), $pin);

        return back();
    }
}