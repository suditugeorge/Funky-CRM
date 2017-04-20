<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = [];

    public function volunteer()
    {
        return $this->hasMany(Volunteer::class);
    }

    public function media()
    {
    	return $this->hasMany(Media::class);
    }

    public function donor()
    {
    	return $this->hasMany(Donor::class);
    }    
}
