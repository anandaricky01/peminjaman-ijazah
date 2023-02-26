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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->char('nim')->length(20)->unique();
            $table->string('nama', 150);
            $table->bigInteger('id_person')->unsigned()->index();
            $table->foreign('id_person')->references('id')->on('persons')->onDelete('cascade');
            $table->bigInteger('id_fakultas')->unsigned()->index();
            $table->foreign('id_fakultas')->references('id')->on('fakultas')->onDelete('cascade');
            $table->bigInteger('id_prodi')->unsigned()->index();
            $table->foreign('id_prodi')->references('id')->on('prodi')->onDelete('cascade');
            $table->string('gender', 10);
            $table->string('alamat', 200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
};
