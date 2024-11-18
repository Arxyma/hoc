<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->unsignedInteger('jml_anggota')->nullable()->after('thumbnail'); // Tambahkan kolom jml_anggota yang dapat dikosongi
        });
    }

    public function down()
    {
        Schema::table('communities', function (Blueprint $table) {
            $table->dropColumn('jml_anggota');
        });
    }
};
