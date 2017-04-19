<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
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

    public function channels()
    {
        return $this->hasMany(Channel::class);
    }

    public function liasons()
    {
        return $this->hasMany(MediaUser::class);
    }  

    public function links()
    {
        return $this->morphMany('App\Models\Link', 'linkable');
    }      

}
