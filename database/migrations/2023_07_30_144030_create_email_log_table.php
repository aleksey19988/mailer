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
            $table->id();
            $table->foreignId('holiday_id')->constrained()->onDelete('cascade');
            $table->jsonb('addressee_letter_email_ids')->comment('Список id email-ов получателей письма');
            $table->jsonb('addressee_copy_email_ids')->comment('Список id email-ов получателей копии письма');
            $table->string('letter_subject')->comment('Тема письма');
            $table->string('letter_body')->comment('Тело письма');
            $table->boolean('is_send_success');
            $table->timestamps();
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
