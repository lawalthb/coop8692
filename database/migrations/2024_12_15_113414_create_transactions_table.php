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
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->morphs('transactionable');
            $table->string('type');
            $table->decimal('debit_amount', 15)->default(0);
            $table->decimal('credit_amount', 15)->default(0);
            $table->decimal('balance', 15)->default(0);
            $table->string('reference')->unique();
            $table->string('description');
            $table->unsignedBigInteger('posted_by')->index();
            $table->timestamp('transaction_date');
            $table->string('status')->default('completed');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
