<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE_NAME = 'request_to_api_log';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->comment('Лог запросов к API ИИ');

            $table->id();
            $table->dateTime('created_at')->comment('Дата создания запроса');
            $table->jsonb('request_data')->comment('Данные запроса');
            $table->jsonb('response_data')->comment('Данные ответа');
            $table->integer('prompt_tokens')->comment('Длина текста-запроса для chatGPT');
            $table->integer('completion_tokens', )->comment('Длина текста-ответа от chatGPT');
            $table->integer('total_tokens')->comment('Всего использовано токенов');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
