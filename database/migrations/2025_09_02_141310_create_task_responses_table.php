<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('task_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->cascadeOnDelete(); // links to task
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // the responder
            $table->longText('response'); // CKEditor response text
            $table->enum('status', ['submitted', 'approved', 'rejected'])->default('submitted');
            $table->text('feedback')->nullable(); // admin feedback
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_responses');
    }
};