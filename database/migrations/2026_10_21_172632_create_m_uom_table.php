<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('m_uom', function (Blueprint $table) {
            $table->id('iduom');
            $table->string('nmuom', 50);
            $table->unsignedBigInteger('crtby')->nullable();
            $table->timestamp('crtdt')->nullable();
            $table->unsignedBigInteger('updby')->nullable();
            $table->timestamp('upddt')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_uom');
    }
};
