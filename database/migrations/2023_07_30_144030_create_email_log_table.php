<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE_NAME = 'email_log';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->comment('Лог отправки писем');

            $table->id();
            $table->foreignId('holiday_id')->comment('ID праздника')->constrained()->onDelete('cascade');
            $table->string('addressee_letter_email')->comment('Email получателя письма');
            $table->string('addressee_copy_email')->nullable()->comment('Email получателя копии письма');
            $table->string('letter_subject')->comment('Тема письма');
            $table->string('letter_body', 3000)->comment('Тело письма');
            $table->boolean('is_send_success');
            $table->timestamp('created_at')->comment('Дата отправки');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->dropForeign(['holiday_id']);
        });
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
