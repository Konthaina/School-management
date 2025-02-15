<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Profile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $profile = Profile::where('user_id', $request->user()->id)->firstOrFail();

        return view('profile.edit', [
            'user' => $request->user(),
            'profile' => $profile,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone_number' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:255',
        'profile_picture' => 'nullable|image|max:2048',
        'date_of_birth' => 'nullable|date',
        'institution' => 'nullable|string|max:255',
        'bio' => 'nullable|string|max:500',
    ]);

    $user = $request->user();
    $user->fill([
        'name' => $validated['name'],
        'email' => $validated['email'],
    ]);

    if ($user->isDirty('email')) {
        $user->email_verified_at = null;
    }
    $user->save();

    $profile = $user->profile;

    // Check if a new profile picture is being uploaded
    if ($request->hasFile('profile_picture')) {
        // Delete the old profile picture if it exists
        if ($profile->profile_picture && Storage::disk('public')->exists($profile->profile_picture)) {
            Storage::disk('public')->delete($profile->profile_picture);
        }

        // Store the new profile picture and update the path
        $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    $profile->update($validated);

    return Redirect::route('profile.edit')->with('status', 'Profile updated successfully.');
}


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
