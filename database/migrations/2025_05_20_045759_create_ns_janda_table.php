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
        Schema::create('ns_janda', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('usia');
            $table->decimal('nilai_sekarang', 10, 6);
            $table->decimal('ns_anak', 10, 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ns_janda');
    }
};
