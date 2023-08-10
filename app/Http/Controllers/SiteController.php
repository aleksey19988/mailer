<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class SiteController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $employees = Employee::all();
        $birthdayEmployees = EmployeeController::getBirthdayEmployees();

        return view('welcome', compact('birthdayEmployees'));
    }
}
