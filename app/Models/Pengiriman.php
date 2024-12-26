<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengiriman';
    protected $fillable = [
        'order_id',
        'tanggal_kirim',
        'tanggal_selesai',
        'status_pengiriman',
    ];

    public function orderMaterial()
    {
        return $this->belongsTo(OrderMaterial::class, 'order_id');
    }
    public function materialPemasok()
    {
        return $this->belongsTo(MaterialPemasok::class, 'material_id');
    }

    public function materialProyek()
    {
        return $this->hasMany(MaterialProyek::class, 'pengiriman_id');
    }
}
