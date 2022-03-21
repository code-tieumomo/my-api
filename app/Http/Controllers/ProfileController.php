<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        $profile = $request->validated();

        $user = User::find(Auth::user()->id);
        if (!$user) return response()->json([
            'message' => 'Some thing wrong while finding current profile! Try again later',
        ], 404);

        $user->update([
            'name' => $profile['name'],
            'about' => $profile['about'] ?? '',
            'phone_number' => $profile['phone_number'] ?? '',
            'dob' => '2021-12-01',
            'url' => $profile['url'] ?? '',
        ]);

        if ($profile['avatar'] && is_file($profile['avatar'])) {
            $avatarExt = $profile['avatar']->extension();
            $profile['avatar']->move(public_path('images') . '/avatars', $user->id . '.' . $avatarExt);
            $user->update([
                'avatar' => URL::to('images/avatars/' . $user->id . '.' . $avatarExt),
            ]);
        }

        return response()->json(compact('user'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $password = $request->validated();

        $user = User::find(Auth::user()->id);
        if (!$user) return response()->json([
            'message' => 'Some thing wrong while finding current profile! Try again later',
        ], 404);

        $user->update(['password' => bcrypt($password['new_password'])]);

        return response()->json(compact('user'));
    }
}
