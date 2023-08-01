<?php

namespace App\Http\Controllers;

use App\Models\RequestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requestTypes = RequestType::all();
        return view('request-types.index', compact('requestTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('request-types.create');
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
            return redirect(route('request-types.create'))
                ->withErrors($validator)
                ->withInput();
        }
        RequestType::query()->create($validator->validated());
        return redirect()->route('request-types.index')->with('success', 'Площадка успешно добавлена &#129304;');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $requestType = RequestType::query()->findOrFail($id);
        return view('request-types.show', compact('requestType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $requestType = RequestType::query()->findOrFail($id);
        return view('request-types.edit', compact('requestType'));
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
            return redirect(route('request-types.create'))
                ->withErrors($validator)
                ->withInput();
        }
        RequestType::query()->findOrFail($id)->update($validator->validated());
        return redirect()->route('request-types.index')->with('success', 'Имя запроса успешно обновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        RequestType::query()->findOrFail($id)->delete();
        return redirect()->route('request-types.index')->with('success', 'Имя запроса успешно удалено');
    }
}
