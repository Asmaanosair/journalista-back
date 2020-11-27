<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsLink extends Model
{
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function getImageAttribute($val)
    {
        return url($val);
    }
}
