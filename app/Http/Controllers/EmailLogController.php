<?php

namespace App\Http\Controllers;

use App\Models\EmailLog;

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
        $addressee_full_name = 'ФИО не найдены';

        $employee = \App\Models\Employee::query()->where('email', '=', $log->addressee_letter_email)->first();
        if ($employee) {
            $addressee_full_name = $employee->last_name . ' ' . $employee->first_name . ' ' . $employee->patronymic;
        }
        return view('email-log.show', compact('log', 'addressee_full_name'));
    }
}
