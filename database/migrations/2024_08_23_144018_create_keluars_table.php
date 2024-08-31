<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId("kategori_id");
            $table->foreignId("barang_id");
            $table->string("kode")->nullable();
            $table->text("gambar")->nullable();
            $table->text("nama");
            $table->integer("jumlah");
            $table->text("berat");
            $table->string("harga");
            $table->string("supplier");
            $table->string("tanggal");
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
        Schema::dropIfExists('keluars');
    }
}
