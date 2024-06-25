<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceProvider extends Model
{
    protected $table = 'insurance-providers';

    protected $fillable = [
        'name', 'email', 'phone', 'cname', 'address', 'image'
    ];    
}
