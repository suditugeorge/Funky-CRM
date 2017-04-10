<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function attends()
    {
        return $this->morphMany('App\Models\Attendance', 'attendences');
    }

    public function domains()
    {
        return $this->morphMany('App\Models\Domain', 'domainable');
    }

    public function skills()
    {
        return $this->morphMany('App\Models\Skill', 'skillable');
    }

}
