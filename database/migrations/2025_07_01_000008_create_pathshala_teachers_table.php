<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pathshala_teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sangh_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
            $table->foreign('sangh_id')->references('id')->on('sanghs')->onDelete('cascade');
        });

        Schema::table('sanghs', function (Blueprint $table) {
            $table->dropColumn(['pathshala_first_name', 'pathshala_last_name', 'pathshala_email', 'pathshala_phone']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('pathshala_teachers');
        Schema::table('sanghs', function (Blueprint $table) {
            $table->string('pathshala_first_name')->nullable();
            $table->string('pathshala_last_name')->nullable();
            $table->string('pathshala_email')->nullable();
            $table->string('pathshala_phone')->nullable();
        });
    }
}; 