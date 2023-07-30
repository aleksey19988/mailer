<?php

namespace App\Http\Controllers;

use OpenAI\Laravel\Facades\OpenAI;

class SiteController extends Controller
{
    public function index()
    {
        $result = OpenAI::chat()->create(
            [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => 'Напиши вариант оригинального поздравления с днём рождения, состоящий из 5 предложений на русском языке. При формировании поздравления учти следующие данные: поздравление происходит от лица компании, в которой работает именинник. Это парень, его зовут Алексей, а компания называется Neovox. Также не забудь добавить в поздравление 2-3 эмодзи'
                    ],
                ],
            ]
        );

        echo $result['choices'][0]['message']['content'];
    }
}
