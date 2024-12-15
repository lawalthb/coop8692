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
        Schema::create('shares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('shares_user_id_foreign');
            $table->integer('number_of_shares');
            $table->decimal('amount_per_share', 15);
            $table->decimal('total_amount', 15);
            $table->string('certificate_number')->unique();
            $table->string('status')->default('active');
            $table->unsignedBigInteger('posted_by')->index('shares_posted_by_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shares');
    }
};
