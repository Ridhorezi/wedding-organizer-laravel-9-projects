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
        Schema::create('web', function (Blueprint $table) {
            $table->id();
            $table->string('logo', '200');
            $table->string('name', '200');
            $table->text('description');
            $table->string('address', '200');
            $table->string('email', '100')->nullable();
            $table->string('facebook', '100')->nullable();
            $table->string('instagram', '100')->nullable();
            $table->string('youtube', '100')->nullable();
            $table->string('twitter', '100')->nullable();
            $table->string('whatsapp', '100')->nullable();
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
        Schema::dropIfExists('web');
    }
};
