<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    protected $table = 'm_uom';
    protected $primaryKey = 'iduom';

    const CREATED_AT = 'crtdt';
    const UPDATED_AT = 'upddt';

    protected $fillable = [
        'nmuom',
        'crtby',
        'updby',
    ];


}
