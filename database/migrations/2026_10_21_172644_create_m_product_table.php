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
        Schema::create('m_product', function (Blueprint $table) {
            $table->id('idprod');
            $table->string('nmprod', 150);
            $table->string('typprod', 3)->default('I');
            $table->unsignedBigInteger('iduom');
            $table->unsignedBigInteger('crtby')->nullable();
            $table->timestamp('crtdt')->nullable();
            $table->unsignedBigInteger('updby')->nullable();
            $table->timestamp('upddt')->nullable();
            $table->foreign('iduom')->references('iduom')->on('m_uom');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_product');
    }
};
