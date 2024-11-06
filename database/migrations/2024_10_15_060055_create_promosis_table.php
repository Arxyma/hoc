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
        Schema::create('promosis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            // $table->string('foto_produk', 255);
            $table->json('foto_produk')->nullable(); // Mengganti tipe kolom menjadi JSON
            $table->string('status')->default('pending'); // Status default adalah "pending"
            $table->timestamps();

        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promosis');
        Schema::table('promosi', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
