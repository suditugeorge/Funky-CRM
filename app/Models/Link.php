<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    
    public function linkable()
    {
        return $this->morphTo();
    }
}
