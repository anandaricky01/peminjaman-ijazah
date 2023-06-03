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
        Schema::create('riwayat_peminjamen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mahasiswa');
            $table->string('nim');
            $table->string('no_ijazah');
            $table->string('nama_peminjam', 150);
            $table->string('no_telp', 50);
            $table->string('hubungan', 50);
            $table->date('tgl_pinjam')->nullable();
            $table->date('tgl_kembali')->nullable();
            $table->string('ket', 250)->nullable();
            $table->string('keperluan', 250)->nullable();
            $table->boolean('surat_kuasa')->nullable();
            $table->enum('status', ['Tervalidasi', 'Pending', 'Tidak Tervalidasi']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_peminjamen');
    }
};
