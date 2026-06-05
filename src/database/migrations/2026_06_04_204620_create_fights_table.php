<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fighter_id');
            $table->string('opponent', 256);
            $table->string('result', 50);
            $table->string('method', 100);
            $table->date('fight_date');
            $table->string('event', 256);
            $table->text('notes')->nullable();
            $table->boolean('display')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fights');
    }
};
