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
        Schema::create('share_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('share_transactions_user_id_foreign');
            $table->string('transaction_type');
            $table->integer('number_of_shares');
            $table->decimal('amount', 15);
            $table->string('reference')->unique();
            $table->string('status')->default('completed');
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('posted_by')->index('share_transactions_posted_by_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('share_transactions');
    }
};
