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
        Schema::table('savings', function (Blueprint $table) {
            $table->foreign(['month_id'])->references(['id'])->on('months')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['posted_by'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['saving_type_id'])->references(['id'])->on('saving_types')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['year_id'])->references(['id'])->on('years')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('savings', function (Blueprint $table) {
            $table->dropForeign('savings_month_id_foreign');
            $table->dropForeign('savings_posted_by_foreign');
            $table->dropForeign('savings_saving_type_id_foreign');
            $table->dropForeign('savings_user_id_foreign');
            $table->dropForeign('savings_year_id_foreign');
        });
    }
};
