<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use OpenAI;

class ApiController extends Controller
{
    public function index()
    {
        $employees = Employee::query()->with('department')->get();
        $holidays = Holiday::all();

        return view('api.index', compact('employees', 'holidays'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Забыли заполнить кое что (:attribute)',
        ];
        $validator = Validator::make($request->all(), [
            'employee_id' => ['required'],
            'holiday_id' => ['required'],
            'description' => Rule::requiredIf(function() use ($request) {
                $birthdayHoliday = Holiday::query()->where('name', '=', 'день рождения')->get()->all()[0];
                return (int)$request->holiday_id !== $birthdayHoliday->id;
            }),
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('api.index'))
                ->withErrors($validator)
                ->withInput();
        }

        $employee = Employee::query()->findOrFail($request->employee_id);
        $holiday = Holiday::query()->findOrFail($request->holiday_id);

        $client = OpenAI::client(env('API_KEY'));
        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'Напиши вариант поздравления на русском языке. Праздник: ' . $holiday->name . '. Именинника зовут: ' . $employee->first_name . '. Также учти, что поздравление должно быть от лица компании Neovox. Не забудь добавить пару эмодзи во всё поздравление'
                ],
            ],
        ]);

        $result = $response['choices'][0]['message']['content'];
        return json_encode([
            'status' => 'success',
            'result' => $result,
        ]);
    }
}
