<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::all();
        return view('cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => 'Забыли заполнить город',
        ];
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('cities.create'))
                ->withErrors($validator)
                ->withInput();
        }
        $city = City::query()->create($validator->validated());
        return redirect()->route('cities.index')->with('success', 'Город ' . $city->name .' успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = City::query()->findOrFail($id);
        return view('cities.show', compact('city'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $city = City::query()->findOrFail($id);
        return view('cities.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, City $city)
    {

        $messages = [
            'required' => 'Забыли заполнить город',
        ];
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('cities.edit', compact('city')))
                ->withErrors($validator)
                ->withInput();
        }

        $city->update($validator->validated());

        return redirect()->route('cities.index')->with('success', "Город успешно обновлён");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        City::query()->find($id)->delete();
        return redirect()->route('cities.index')->with('success', 'Город успешно удалён');
    }
}
