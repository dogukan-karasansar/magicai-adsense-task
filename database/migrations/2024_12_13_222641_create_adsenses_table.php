<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('adsenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // adsense creator
            $table->string('ad_site_url'); // adsense site url
            $table->tinyInteger('ad_position'); // adsense position from enum
            $table->string('ad_client'); // adsense client id
            $table->string('ad_slot'); // adsense identifier
            $table->tinyInteger('ad_format'); // adsense format from enum
            $table->tinyInteger('ad_status'); // adsense status from enum
            $table->boolean('ad_responsive')->default(true); // adsense responsive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adsenses');
    }
};
