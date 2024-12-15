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
        Schema::create('loan_repayments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('loan_id')->index('loan_repayments_loan_id_foreign');
            $table->string('reference')->unique();
            $table->decimal('amount', 15);
            $table->date('payment_date');
            $table->string('payment_method');
            $table->string('status')->default('completed');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('posted_by')->index('loan_repayments_posted_by_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_repayments');
    }
};
