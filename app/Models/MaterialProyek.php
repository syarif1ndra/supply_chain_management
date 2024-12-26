<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialProyek extends Model
{
    use HasFactory;

    protected $table = 'material_proyek';
    protected $fillable = [
        'nama_material',
        'stok',
        'order_id',
        'harga_satuan',
        'pengiriman_id',
        'material_id',
        'proyek_id'
    ];

    public function pengiriman()
    {
        return $this->belongsTo(Pengiriman::class, 'pengiriman_id');
    }

    public function orderMaterials()
    {
        return $this->belongsTo(OrderMaterial::class, 'order_id');
    }
    public function materialPemasok()
    {
        return $this->belongsTo(MaterialPemasok::class, 'material_id');
    }


    public function Proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }

    public function detailProyek()
    {
        return $this->hasMany(DetailProyek::class, 'material_id');
    }
}
