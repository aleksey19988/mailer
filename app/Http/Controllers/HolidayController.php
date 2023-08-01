<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $holidays = Holiday::all();
        return view('holidays.index', compact('holidays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('holidays.create');
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
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('holidays.create'))
                ->withErrors($validator)
                ->withInput();
        }
        Holiday::query()->create($validator->validated());
        return redirect()->route('holidays.index')->with('success', 'Праздник успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $holiday = Holiday::query()->findOrFail($id);
        return view('holidays.show', compact('holiday'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $holiday = Holiday::query()->findOrFail($id);
        return view('holidays.edit', compact('holiday'));
    }

    /**
     * Update the specified resource in storage.
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
            return redirect(route('holidays.create'))
                ->withErrors($validator)
                ->withInput();
        }
        Holiday::query()->findOrFail($id)->update($validator->validated());
        return redirect()->route('holidays.index')->with('success', 'Праздник успешно обновлён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Holiday::query()->findOrFail($id)->delete();
        return redirect()->route('holidays.index')->with('success', 'Праздник успешно удалён');
    }
}
