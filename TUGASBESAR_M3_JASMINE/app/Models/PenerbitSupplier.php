<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerbitSupplier extends Model
{
    protected $fillable = [
        'nama_penerbit',
        'nama_supplier',
        'kontak_sales',
        'alamat',
        'status',
    ];
}