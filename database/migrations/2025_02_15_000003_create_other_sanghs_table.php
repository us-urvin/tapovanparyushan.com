<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('other_sanghs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sangh_id');
            $table->tinyInteger('particulars')->comment('1: Particular 1, 2: Particular 2, etc.');
            $table->integer('no_of_members');
            $table->integer('no_of_jain_families');
            $table->timestamps();
            $table->foreign('sangh_id')->references('id')->on('sanghs')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('other_sanghs');
    }
}; 