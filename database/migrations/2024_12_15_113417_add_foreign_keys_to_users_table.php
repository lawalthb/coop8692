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
        Schema::table('users', function (Blueprint $table) {
            $table->foreign(['approved_by'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['lga_id'])->references(['id'])->on('lgas')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['state_id'])->references(['id'])->on('states')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_approved_by_foreign');
            $table->dropForeign('users_lga_id_foreign');
            $table->dropForeign('users_state_id_foreign');
        });
    }
};
