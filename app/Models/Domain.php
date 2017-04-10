<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function domainable()
    {
        return $this->morphTo();
    }
}
