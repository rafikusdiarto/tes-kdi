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
        Schema::create('m_param', function (Blueprint $table) {
            $table->id('idprm');
            $table->string('pidprm', 20);
            $table->string('valprm', 50);
            $table->string('valprm1', 100)->nullable();
            $table->string('valprm2', 100)->nullable();
            $table->string('valprm3', 100)->nullable();
            $table->string('dscprm', 100);
            $table->integer('seqprm')->default(0);
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
        Schema::dropIfExists('m_param');
    }
};
