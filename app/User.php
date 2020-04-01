<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    protected $table = 'tbl_users';
    protected $fillable = [
        'username', 'email', 'password'
    ];
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}
