<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $table = 'm_product';
    protected $primaryKey = 'idprod';

    const CREATED_AT = 'crtdt';
    const UPDATED_AT = 'upddt';

    protected $fillable = [
        'nmprod',
        'typprod',
        'iduom',
        'crtby',
        'updby',
    ];

    public function uom()
    {
        return $this->belongsTo(Uom::class, 'iduom', 'iduom');
    }

}
