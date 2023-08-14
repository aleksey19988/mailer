<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('email_log', function(Blueprint $table)
        {
            $table->dropColumn('letter_body');
        });

        Schema::table('email_log', function(Blueprint $table)
        {
            $table->string('letter_body', 5000)->after('letter_subject')->comment('Тело письма');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        echo 'Невозможно изменить размер поля в меньшую сторону, так как текущие данные могут не поместиться';
    }
};
