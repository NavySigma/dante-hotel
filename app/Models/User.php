<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_nama',
        'user_nohp',
        'user_tgllahir',
        'user_username',
        'user_password',
        'user_nik',
        'user_level',
    ];

    protected $hidden = [
        'user_password',
    ];

    // supaya Laravel pakai password kolom 'user_password'
    public function getAuthPassword()
    {
        return $this->user_password;
    }
}
