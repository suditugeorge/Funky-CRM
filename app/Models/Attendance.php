<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function attendences()
    {
        return $this->morphTo();
    }
}
