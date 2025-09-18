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
        Schema::table('task_responses', function (Blueprint $table) {
            $table->string('file_id')->nullable()->after('response');
            $table->string('file_name')->nullable()->after('file_id');
        });
    }

    public function down(): void
    {
        Schema::table('task_responses', function (Blueprint $table) {
            $table->dropColumn(['file_id', 'file_name']);
        });
    }
};