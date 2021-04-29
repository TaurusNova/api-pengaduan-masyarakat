<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = ['id_pengaduan', 'tgl_tanggapan', 'tanggapan', 'id_petugas'];
    public $timestamps = false;
}
