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
        Schema::create('profile_update_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index('profile_update_requests_user_id_foreign');
            $table->string('title')->nullable();
            $table->string('surname')->nullable();
            $table->string('firstname')->nullable();
            $table->string('othername')->nullable();
            $table->text('home_address')->nullable();
            $table->unsignedBigInteger('department_id')->nullable()->index('profile_update_requests_department_id_foreign');
            $table->unsignedBigInteger('faculty_id')->nullable()->index('profile_update_requests_faculty_id_foreign');
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();
            $table->string('nationality')->nullable();
            $table->unsignedBigInteger('state_id')->nullable()->index('profile_update_requests_state_id_foreign');
            $table->unsignedBigInteger('lga_id')->nullable()->index('profile_update_requests_lga_id_foreign');
            $table->string('nok')->nullable();
            $table->string('nok_relationship')->nullable();
            $table->text('nok_address')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('nok_phone')->nullable();
            $table->decimal('monthly_savings', 10)->nullable();
            $table->decimal('share_subscription', 10)->nullable();
            $table->string('month_commence')->nullable();
            $table->string('staff_no')->nullable();
            $table->string('signature_image')->nullable();
            $table->date('date_join')->nullable();
            $table->string('member_image')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_update_requests');
    }
};
