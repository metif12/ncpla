<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Junges\ACL\Traits\UsersTrait;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UsersTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo',
        'national_code',
        'mobile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'mobile_verified_at' => 'datetime',
        'activated_at' => 'datetime',
    ];

    public function toggleActivation()
    {
        if(empty($this->activated_at)) $this->update(['activated_at'=>now()]);
        else $this->update(['activated_at'=>null]);
    }

    public function hasLine($line)
    {
        return DB::table('line_users')
            ->where('user_id' , $this->id)
            ->where('line_id' , $line->id)
            ->exists();
    }
}
