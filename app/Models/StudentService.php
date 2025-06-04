<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentService extends Model
{
    use HasFactory;

    protected $fillable = [
        'desc_di',
        'image_di',

        'title_td_1',
        'desc_td_1',
        'title_td_2',
        'desc_td_2',
        'title_td_3',
        'desc_td_3',

        'title_tdi_1',
        'desc_tdi_1',
        'image_tdi_1',
        'title_tdi_2',
        'desc_tdi_2',
        'image_tdi_2',
    ];
}
