<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE_NAME = 'request_log';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->dateTime('created_at')->comment('Дата создания запроса');
            $table->foreignId('request_type_id')->constrained()->onDelete('cascade');
            $table->jsonb('request_parameters')->comment('Параметры запроса');
            $table->jsonb('response_parameters')->comment('Параметры ответа');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->dropForeign(['request_type_id']);
        });
        Schema::dropIfExists(self::TABLE_NAME);
    }
};