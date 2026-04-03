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
    Schema::create('activity_logs', function (Blueprint $table) {
        $table->id(); // [cite: 155]
        $table->string('accion'); // [cite: 156]
        $table->string('modelo'); // [cite: 159]
        $table->unsignedBigInteger('modelo_id'); // [cite: 162]
        $table->string('descripcion'); // [cite: 163]
        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // [cite: 164]
        $table->timestamps(); // [cite: 165]
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
