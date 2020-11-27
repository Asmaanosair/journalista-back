<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
