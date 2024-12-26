<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrak extends Model
{
    use HasFactory;

    protected $table = 'kontrak';

    protected $fillable = [
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'bukti_kontrak',
        'user_id',
    ];

    public function pemasok()
    {
        return $this->hasMany(Pemasok::class, 'kontrak_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
