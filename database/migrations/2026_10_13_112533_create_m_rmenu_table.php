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
        Schema::create('m_rmenu', function (Blueprint $table) {
            $table->id('idrmn');
            $table->unsignedBigInteger('idrol');
            $table->unsignedBigInteger('idmnu');
            $table->boolean('viwrmn')->default(true);
            $table->boolean('insrmn')->default(true);
            $table->boolean('updrmn')->default(true);
            $table->boolean('delrmn')->default(true);
            $table->unsignedBigInteger('crtby')->nullable();
            $table->timestamp('crtdt')->nullable();
            $table->unsignedBigInteger('updby')->nullable();
            $table->timestamp('upddt')->nullable();
            $table->foreign('idrol')->references('idrol')->on('m_role')->onDelete('cascade');
            $table->foreign('idmnu')->references('idmnu')->on('m_menu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_rmenu');
    }
};
