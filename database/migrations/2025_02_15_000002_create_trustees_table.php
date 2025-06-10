<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trustees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sangh_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
            $table->foreign('sangh_id')->references('id')->on('sanghs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('trustees');
    }
}; 