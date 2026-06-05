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
        Schema::table('fights', function (Blueprint $table) {
            $table->foreign('fighter_id')->references('id')->on('fighters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fights', function (Blueprint $table) {
            $table->dropForeign(['fighter_id']);
        });
    }
};
