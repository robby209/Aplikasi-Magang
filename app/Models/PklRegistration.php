<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PklRegistration extends Model
{
    use HasFactory;

    protected $table = 'pkl_registrations';

    protected $fillable = [
        'user_id',
        'nama',
        'nim',
        'alamat',
        'pekerjaan',
        'fakultas',
        'instansi',
        'telepon',
        'proposal',
        'judul',
        'tujuan',
        'anggota',
        'start_date',
        'end_date',
        'status', // Ditambahkan
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
