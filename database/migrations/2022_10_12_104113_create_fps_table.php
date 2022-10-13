<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bps_id')->onDelete('cascade');
            $table->foreignId('kf_id')->onDelete('cascade');
            $table->string('no_surat');
            $table->timestamp('tanggal');
            $table->integer('jumlah');
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
        Schema::dropIfExists('fps');
    }
}
