<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // e.g. "Daily protein"
            $table->string('metric');            // e.g. "protein", "calories"
            $table->enum('direction', ['min', 'max']); // "min" = at least, "max" = at most
            $table->decimal('target_value', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
