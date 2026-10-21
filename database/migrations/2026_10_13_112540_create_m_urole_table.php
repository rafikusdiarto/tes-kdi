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
        Schema::create('m_urole', function (Blueprint $table) {
            $table->id('idusrl');
            $table->unsignedBigInteger('idusr');
            $table->unsignedBigInteger('idrol');
            $table->unsignedBigInteger('crtby')->nullable();
            $table->timestamp('crtdt')->nullable();
            $table->unsignedBigInteger('updby')->nullable();
            $table->timestamp('upddt')->nullable();
            $table->foreign('idusr')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idrol')->references('idrol')->on('m_role')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_urole');
    }
};
