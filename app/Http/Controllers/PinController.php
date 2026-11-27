<?php

namespace App\Http\Controllers;

use App\Http\Requests\PinRequest;
use App\Models\Pin;
use App\Services\BoardService;
use App\Services\PinService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class PinController extends Controller
{
    public function __construct(private PinService $pins, private BoardService $boards)
    {
    }

    public function create(Request $request): View
    {
        return view('pins.create', [
            'boards' => $this->boards->listForUser($request->user()),
            'selectedBoard' => $request->query('board_id'),
            'categories' => Pin::CATEGORIES,
        ]);
    }

    public function store(PinRequest $request): RedirectResponse
    {
        $pin = $this->pins->create($request->user(), $request->validated());
        return redirect()->route('pins.show', $pin)->with('status', 'Pin dibuat.');
    }

    public function show(Pin $pin): View
    {
        return view('pins.show', ['pin' => $this->pins->detail($pin)]);
    }

    public function edit(Request $request, Pin $pin): View
    {
        Gate::authorize('update', $pin);
        return view('pins.edit', [
            'pin' => $pin,
            'boards' => $this->boards->listForUser($request->user()),
            'categories' => Pin::CATEGORIES,
        ]);
    }

    public function update(PinRequest $request, Pin $pin): RedirectResponse
    {
        Gate::authorize('update', $pin);
        $this->pins->update($pin, $request->validated());
        return redirect()->route('pins.show', $pin)->with('status', 'Pin diperbarui.');
    }

    public function destroy(Pin $pin): RedirectResponse
    {
        Gate::authorize('delete', $pin);
        $boardId = $pin->board_id;
        $this->pins->delete($pin);
        return redirect()->route('boards.show', $boardId)->with('status', 'Pin dihapus.');
    }
}