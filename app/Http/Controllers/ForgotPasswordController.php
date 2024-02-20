<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
  public function passForm(){
    return view('resetPass');
  }

  public function sendEmail(Request $request){
    $user = User::getEmailSingle($request->email);
    if(!empty($user)){
        $user->remember_token = Str::random(30);
        $user->save();
        if ($user && $user->email) {
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
           return redirect()->back()->with('success',' Please check your email and reset your password');
        }
    }else{
        return redirect()->back()->with('error','Email Not Found in The Data Base');
    }
}
public function get(){
    return view('emails.forgot');
}

public function reset($remember_token){
  $user = User::getTokenSingle($remember_token);
  if(!empty($user)){
    $data['user'] = $user;
     return view('reset' , $data);
  }else{
    abort(404);
  }
}

public function PostReset($taken, Request $request){
  if ($request->password == $request->password2){
    $user = User::getTokenSingle($taken);
    $user->password = Hash::make($request->password);
    $user->remember_token = Str::random(30);
    $user->save();
    return redirect('/login')->with('success', "Password successfully reset");
  }else{
    return redirect()->back()->with('error','Passwords Not match');
  }
}
}
