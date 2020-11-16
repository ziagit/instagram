<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display user settings form.
     */
    public function settings()
    {
        return view('users.account', [
            'user' => User::findOrFail(Auth::id()),
        ]);
    }

    /**
     * Display specific user.
     *
     * @param int $id
     */
    public function show($id)
    {
        return view('users.user', [
            'user' => User::with(['posts', 'posts.likes'])->find($id),
            'followed' => Follow::where([
                ['user_1', Auth::id()],
                ['user_2', $id],
            ])->exists(),
        ]);
    }

    /**
     * Update user settings.
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'display_name' => 'nullable|string|max:32',
            'biography' => 'nullable|string|max:128',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'new_password' => 'nullable|string|min:6|different:password',
            ]);

        //Update image if new one provided
        if (null !== $request->image) {
            $imageName = time().'.'.$request->image->getClientOriginalExtension();

            $request->image->move(public_path('images').'/avatar/', $imageName);

            $user->image = $imageName;
        }

        //Update rest if set.
        strlen($request->display_name) > 0 ? $user->display_name = $request->display_name : '';
        strlen($request->biography) > 0 ? $user->biography = $request->biography : '';
        strlen($request->new_password) > 0 ? $user->password = Hash::make($request->new_password) : '';

        $user->save();

        return redirect('user/'.Auth::id());
    }

    /**
     * Follow specified user.
     *
     * @param int $id
     */
    public function follow($id)
    {
        $record = Follow::where([
            ['user_1', Auth::id()],
            ['user_2', $id],
        ]);

        //If our record doesn't exist we create it
        if (null === $record->first()) {
            $follow = new Follow();

            $follow->user_1 = Auth::id();
            $follow->user_2 = $id;
            $follow->save();

        //If it exists we delete it
        } else {
            $record->delete();
        }

        return redirect()->route('account.show', ['id' => $id]);
    }
}
