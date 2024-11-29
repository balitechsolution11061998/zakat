<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanZakat extends Model
{
    use HasFactory;


    protected $guarded = [];
    protected $table = 'pengumpulan_zakat';

    public function muzzaki()
    {
        return $this->belongsTo(Muzakki::class, 'nama_muzakki', 'id'); // sesuaikan field foreign key
    }
}
