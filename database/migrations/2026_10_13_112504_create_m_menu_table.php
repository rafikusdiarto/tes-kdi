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
        Schema::create('m_menu', function (Blueprint $table) {
            $table->id('idmnu');
            $table->string('nmmnu', 50);
            $table->string('urlmnu', 50)->nullable();
            $table->string('icnmnu', 50)->nullable();
            $table->string('grpmnu', 50)->nullable();
            $table->unsignedBigInteger('prnmnu')->nullable();
            $table->integer('ordmnu')->default(0);
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
        Schema::dropIfExists('m_menu');
    }
};
