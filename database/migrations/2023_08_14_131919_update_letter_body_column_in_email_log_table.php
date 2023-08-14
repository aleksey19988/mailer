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
        // Добавляю новое поле с большей длиной
        Schema::table('email_log', function (Blueprint $table) {
            $table->string('letter_body_new', 5000)->after('letter_subject')->comment('Тело письма');
        });

        // Копирую все данные из старого поля в новое
        $emailLogs = \App\Models\EmailLog::all();
        if ($emailLogs) {
            foreach($emailLogs as $log) {
                $log->letter_body_new = $log->letter_body;
                $log->save();
            }
        }

        // Удаляю старое поле
        Schema::table('email_log', function(Blueprint $table)
        {
            // 3- delete the old column
            $table->dropColumn('letter_body');
        });

        // Меняю имя нового поля на старое
        Schema::table('email_log', function(Blueprint $table)
        {
            // 4- rename the new column to match name of the deleted column
            $table->renameColumn('letter_body_new', 'letter_body');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('email_log', function(Blueprint $table)
        {
            $table->renameColumn('letter_body', 'letter_body_old');
        });

        Schema::table('email_log', function (Blueprint $table) {
            $table->string('letter_body', 3000)->after('letter_subject')->comment('Тело письма');
        });

        $emailLogs = \App\Models\EmailLog::all();
        if ($emailLogs) {
            foreach($emailLogs as $log) {
                $log->letter_body = $log->letter_body_old;
                $log->save();
            }
        }

        Schema::table('email_log', function(Blueprint $table)
        {
            $table->dropColumn('letter_body_old');
        });
    }
};
