<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('bus_transportations', function (Blueprint $table) {
            $table->string('bus_name')->nullable()->after('to');
        });
    }

    public function down()
    {
        Schema::table('bus_transportations', function (Blueprint $table) {
            $table->dropColumn('bus_name');
        });
    }
}; 