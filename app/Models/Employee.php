<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'position_id',
        'branch_id',
        'first_name',
        'last_name',
        'patronymic',
        'email',
        'birthday',
    ];
}
