<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'email',
        'password',
        'images',
        'role_id'
    ];

    static public function getEmailSingle($email){
        return User::where('email', '=' ,$email)->first();
    }
    
    static public function getTokenSingle($remember_token){
        return User::where('remember_token', '=' ,$remember_token)->first();
    }

}
            