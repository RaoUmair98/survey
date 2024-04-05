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
        Schema::create('manager_responses', function (Blueprint $table) {
            $table->id();
          
            $table->unsignedBigInteger('question_id');
            $table->string('response');
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('subordinate_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manager_responses');
    }
};
