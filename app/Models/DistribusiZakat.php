<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiZakat extends Model
{
    use HasFactory;


    protected $guarded = [];
    protected $table = 'distribusi_zakat';

    public function mustahik()
    {
        return $this->belongsTo(Mustahik::class, 'nama_mustahik', 'id'); // sesuaikan field foreign key
    }
}
