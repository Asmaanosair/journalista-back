<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favourite_job extends Model
{
    protected $fillable = [
        'user_id','job_id'
    ];
}
