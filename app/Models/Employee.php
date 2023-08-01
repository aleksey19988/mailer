<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function email()
    {
        return $this->hasOne(Email::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }
}
