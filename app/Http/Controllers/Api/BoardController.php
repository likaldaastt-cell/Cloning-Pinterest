<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BoardRequest;
use App\Http\Resources\PinResource;
use App\Models\Board;
use App\Services\BoardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class BoardController extends Controller
{
    public function __construct(private BoardService $boards)
    {
    }

    public function index(Request $request): JsonResponse
    {
        return response()->json(['data' => $this->boards->listForUser($request->user())]);
    }

    public function store(BoardRequest $request): JsonResponse
    {
        $board = $this->boards->create($request->user(), $request->validated());
        return response()->json(['data' => $board], 201);
    }

    public function show(Board $board): JsonResponse
    {
        $board = $this->boards->getWithPins($board);
        return response()->json(['data' => array_merge(
            $board->only(['id', 'user_id', 'name', 'description']),
            ['pins' => PinResource::collection($board->pins)->resolve()]
        )]);
    }

    public function update(BoardRequest $request, Board $board): JsonResponse
    {
        Gate::authorize('update', $board);
        return response()->json(['data' => $this->boards->update($board, $request->validated())]);
    }

    public function destroy(Board $board): Response
    {
        Gate::authorize('delete', $board);
        $this->boards->delete($board);
        return response()->noContent();
    }
}