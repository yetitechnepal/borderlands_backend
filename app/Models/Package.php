<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function photos()
    {
        return $this->hasMany("App\Models\Photo");
    } 

    public function includes()
    {
        return $this->hasMany("App\Models\Packageinclude");
    }
}
