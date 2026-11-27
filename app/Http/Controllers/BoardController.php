<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoardRequest;
use App\Models\Board;
use App\Services\BoardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class BoardController extends Controller
{
    public function __construct(private BoardService $boards)
    {
    }

    public function index(Request $request): View
    {
        return view('boards.index', ['boards' => $this->boards->listForUser($request->user())]);
    }

    public function create(): View
    {
        return view('boards.create');
    }

    public function store(BoardRequest $request): RedirectResponse
    {
        $board = $this->boards->create($request->user(), $request->validated());
        return redirect()->route('boards.show', $board)->with('status', 'Board dibuat.');
    }

    public function show(Board $board): View
    {
        return view('boards.show', ['board' => $this->boards->getWithPins($board)]);
    }

    public function edit(Board $board): View
    {
        Gate::authorize('update', $board);
        return view('boards.edit', ['board' => $board]);
    }

    public function update(BoardRequest $request, Board $board): RedirectResponse
    {
        Gate::authorize('update', $board);
        $this->boards->update($board, $request->validated());
        return redirect()->route('boards.show', $board)->with('status', 'Board diperbarui.');
    }

    public function destroy(Board $board): RedirectResponse
    {
        Gate::authorize('delete', $board);
        $this->boards->delete($board);
        return redirect()->route('boards.index')->with('status', 'Board dihapus.');
    }
}