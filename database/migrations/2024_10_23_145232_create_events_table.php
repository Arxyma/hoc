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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nama_event');
            $table->integer('kuota');
            $table->longText('description');
            $table->text('description')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->change();
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_berakhir');
            $table->time('start_time');
            $table->string('image');
            $table->string('tag');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Menandai pembuat event
            $table->foreignId('mentor_id')->constrained()->cascadeOnDelete(); // Menandai mentor yang terkait dengan event
            $table->timestamps();
        });
        Schema::table('events', function (Blueprint $table) {
            $table->longText('description')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
