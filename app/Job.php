<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'name','description','requirments',
        'location','experience','salary',
        'organization_id'
       ];

       public function applications()
       {
           return $this->hasMany(Application_job::class);
       }
    public function user(){
        return $this->belongsToMany(User::class, 'application_jobs', 'user_id','job_id' );
    }
}
