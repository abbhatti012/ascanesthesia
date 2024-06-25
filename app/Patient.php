<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];    
}
