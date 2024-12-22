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
        Schema::create('loan_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('required_active_savings_months')->default(6);
            $table->decimal('savings_multiplier', 5)->default(2);
            $table->decimal('interest_rate', 5)->default(10);

            $table->integer('max_duration_months')->default(4);
            $table->decimal('minimum_amount', 15);
            $table->decimal('maximum_amount', 15);
            $table->boolean('allow_early_payment')->default(true);
            $table->enum('saved_percentage', ['50', '100', '150', '200', '250', '300', 'None'])->default('None');
            $table->integer('no_guarantors')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_types');
    }
};
