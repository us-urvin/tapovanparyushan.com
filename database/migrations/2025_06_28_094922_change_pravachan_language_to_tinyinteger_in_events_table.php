<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, convert existing string values to integers
        DB::table('events')->where('pravachan_language', 'Hindi')->update(['pravachan_language' => '1']);
        DB::table('events')->where('pravachan_language', 'Gujarati')->update(['pravachan_language' => '2']);
        DB::table('events')->where('pravachan_language', 'Both')->update(['pravachan_language' => '3']);
        
        // Convert any other string values to null for safety
        DB::table('events')
            ->whereNotIn('pravachan_language', ['1', '2', '3'])
            ->whereNotNull('pravachan_language')
            ->update(['pravachan_language' => null]);

        // Change the column type to tinyInteger
        Schema::table('events', function (Blueprint $table) {
            $table->tinyInteger('pravachan_language')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Change back to string
        Schema::table('events', function (Blueprint $table) {
            $table->string('pravachan_language')->nullable()->change();
        });

        // Convert integer values back to strings
        DB::table('events')->where('pravachan_language', 1)->update(['pravachan_language' => 'Hindi']);
        DB::table('events')->where('pravachan_language', 2)->update(['pravachan_language' => 'Gujarati']);
        DB::table('events')->where('pravachan_language', 3)->update(['pravachan_language' => 'Both']);
    }
};
