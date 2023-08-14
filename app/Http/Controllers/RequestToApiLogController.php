<?php

namespace App\Http\Controllers;

use App\Models\RequestToApiLog;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class RequestToApiLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('request-to-api-log.index', [
            'logs' => RequestToApiLog::all(),
        ]);
    }

    public static function saveRequestToLog($request, $response): bool
    {
        return RequestToApiLog::query()->create([
            'created_at' => Carbon::createFromTimestamp($response['created']),
            'request_data' => json_encode($request),
            'response_data' => json_encode($response),
            'prompt_tokens' => $response['usage']['prompt_tokens'],
            'completion_tokens' => $response['usage']['completion_tokens'],
            'total_tokens' => $response['usage']['total_tokens'],
        ])->save();
    }
}
