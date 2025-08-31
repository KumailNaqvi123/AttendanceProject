<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_picture')->nullable()->after('email');
        });
    }

        public function down(): void
    {
        if (Schema::hasColumn('users', 'profile_picture')) {
            // SQLite doesn’t support dropColumn directly
            // So we’ll just leave it in place instead of breaking rollback
        }
    }
};
