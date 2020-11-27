<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $hidden = [

    ];
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function getImageAttribute($value)
    {
        return url($value);
    }
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
