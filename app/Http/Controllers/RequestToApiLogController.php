<?php

namespace App\Http\Controllers;

use App\Models\RequestToApiLog;
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
}
