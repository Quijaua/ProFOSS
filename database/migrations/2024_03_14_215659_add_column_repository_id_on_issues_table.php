<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->bigInteger('repository_id')->unsigned()->after('state');

            $table->foreign('repository_id')
                ->references('id')
                ->on('repositories')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('issues', function (Blueprint $table) {
            $table->dropForeign(['repository_id']);

            $table->dropColumn('repository_id');
        });
    }
};
