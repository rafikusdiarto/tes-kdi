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
        Schema::create('t_offer', function (Blueprint $table) {
            $table->id('idofr');
            $table->unsignedBigInteger('idprod');
            $table->unsignedBigInteger('idvend');
            $table->unsignedBigInteger('iduom')->nullable();
            $table->string('nmsales', 150);
            $table->string('nosales', 15);
            $table->float('qty');
            $table->string('ppn')->default('0');
            $table->string('stsofr')->default('1');
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
        Schema::dropIfExists('t_offer');
    }
};
