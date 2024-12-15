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
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('withdrawals_user_id_foreign');
            $table->unsignedBigInteger('saving_type_id')->index('withdrawals_saving_type_id_foreign');
            $table->string('reference')->unique();
            $table->decimal('amount', 12);
            $table->string('bank_name');
            $table->string('account_number');
            $table->string('account_name');
            $table->text('reason');
            $table->string('status')->default('pending');
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable()->index('withdrawals_approved_by_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
