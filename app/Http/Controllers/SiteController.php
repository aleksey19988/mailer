<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class SiteController extends Controller
{
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $birthdayEmployees = EmployeeController::getBirthdayEmployees();

        return view('welcome', compact('birthdayEmployees'));
    }
}
