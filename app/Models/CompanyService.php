<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyService extends Model
{
    use HasFactory;

    protected $fillable = [
        'desc_d',

        'title_td',
        'desc_td',

        'title_tdi_1',
        'desc_tdi_1',
        'image_tdi_1',

        'title_tdi_2',
        'desc_tdi_2',
        'image_tdi_2',
    ];
}
