<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('train_transportations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sangh_id');
            $table->string('from');
            $table->string('train_name');
            $table->string('train_number')->nullable();
            $table->string('to');
            $table->timestamps();
            $table->foreign('sangh_id')->references('id')->on('sanghs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('train_transportations');
    }
}; 