<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pkl_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('nim');
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->string('fakultas'); // Bisa dinamai 'program_studi'
            $table->string('instansi');
            $table->string('telepon');
            $table->string('proposal'); // Menyimpan path file proposal (PDF)
            $table->string('judul');
            $table->text('tujuan');
            $table->string('anggota');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pkl_registrations');
    }
};
