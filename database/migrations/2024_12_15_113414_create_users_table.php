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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('title', ['Arc.', 'Bldr.', 'Dr.', 'Engr.', 'Mr.', 'Mrs.', 'Ms.', 'Pharm.', 'Prof.', 'Pst.', 'Rev.', 'Surv', 'Qs.', 'Tpl', 'Esv.']);
            $table->string('surname');
            $table->string('firstname');
            $table->string('othername')->nullable();
            $table->string('facebook')->nullable();
            $table->text('home_address')->nullable();
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->date('dob')->nullable();
            $table->string('nationality')->nullable();
            $table->unsignedBigInteger('state_id')->index('users_state_id_foreign');
            $table->unsignedBigInteger('lga_id')->index('users_lga_id_foreign');
            $table->string('nok')->nullable();
            $table->string('nok_relationship')->nullable();
            $table->text('nok_address')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('nok_phone')->nullable();
            $table->decimal('monthly_savings', 10)->nullable();
            $table->decimal('share_subscription', 10)->nullable();
            $table->string('month_commence')->nullable();
            $table->string('signature_image')->nullable();
            $table->date('date_join')->nullable();
            $table->text('admin_remark')->nullable();
            $table->enum('admin_sign', ['Yes', 'No'])->default('No');
            $table->timestamp('admin_signdate')->nullable();
            $table->string('member_no')->unique();
            $table->string('gensec_sign_image')->nullable();
            $table->string('president_sign')->nullable();
            $table->string('member_image')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable()->index('users_approved_by_foreign');
            $table->rememberToken();
            $table->boolean('membership_declaration')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
