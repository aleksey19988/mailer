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
        $birthdayMen = $this->getBirthdayMen($employees);

        return view('welcome', compact('birthdayMen'));
    }

    private function getBirthdayMen($employees)
    {
        $result = [];
        $currentDate = Carbon::today()->format('d.m');

        foreach($employees as $employee) {
            $employeeBirthday = Carbon::createFromFormat('Y-m-d H:i:s', $employee->birthday)->format('d.m');

            if ($currentDate == $employeeBirthday) {
                $result[] = $employee;
            }
        }

        return $result;
    }
}
