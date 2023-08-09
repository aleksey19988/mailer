<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestToApiLog extends Model
{
    use HasFactory;
    const REQUESTS_PER_MINUTE_LIMIT = 3;
    const REQUESTS_PER_DAY_LIMIT = 200;
    const TOKENS_PER_MINUTE_LIMIT = 40000;
    protected $fillable = ['created_at', 'request_data', 'response_data', 'prompt_tokens', 'completion_tokens', 'total_tokens'];
    protected $table = 'request_to_api_log';
    public $timestamps = false;
}
