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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties');
            $table->unsignedBigInteger('client_id')->index();
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->timestamp('scheduled_at');
            $table->enum('status', ["pending","approved","rejected","completed","cancelled"]);
            $table->text('notes')->nullable();
            $table->index(['property_id', 'scheduled_at']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};
