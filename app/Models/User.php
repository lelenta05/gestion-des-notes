<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    use  HasFactory, Notifiable,LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'location',
        'phone',
        'about',
        'last_name',
        'code_etudiant',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //les relations 

    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    public function logs()
    {
        return $this->hasMany(logs::class);
    }

    public function notes()
    {
         return $this->hasMany(notes::class,
            'student_code',   // clé étrangère dans notes
            'code_etudiant'   // clé locale dans users
        );
    }
 
}
