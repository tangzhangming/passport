<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;


class ProfileController extends Controller
{

    // https://passport.520.com/web-api/profile
    public function show(Request $request)
    {
        $user = Auth::user();


        $data = [
            'user_id' => $user->id,
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'email_verified_at' => $user->email_verified_at,
            'avatar' => $user->avatar,
        ];
        return response()->json([
            'code' => 0,
            'data' => $data,
        ]);
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    // public function update(ProfileUpdateRequest $request): RedirectResponse
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        // 修改邮箱
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // 上传头像
        if ($request->hasFile('avatar')) {
            $request->user()->setProfilePicture(
                $request->file('avatar')
            );
        }

        $isDirty = $request->user()->isDirty();
        $request->user()->save();

        return response()->json([
            'code' => 0,
            'message' => $isDirty ? '修改成功' : '提交成功',
        ]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    // https://passport.520.com/web-api/profile/picture
    public function updatePicture(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:jpg,png,webp',
                'dimensions:min_width=50,min_height=50,max_width=1024,max_height=1024,ratio=1',
            ],
        ]);


        $user = $request->user();
        $file = $request->file('file');


        $user->setProfilePicture($file);
        $user->save();

        return response()->json([
            'code' => 0,
            'data' => $user,
        ]);
    }

}
