<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    use HasFactory;

    protected $fillable = ['holiday_id', 'addressee_letter_email', 'addressee_copy_email', 'letter_subject', 'letter_body', 'is_send_success', 'created_at'];
    protected $table = 'email_log';
    public $timestamps = false;

    public function holiday()
    {
        return $this->hasOne(Holiday::class, 'id', 'holiday_id');
    }
}
