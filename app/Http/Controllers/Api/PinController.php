<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PinRequest;
use App\Http\Resources\PinResource;
use App\Models\Pin;
use App\Services\PinService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class PinController extends Controller
{
    public function __construct(private PinService $pins)
    {
    }

    public function store(PinRequest $request): JsonResponse
    {
        $pin = $this->pins->create($request->user(), $request->validated());
        return PinResource::make($pin)->response()->setStatusCode(201);
    }

    public function show(Pin $pin): PinResource
    {
        return PinResource::make($this->pins->detail($pin));
    }

    public function update(PinRequest $request, Pin $pin): PinResource
    {
        Gate::authorize('update', $pin);
        return PinResource::make($this->pins->update($pin, $request->validated()));
    }

    public function destroy(Pin $pin): Response
    {
        Gate::authorize('delete', $pin);
        $this->pins->delete($pin);
        return response()->noContent();
    }
}