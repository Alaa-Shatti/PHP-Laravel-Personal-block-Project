<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\UserUpdate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function dashboard()
    {
        return view('user.dashboard');
        /*
        if (Auth::user()->admin == true) {
            return view('user.dashboard');
        } else {
            return redirect(route('index'));
        }*/
    }

    public function comments()
    {
        return view('user.comments');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function profilePost(UserUpdate $request)
    {
        $user = Auth::user();

        $oldEmail = Auth::user()->email;
        $user->name = $request['name'];
        $user->email = $request['email'];

        $query = DB::table('users')->where('email', $request['email'])->first();

        if ($request['email'] != $oldEmail) {
            if ($query) {
                return redirect()->back()->with('error', "This email is already exists");
            }
        }
        if ($request['password'] == "") {
            return redirect()->back()->with('error', 'The password field is required.');
        }

        if (!(Hash::check($request['password'], Auth::user()->password))) {
            return redirect()->back()->with('error', "Your current password does not match with the password you provided !! ");
        }


        if ($request['new_password'] != "") {

            if (!(Hash::check($request['password'], Auth::user()->password))) {
                return redirect()->back()->with('error', "Your current password does not match with the password you provided !! ");
            }

            if (strcmp($request['password'], $request['new_password']) == 0) {
                return redirect()->back()->with('error', "New password cannot be same as your currnet password. ");
            }

            if ($request['password'] == null) {
                return redirect()->back()->with('error', "The password field is required.");
            }
            if ($request['new_password'] == null) {
                return redirect()->back()->with('error', "The new password field is required.");
            }
            if ($request['new_password'] != $request['new_password_confirmation']) {
                return redirect()->back()->with('error', "The password confirmation does not match.");
            }
            if (strlen($request['new_password']) < 8) {
                return redirect()->back()->with('error', "The password must be at least 8.");
            }

            $user->password = bcrypt($request['new_password']);
            $user->save();
            return redirect()->back()->with('success', 'Changes saved successfully');

        }
        $user->save();
        return redirect()->back()->with('success', 'Changes saved successfully');

        return back();
    }


    public function deleteComment($id)
    {
        $comment = Comment::where('id', $id)->where('user_id', Auth::id())->delete();
        return back();
    }


}
