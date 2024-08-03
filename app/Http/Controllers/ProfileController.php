<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\AboutMeRequest;
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
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function editPersonalInfo(Request $request): View
    {
        return view('profile.edit_personal_info', [
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

    public function updateResume(Request $request): RedirectResponse
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:15000'
        ]);

        if($request->hasFile('resume')) {
            $resume_file = $request->file('resume');
            $fileName = Storage::disk('local')->put('resumes', $resume_file);
            $request->user()->update([
                'resume' => $fileName
            ]);
        }
        return Redirect::route('profile.edit_personal_info')->with('status', 'profile-updated');
    }

    public function downloadResume(Request $request) {
        if(!Auth::check()) {
            abort(403, 'Unautherized.');
        }

        $resume_path = storage_path('app/' . $request->user()->resume);
        if(!file_exists($resume_path)) {
            abort(404, 'File does not exist.');
        }
        return response()->download($resume_path);
    }

    public function updateAboutMeInfo(AboutMeRequest $request) {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.edit_personal_info')->with('status', 'profile-updated');
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
