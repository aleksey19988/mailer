<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['city_id', 'name', 'opening_date', 'address'];

    public function employees(): HasOne
    {
        return $this->hasOne(Employee::class);
    }
}
