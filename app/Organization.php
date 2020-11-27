<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name'
    ];
    protected $hidden = [
       // 'activity','user_id'
    ];

    public function article()
    {
        return $this->hasMany(Article::class);
    }
    function user(){
        return $this->belongsTo(User::class);
    }
}
