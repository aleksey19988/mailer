<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $positions = Position::all();
        return view('positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('positions.create');
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
            return redirect(route('positions.create'))
                ->withErrors($validator)
                ->withInput();
        }
        Position::query()->create($validator->validated());
        return redirect()->route('positions.index')->with('success', 'Должность успешно добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $position = Position::query()->findOrFail($id);
        return view('positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $position = Position::query()->findOrFail($id);

        return view('positions.edit', compact('position'));
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
        //todo: Добавить проверку на то, что пришедший id email-а существует в БД

        if ($validator->fails()) {
            return redirect(route('positions.update'))
                ->withErrors($validator)
                ->withInput();
        }
        $position = Position::query()->findOrFail($id);
        $position->update($validator->validated());
        return redirect()->route('positions.index')->with('success', 'Должность "' . $position->name . '" успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Position::query()->findOrFail($id)->delete();
        return redirect(route('positions.index'))->with('success', 'Должность успешно добавлена!');
    }
}
