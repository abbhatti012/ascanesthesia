<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'stripe_key','stripe_secret_key','paypal_key','paypal_env','smtp_host','smtp_port','smtp_username','smtp_password'
    ];
}
