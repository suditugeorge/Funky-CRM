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

    public function politician()
    {
        return $this->hasMany(Politician::class);
    }   

    public function colaborator()
    {
        return $this->hasMany(Colaborator::class);
    }     

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }      
}
