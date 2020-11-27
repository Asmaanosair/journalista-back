<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function post()
    {
        return $this->hasMany(Post::class);
    }
    public function article()
    {
        return $this->hasMany(Article::class);
    }
    public function newsLink()
    {
        return $this->hasMany(NewsLink::class);
    }
}
