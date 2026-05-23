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
        Schema::table('deposits', function (Blueprint $table) {
        // ربط العربون بالعرض
        $table->unsignedBigInteger('offer_id')->nullable()->after('client_id');
        $table->foreign('offer_id')->references('id')->on('offers')->onDelete('set null');

        // إضافة طريقة الدفع (مهمة جداً للتقارير)
        $table->enum('payment_method', ['cash', 'bank_transfer', 'online'])
              ->default('bank_transfer')
              ->after('amount');
    });
    }

    /**
     * 
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropForeign(['offer_id']);
        $table->dropColumn('offer_id');
        $table->dropColumn('payment_method');
    }
};
