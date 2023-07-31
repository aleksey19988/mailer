<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::all();
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locations.create');
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
            return redirect(route('locations.create'))
                ->withErrors($validator)
                ->withInput();
        }
        Location::query()->create($validator->validated());
        return redirect()->route('locations.index')->with('success', 'Площадка успешно добавлена &#129304;');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::query()->findOrFail($id);
        return view('locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $location = Location::query()->findOrFail($id);
        return view('locations.edit', compact('location'));
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
            return redirect(route('locations.update'))
                ->withErrors($validator)
                ->withInput();
        }
        Location::query()->find($id)->update($validator->validated());
        return redirect()->route('locations.index')->with('success', 'Имя площадки успешно обновлено &#129304;');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Location::query()->find($id)->delete();
        return redirect()->route('locations.index')->with('success', 'Площадка удалена');
    }
}
