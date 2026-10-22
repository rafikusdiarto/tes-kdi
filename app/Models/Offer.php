<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    protected $table = 't_offer';
    protected $primaryKey = 'idofr';

    const CREATED_AT = 'crtdt';
    const UPDATED_AT = 'upddt';

    protected $fillable = [
        'idprod',
        'idvend',
        'iduom',
        'nmsales',
        'nosales',
        'qty',
        'ppn',
        'stsofr',
        'price',
        'exuom',
    ];

    public function uom()
    {
        return $this->belongsTo(Uom::class, 'iduom', 'iduom');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'idprod', 'idprod');
    }
    public function vendors()
    {
        return $this->belongsTo(Vendor::class, 'idvend', 'idvend');
    }

}
