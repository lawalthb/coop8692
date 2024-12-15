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
        Schema::table('loan_repayments', function (Blueprint $table) {
            $table->foreign(['loan_id'])->references(['id'])->on('loans')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['posted_by'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loan_repayments', function (Blueprint $table) {
            $table->dropForeign('loan_repayments_loan_id_foreign');
            $table->dropForeign('loan_repayments_posted_by_foreign');
        });
    }
};
