<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialPemasok extends Model
{
    use HasFactory;

    protected $table = 'material_pemasok';
    protected $fillable = [
        'nama_material',
        'stok',
        'harga_satuan',
        'jenis_material',
        'pemasok_id'
    ];

    public function pengiriman()
    {
        return $this->hasMany(Pengiriman::class, 'pengiriman_id');
    }

    public function orderMaterials()
    {
        return $this->hasMany(OrderMaterial::class, 'material_id', 'id');
    }

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class, 'pemasok_id');
    }
}
