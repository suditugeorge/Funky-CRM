<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborator extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function contact()
    {
        return $this->belongsTo(Contact::class);
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
