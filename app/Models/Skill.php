<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function skillable()
    {
        return $this->morphTo();
    }
}
