<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['center_id']);
            $table->dropColumn('center_id');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('center_id')->nullable()->after('sangh_id');
            $table->foreign('center_id')->references('id')->on('centers')->onDelete('set null');
        });
    }
}; 