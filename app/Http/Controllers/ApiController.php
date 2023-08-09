<?php

namespace App\Http\Controllers;

use App\Models\RequestToApiLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenAI;

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
        $requestData = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $request->question,
                ],
            ],
        ];
        $responseData = $client->chat()->create($requestData);

        if ($responseData['choices'][0]['message']['content']) {
            $this->saveRequestToLog($requestData, $responseData);

            $responseMessage = $responseData['choices'][0]['message']['content'];
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

    private function saveRequestToLog($request, $response): void
    {
        RequestToApiLog::query()->create([
            'created_at' => Carbon::createFromTimestamp($response['created']),
            'request_data' => json_encode($request),
            'response_data' => json_encode($response),
            'prompt_tokens' => $response['usage']['prompt_tokens'],
            'completion_tokens' => $response['usage']['completion_tokens'],
            'total_tokens' => $response['usage']['total_tokens'],
        ]);
    }
}
