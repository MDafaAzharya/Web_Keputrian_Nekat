<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_report', function (Blueprint $table) {
            $table->id(); // Kolom id auto-increment
            $table->date('date'); // Kolom tanggal
            $table->string('jenis_kegiatan'); // Kolom jenis kegiatan
            $table->string('lokasi'); // Kolom lokasi
            $table->text('keterangan'); // Kolom keterangan
            $table->string('image'); // Kolom foto
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_report');
    }
};
