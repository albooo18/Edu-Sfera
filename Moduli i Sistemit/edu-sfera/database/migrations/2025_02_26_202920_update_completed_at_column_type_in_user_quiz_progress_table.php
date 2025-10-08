<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('user_quiz_progress', function (Blueprint $table) {
            $table->datetime('completed_at')->change(); // Change the column type to datetime
        });
    }

    public function down()
    {
        Schema::table('user_quiz_progress', function (Blueprint $table) {
            $table->string('completed_at')->change(); // Revert the column type to string
        });
    }
};
