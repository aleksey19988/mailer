<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use JetBrains\PhpStorm\ArrayShape;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['email_address'];

    #[ArrayShape(['email_address' => "string[]"])] public function rules(): array
    {
        return [
            'email_address' => ['required', 'email'],
        ];
    }

//    public function department(): HasOne
//    {
//        return $this->hasOne(Department::class);
//    }
//
//    public function employee()
//    {
//        return $this->hasOne(Employee::class);
//    }
}
