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
        Schema::create('paket_wedding_foto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_wedding_id');
            $table->foreign('paket_wedding_id')->references('id')->on('paket_wedding')->onDelete('cascade');
            $table->string('name');
            $table->string('size');
            $table->string('url');
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
        Schema::dropIfExists('paket_wedding_foto');
    }
};
