<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bus_transportations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sangh_id');
            $table->string('from');
            $table->string('to');
            $table->string('bus_name')->nullable();
            $table->timestamps();
            $table->foreign('sangh_id')->references('id')->on('sanghs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bus_transportations');
    }
}; 