<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all()->sortBy('name');
        return view('branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('branches.create', compact('cities'));
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
        $validator = Validator::make($formData, [
            'name' => ['required'],
            'city_id' => ['required'],
            'opening_date' => ['required'],
            'address' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('branches.create'))
                ->withErrors($validator)
                ->withInput();
        }
        $formData['opening_date'] = Carbon::createFromFormat('d.m.Y', $formData['opening_date'])->toDateTimeString();

        $branch = Branch::query()->create($validator->validated());
        return redirect()->route('branches.index')->with('success', 'Филиал "' . $branch->name .'" успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $branch = Branch::query()->findOrFail($id);
        return view('branches.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $branch = Branch::query()->findOrFail($id);
        $cities = City::all();
        return view('branches.edit', compact('branch', 'cities'));
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
            return redirect(route('branches.update'))
                ->withErrors($validator)
                ->withInput();
        }
        $branch = Branch::query()->findOrFail($id);
        $branch->update($validator->validated());
        $branchName = $branch->name;

        return redirect()->route('branches.index')->with('success', "Филиал '${branchName}' был успешно обновлён");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Branch::query()->find($id)->delete();
        return redirect()->route('branches.index')->with('success', 'Филиал удален');
    }
}
