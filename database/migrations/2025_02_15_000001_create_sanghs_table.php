<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sanghs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('sangh_name')->nullable();
            $table->string('sangh_email')->nullable();
            $table->string('sangh_mobile')->nullable();
            $table->boolean('whatsapp')->default(false);
            $table->tinyInteger('sangh_type')->nullable()->comment('1: Type 1, 2: Type 2');
            $table->string('building_no')->nullable();
            $table->string('building_name')->nullable();
            $table->string('locality')->nullable();
            $table->string('landmark')->nullable();
            $table->string('pincode')->nullable();
            $table->string('district')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->default('India');
            $table->integer('jain_family_count')->nullable();
            $table->json('age_group')->nullable();
            $table->boolean('has_pathshala')->default(false);
            $table->string('pathshala_first_name')->nullable();
            $table->string('pathshala_last_name')->nullable();
            $table->string('pathshala_email')->nullable();
            $table->string('pathshala_phone')->nullable();
            $table->boolean('has_other_sangh')->default(false);
            $table->boolean('bus_transportation')->default(false);
            $table->boolean('train_transportation')->default(false);
            $table->string('sangh_address')->nullable();
            $table->string('reason_note')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sanghs');
    }
}; 