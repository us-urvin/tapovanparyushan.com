<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('train_transportations', function (Blueprint $table) {
            $table->string('train_number')->nullable()->after('train_name');
        });
    }

    public function down()
    {
        Schema::table('train_transportations', function (Blueprint $table) {
            $table->dropColumn('train_number');
        });
    }
}; 