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

        Schema::create('data_siswa', function (Blueprint $table) {
        $table->id(); // BIGINT UNSIGNED

        $table->string('nama_siswa');
        $table->integer('NIS')->unique();
        $table->string('rombel');
        $table->string('Rayon');
        $table->bigInteger('new_column')->nullable();

       $table->foreignId('id_user')->constrained('users', 'id_user')->onDelete('cascade');

        $table->binary('PFP')->nullable();

        $table->foreignId('id_portofolio')->nullable()->constrained('portofolios', 'id_portofolio');
        $table->foreignId('id_sertifikat')->nullable()->constrained('sertifikats', 'id_sertifikat');

        
        $table->timestamps();
    });


        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_siswa');
    }
};
