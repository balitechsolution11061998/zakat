<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahik extends Model
{
    use HasFactory;


    protected $guarded = [];
    protected $table = 'mustahik';

    public function kategori_mustahik()
{
    return $this->belongsTo(KategoriMustahik::class, 'kategori_mustahik');
}
}
