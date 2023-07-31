<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $emails = Email::all();
        return view('emails.index', compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function create(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $messages = [
            'required' => 'Поле :attribute является обязательным',
            'email' => 'Некорректный email',
        ];
        $validator = Validator::make($request->all(), [
            'email_address' => ['required', 'email'],
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('emails.create'))
                ->withErrors($validator)
                ->withInput();
        }

        Email::query()->create($validator->validated());
        return redirect()->route('emails.index')->with('success', 'Email успешно добавлен.');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function show(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $email = Email::query()->findOrFail($id);
        return view('emails.show', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
     */
    public function edit(string $id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $email = Email::query()->findOrFail($id);
        return view('emails.edit', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, string $id): RedirectResponse
    {

        $messages = [
            'required' => 'Поле :attribute является обязательным',
            'email' => 'Некорректный email',
        ];
        $validator = Validator::make($request->all(), [
            'email_address' => ['required', 'email'],
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('emails.update'))
                ->withErrors($validator)
                ->withInput();
        }

        Email::query()->find($id)->update($validator->validated());

        return redirect()->route('emails.index')->with('success', 'Email успешно обновлён.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        Email::query()->find($id)->delete();
        return redirect()->route('emails.index')->with('success', 'Email успешно удалён');
    }
}
