<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\SurvayInvitationMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'manager_id',
        'inviteSend',
        'survayCompleted',
        'isSurveyStarted'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function sendPasswordResetNotification($token)
    {
        // $this->notify(new CustomResetPassword($token));
        $resetToken = $token;
        $resetLink = URL::to('reset-password') . '/' . $resetToken . '?email=' . $this->email;

        // Mail::to($this)->send(new SurvayInvitationMail($resetLink));
    }

    public function subordinates()
    {
        return User::where('manager_id', $this->id)->get();
    }

    public function userSurveys()
    {
        return $this->hasMany(UserSurvay::class, 'user_id');
    }

    public function getManager()
    {
        return User::find($this->manager_id);
    }

   
}
