<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'm_menu';
    protected $primaryKey = 'idmnu';

    const CREATED_AT = 'crtdt';
    const UPDATED_AT = 'upddt';

    protected $fillable = [
        'nmmnu',
        'urlmnu',
        'icnmnu',
        'grpmnu',
        'prnmnu',
        'ordmnu',
        'crtby',
        'updby',
    ];
}
