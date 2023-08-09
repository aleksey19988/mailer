<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use OpenAI;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ApiController extends Controller
{
    public function index()
    {
        return view('api.index');
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => 'Забыли заполнить кое что (:attribute)',
        ];
        $validator = Validator::make($request->all(), [
            'question' => ['required'],
        ], $messages);

        if ($validator->fails()) {
            return redirect(route('api.index'))
                ->withErrors($validator)
                ->withInput();
        }

        $client = OpenAI::client(env('API_KEY'));
        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $request->question,
                ],
            ],
        ]);

        if ($response['choices'][0]['message']['content']) {
            $responseMessage = $response['choices'][0]['message']['content'];
            return json_encode([
                'status' => 'success',
                'requestMessage' => $request->question,
                'responseMessage' => $responseMessage,
            ]);
        } else {
            return json_encode([
                'status' => 'error',
                'result' => 'Запрос к ChatGPT был отправлен, но возникла ошибка при получении ответа',
            ]);
        }
    }
}
