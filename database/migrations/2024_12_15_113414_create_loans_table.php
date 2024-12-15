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
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('loans_user_id_foreign');
            $table->unsignedBigInteger('loan_type_id')->index('loans_loan_type_id_foreign');
            $table->string('reference')->unique();
            $table->decimal('amount', 15);
            $table->decimal('interest_amount', 15);
            $table->decimal('total_amount', 15);
            $table->decimal('monthly_payment', 15);
            $table->decimal('paid_amount', 15)->default(0);
            $table->integer('duration');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'approved', 'active', 'completed', 'rejected', 'cancelled'])->default('pending');
            $table->text('purpose');
            $table->text('rejection_reason')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable()->index('loans_approved_by_foreign');
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('posted_by')->index('loans_posted_by_foreign');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
