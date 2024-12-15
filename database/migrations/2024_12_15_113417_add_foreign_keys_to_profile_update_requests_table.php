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
        Schema::table('profile_update_requests', function (Blueprint $table) {
            $table->foreign(['department_id'])->references(['id'])->on('departments')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['faculty_id'])->references(['id'])->on('faculties')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['lga_id'])->references(['id'])->on('lgas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['state_id'])->references(['id'])->on('states')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profile_update_requests', function (Blueprint $table) {
            $table->dropForeign('profile_update_requests_department_id_foreign');
            $table->dropForeign('profile_update_requests_faculty_id_foreign');
            $table->dropForeign('profile_update_requests_lga_id_foreign');
            $table->dropForeign('profile_update_requests_state_id_foreign');
            $table->dropForeign('profile_update_requests_user_id_foreign');
        });
    }
};
