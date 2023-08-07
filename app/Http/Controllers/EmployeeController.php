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
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $errors = [];
        $departments = Department::all();
        if (!$departments->all()) {
            $errors['departments'] = [
                'route' => 'departments.create',
                'message' => 'Ни один отдел не создан',
            ];
        }
        $positions = Position::all();
        if (!$positions->all()) {
            $errors['positions'] = [
                'route' => 'positions.create',
                'message' => 'Ни одна должность не добавлена',
            ];
        }
        $branches = Branch::all();
        if (!$branches->all()) {
            $errors['branches'] = [
                'route' => 'branches.create',
                'message' => 'Ни один филиал не заполнен',
            ];
        }

        return view('employees.create', compact('departments', 'positions', 'branches', 'errors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Забыли заполнить кое что (:attribute)',
        ];

        $formData = $request->all();
        $birthday = $formData['birthday'];
        if ($birthday) {
            $formData['birthday'] = Carbon::createFromFormat('d.m.Y', $birthday)->toDateTimeString();
        } else {
            return redirect(route('employees.create'))
                ->withErrors(['Нужно заполнить дату рождения!'])
                ->withInput();
        }

        $validator = Validator::make($formData, [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'department_id' => ['required'],
            'position_id' => ['required'],
            'branch_id' => ['required'],
            'email' => ['required'],
            'birthday' => ['required'],
        ], $messages);



        if ($validator->fails()) {
            return redirect(route('employees.create'))
                ->withErrors($validator)
                ->withInput();
        }
        $employee = Employee::query()->create($validator->validated());
        return redirect()->route('employees.index')->with('success', 'Сотрудник успешно добавлен');
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
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => 'Забыли заполнить кое что (:attribute)',
        ];
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('employees.update'))
                ->withErrors($validator)
                ->withInput();
        }
        $employee = Employee::query()->findOrFail($id);
        $oldEmployeeName = $employee->name;

        $employee->update($validator->validated());
        $newEmployeeName = $employee->name;
        return redirect()->route('employees.index')->with('success', "Сотруник успешно отредактирован");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Employee::query()->find($id)->delete();
        return redirect()->route('employees.index')->with('success', 'Сотрудник удалён');
    }
}
