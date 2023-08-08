<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Email;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
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
            'name' => ['required'],
            'email' => ['required', 'email'],
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('departments.create'))
                ->withErrors($validator)
                ->withInput();
        }
        Department::query()->create($validator->validated());
        return redirect()->route('departments.index')->with('success', 'Отдел успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $department = Department::query()->findOrFail($id);
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $department = Department::query()->findOrFail($id);

        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $messages = [
            'required' => 'Забыли заполнить кое что (:attribute)',
        ];
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('departments.edit', compact('department')))
                ->withErrors($validator)
                ->withInput();
        }

        $department->update($validator->validated());
        return redirect()->route('departments.index')->with('success', 'Отдел "' . $department->name . '" успешно обновлён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Department::query()->findOrFail($id)->delete();
        return redirect(route('departments.index'))->with('success', 'Отдел успешно удалён!');
    }
}
