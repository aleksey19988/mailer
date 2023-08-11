<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use App\Models\Employee;
use App\Models\City;
use App\Models\Position;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all()->sortBy('last_name');
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        $positions = Position::all();
        $branches = Branch::all();

        return view('employees.create', compact('departments', 'positions', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Забыли заполнить кое что (:attribute)',
        ];

        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'patronymic' => ['max:30'],
            'department_id' => ['required'],
            'position_id' => ['required'],
            'branch_id' => ['required'],
            'email' => ['required'],
            'birthday' => ['required', 'date_format:d.m.Y'],
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('employees.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $validator->setValue('birthday', Carbon::createFromFormat('d.m.Y', $validator->validated()['birthday'])->toDateTimeString());
        Employee::query()->create($validator->validated());

        return redirect()->route('employees.index')->with('success', 'Данные о сотруднике успешно сохранены');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::query()->findOrFail($id);
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::query()->findOrFail($id);
        $positions = Position::all();
        $departments = Department::all();
        $branches = Branch::all();

        return view('employees.edit', compact('employee', 'positions', 'departments', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Employee $employee)
    {
        $messages = [
            'required' => 'Забыли заполнить кое что (:attribute)',
        ];
        $validator = Validator::make($request->all(), [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'patronymic' => ['max:30'],
            'department_id' => ['required'],
            'position_id' => ['required'],
            'branch_id' => ['required'],
            'email' => ['required'],
            'birthday' => ['required', 'date_format:d.m.Y'],
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('employees.edit', $employee))
                ->withErrors($validator)
                ->withInput();
        }

        $validator->setValue('birthday', Carbon::createFromFormat('d.m.Y', $validator->validated()['birthday'])->toDateTimeString());
        $employee->update($validator->validated());

        return redirect()->route('employees.index')->with('success', "Данные о сотруднике успешно отредактированы");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::query()->find($id)->delete();
        return redirect()->route('employees.index')->with('success', 'Данные о сотруднике успешно удалены');
    }

    public static function getBirthdayEmployees()
    {
        $employees = Employee::all();
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
