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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->foreign('property_id')->references('id')->on('properties');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->decimal('amount', 15, 2);
            $table->enum('status', ["pending","approved","rejected","refunded"]);
            $table->string('receipt_url', 255)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->index(['property_id', 'status']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
