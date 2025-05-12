<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateProfilePhoto(Request $request)
{
    $request->validate([
        'profile_photo' => 'required|image|max:2048',
    ]);

    $user = Auth::user();

    if ($request->hasFile('profile_photo')) {
        $file = $request->file('profile_photo');

        $filename = $user->id . '.' . $file->getClientOriginalExtension();

        // Correct upload path using the public disk
        $file->storeAs('profile_photos', $filename, 'public');

        $user->profile_photo = $filename;
        $user->save();
    }

    return back()->with('success', 'Profile photo updated!');
}


    public function editEmail()
    {
    return view('forms.settings.change_email');
    }

    public function updateEmail(Request $request)
    {
        $request->validate([
        'email' => 'required|email|unique:users,email,' . auth()->id(),
    ]);

    $user = auth()->user();
    $user->email = $request->input('email');
    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Email updated successfully.');
}

public function editPassword()
{
    return view('forms.settings.change_password');
}

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = auth()->user();
    $user->password = bcrypt($request->password);
    $user->save();

    return redirect()->route('profile.edit')->with('success', 'Password changed successfully!');
}


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('settings', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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
