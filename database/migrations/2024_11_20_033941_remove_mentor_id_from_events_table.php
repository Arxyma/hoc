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
        Schema::table('events', function (Blueprint $table) {
            // Hapus foreign key constraint
            $table->dropForeign(['mentor_id']);

            // Hapus kolom mentor_id
            $table->dropColumn('mentor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Tambahkan kembali kolom mentor_id
            $table->unsignedBigInteger('mentor_id')->nullable();

            // Tambahkan kembali foreign key constraint
            $table->foreign('mentor_id')->references('id')->on('mentors')->onDelete('cascade');
        });
    }
};
