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
        Schema::create('savings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('savings_user_id_foreign');
            $table->unsignedBigInteger('saving_type_id')->index('savings_saving_type_id_foreign');
            $table->decimal('amount', 15);
            $table->unsignedBigInteger('month_id')->index('savings_month_id_foreign');
            $table->unsignedBigInteger('year_id')->index('savings_year_id_foreign');
            $table->string('reference')->unique();
            $table->string('status')->default('completed');
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('posted_by')->index('savings_posted_by_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savings');
    }
};
