<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(private ProfileService $profiles)
    {
    }

    public function show(User $user): View
    {
        return view('profile.show', $this->profiles->getProfileData($user));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'bio' => ['nullable', 'string', 'max:500'],
            'photo_url' => ['nullable', 'url:http,https', 'max:2048'],
        ]);

        $user = $this->profiles->update($request->user(), $data);

        return redirect()->route('profile.show', $user)->with('status', 'Profile diperbarui.');
    }
}