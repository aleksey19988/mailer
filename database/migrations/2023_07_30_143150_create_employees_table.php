<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    const TABLE_NAME = 'employees';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->comment('ID отдела')->constrained()->onDelete('cascade');
            $table->foreignId('branch_id')->comment('ID филиала')->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->comment('ID должности')->constrained()->onDelete('cascade');
            $table->string('first_name')->comment('Имя');
            $table->string('last_name')->comment('Фамилия');
            $table->string('patronymic')->comment('Отчество');
            $table->string('email')->comment('Электронная почта сотрудника');
            $table->timestamp('birthday')->comment('Дата рождения');
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->dropForeign(['department_id']);
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['position_id']);
        });
        Schema::dropIfExists(self::TABLE_NAME);
    }
};
