<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    protected $fillable = ['nik', 'nama', 'username', 'password', 'telp'];
    public $timestamps = false;
}
