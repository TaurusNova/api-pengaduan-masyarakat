<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $fillable = ['nik', 'judul_laporan', 'isi_laporan', 'foto', 'tipe', 'provinsi_kejadian', 'kota_kejadian', 'kecamatan_kejadian', 'status', 'tanggal_kejadian', 'tanggal_laporan', 'complaint_deleted'];
    public $timestamps = false;
}
