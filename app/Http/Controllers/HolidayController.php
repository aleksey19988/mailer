<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $formData = $request->all();
        $formData['name'] = mb_strtolower($formData['name']);

        if ($formData['date_of_celebration'] && strlen($formData['date_of_celebration']) === 5) {
            $formData['date_of_celebration'] = Carbon::createFromFormat('d.m', $formData['date_of_celebration'])->toDateTimeString();
        }

        $validator = Validator::make($formData, [
            'name' => ['required', 'unique:App\Models\Holiday,name'],
            'date_of_celebration' => Rule::requiredIf(fn () => mb_strtolower($formData['name']) !== 'день рождения'),
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
        $formData = $request->all();
        $formData['name'] = mb_strtolower($formData['name']);

        if ($formData['date_of_celebration']) {
            $formData['date_of_celebration'] = Carbon::createFromFormat('d.m', $formData['date_of_celebration'])->toDateTimeString();
        }

        $validator = Validator::make($formData, [
            'name' => ['required', 'unique:App\Models\Holiday,name'],
            'date_of_celebration' => Rule::requiredIf(fn () => mb_strtolower($formData['name']) !== 'день рождения'),
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
