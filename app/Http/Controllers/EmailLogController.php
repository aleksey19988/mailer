<?php

namespace App\Http\Controllers;

use App\Models\EmailLog;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('email-log.index', [
            'logs' => EmailLog::all(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $log = EmailLog::query()->findOrFail($id);
        return view('email-log.show', compact('log'));
    }
}
