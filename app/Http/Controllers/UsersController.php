<?php

namespace App\Http\Controllers;

use App\User;
use App\Follow;
use App\Mail\VerifyEmailCode;
use App\NotVerifyUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            $user->social_path = "";
        }
        else{
            $user->image = "default.png";
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

        return back();
    }

    /**
     * @param $name
     * return spicific users
     */
    public function getUsers($name)
    {
        $users = User::where('id',"!=",auth()->id())
        ->where("name",'LIKE',"%".$name."%")->orWhere("display_name",'LIKE',"%".$name."%")
        ->get();
        return view("posts.showusers",compact("users"));
    }

    /**
     * register user
     * @param $request
     */
    public function registerUser(Request $request){
        $data = [
            'name' => ['required', 'string', 'max:32', 'unique:not_verify_users',"unique:users"],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:not_verify_users',"unique:users"],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
        $check = Validator::make($request->all(),$data);
        if(!$check->fails()){
            try{
                $not_v_user = NotVerifyUser::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
        
                ]);
                $email = $request->email;
                $name = $request->name;
                $id   = $not_v_user->id;
                Mail::to($email)->send(new VerifyEmailCode($email,$name,$id));
                return view("auth.verifyviewuser",compact('email','name','id'));
            }
            catch(Exception $er){
                return $er;
            }
        }
        else{
            return back()->with(["errors" => $check->errors()]);
        }
    }

    /**
     * send email 
     * @param $id,$name,$email
     */
    public function sendEmail($email,$name,$id)
    {
        Mail::to($email)->send(new VerifyEmailCode($email,$name,$id));
            return view("auth.verifyviewuser",compact('email','name','id'));
    }

    /**
     * After click to verify message in email call this function
     * @param $email,$id
     */
    public function registerVerifyUser($email,$id){
        $not_v_user = NotVerifyUser::find($id);
        if($not_v_user != ""){
            $user = new User();
            $user->password = $not_v_user->password;
            $user->name = $not_v_user->name;
            $user->email = $email;
            $user->save();
            $not_v_user->delete();
            return redirect("/login");
        }
        else{
            return "errors";
        }
    }
}
