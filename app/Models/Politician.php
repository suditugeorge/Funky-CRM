<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Politician extends Model
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

    public function links()
    {
        return $this->morphMany('App\Models\Link', 'linkable');
    }      

    public function parties()
    {
        return $this->hasMany(Partie::class);
    }   

}
