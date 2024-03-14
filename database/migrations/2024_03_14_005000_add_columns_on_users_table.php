<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('local', 120)->nullable()->after('email');
            $table->string('phone', 100)->nullable()->after('local');
            $table->string('website', 200)->nullable()->after('phone');
            $table->text('about')->nullable()->after('website');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('local');
            $table->dropColumn('phone');
            $table->dropColumn('website');
            $table->dropColumn('about');
        });
    }
};
