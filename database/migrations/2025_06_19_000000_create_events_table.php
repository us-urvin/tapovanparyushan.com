<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sangh_id')->constrained('sanghs')->onDelete('cascade');
            $table->string('event_year', 4)->nullable();
            $table->boolean('has_other_sangh')->default(false);
            $table->integer('jain_family_count')->nullable();
            $table->integer('member_count')->nullable();
            $table->boolean('willing_to_celebrate')->default(false);
            $table->json('contact_person')->nullable();
            $table->string('pravachan_language')->nullable();
            $table->boolean('pratikraman_proficient')->default(false);
            $table->boolean('pratikraman_present')->nullable();
            $table->integer('pratikraman_how_many')->nullable();
            $table->boolean('bhakti_musicians')->default(false);
            $table->boolean('bhakti_group')->default(false);
            $table->boolean('bhakti_instruments')->default(false);
            $table->string('bhakti_instrument_list')->nullable();
            $table->json('attendance')->nullable();
            $table->boolean('mahatma_sadhu')->default(false);
            $table->boolean('mahatma_sadhviji')->default(false);
            $table->boolean('mahatma_chaturmas')->default(false);
            $table->boolean('terms_agree')->default(false);
            $table->tinyInteger('status')->default(0)->comment('0: Pending, 1: Approved, 2: Rejected');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}; 