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
        Schema::disableForeignKeyConstraints();

        Schema::create('portofolio', function (Blueprint $table) {
            $table->id('id_portofolio'); // BIGINT UNSIGNED
            $table->string('nama');
            $table->string('deskripsi');
            $table->string('durasiPengerjaan');
            $table->dateTime('timestamp');
            $table->string('linkPortofolio');
            $table->binary('gambar');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portofolio');
    }
};
