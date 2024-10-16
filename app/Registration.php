<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{

    protected $fillable = [
      'user_id',
      'vaccine_center_id',
      'is_scheduled',
    ];
}
