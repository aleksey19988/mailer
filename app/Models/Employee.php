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

    public function department()
    {
        return $this->hasOne(Department::class);
    }

    public function position()
    {
        return $this->hasOne(Position::class);
    }

    public function branch()
    {
        return $this->hasOne(Branch::class);
    }
}
