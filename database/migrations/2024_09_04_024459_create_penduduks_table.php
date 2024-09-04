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
        Schema::create('tb_penduduk', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->enum('jns_kelamin', ['L', 'P']);
            $table->string('tmp_lahir', 100);
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_penduduk');
    }
};
