<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Grade;
use App\Models\Semester;
use App\Models\UserData;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {

        $user = auth()->user();
        $userData = $user->userData;
        $semesters = Semester::all();
        $grades = Grade::all();

        if ($user->hasRole('admin')) {
            return view('admin.profile.edit', compact('user'));
        } else {
            return view('user.profile.edit', compact('user', 'userData', 'semesters', 'grades'));
        }
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

        if (Auth::user()->hasRole('admin')) {
            return Redirect::route('admin.dashboard.profile.edit')->with('status', 'profile-updated');
        } else {
            return Redirect::route('user.profile.edit')->with('status', 'profile-updated');
        }
    }

    public function dataUpdate(Request $request)
    {

        // dd($request);

        $request->validate([
            'id_card' => 'required|numeric|digits_between:1,10',
            'name' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'id_semester' => 'required',
            'id_grade' => 'required',
            'daytrip' => 'required',
        ]);

        $user = auth()->user();
        $userData = $user->userData;

        $userData->update($request->all());

        if (Auth::user()->id_role === 1) {
            return Redirect::route('admin.profile.edit')->with('status', 'data-updated');
        } else {
            return Redirect::route('user.profile.edit')->with('status', 'data-updated');
        }
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
