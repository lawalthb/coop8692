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
        Schema::table('loans', function (Blueprint $table) {
            $table->foreign(['approved_by'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['loan_type_id'])->references(['id'])->on('loan_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['posted_by'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loans', function (Blueprint $table) {
            $table->dropForeign('loans_approved_by_foreign');
            $table->dropForeign('loans_loan_type_id_foreign');
            $table->dropForeign('loans_posted_by_foreign');
            $table->dropForeign('loans_user_id_foreign');
        });
    }
};
