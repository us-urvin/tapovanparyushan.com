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
        // Update existing event records to remove specific attendance fields
        $events = DB::table('events')->whereNotNull('attendance')->get();
        
        foreach ($events as $event) {
            $attendance = json_decode($event->attendance, true);
            
            if ($attendance && is_array($attendance)) {
                // Remove specific fields
                if (isset($attendance['pratikraman']['afternoon'])) {
                    unset($attendance['pratikraman']['afternoon']);
                }
                if (isset($attendance['pravachan']['morning'])) {
                    unset($attendance['pravachan']['morning']);
                }
                if (isset($attendance['pravachan']['evening'])) {
                    unset($attendance['pravachan']['evening']);
                }
                if (isset($attendance['bhakti']['morning'])) {
                    unset($attendance['bhakti']['morning']);
                }
                if (isset($attendance['bhakti']['afternoon'])) {
                    unset($attendance['bhakti']['afternoon']);
                }
                if (isset($attendance['other']['morning'])) {
                    unset($attendance['other']['morning']);
                }
                
                // Update the record with cleaned attendance data
                DB::table('events')
                    ->where('id', $event->id)
                    ->update(['attendance' => json_encode($attendance)]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reverse this migration as we don't know the original values
        // This is a data cleanup migration
    }
};
