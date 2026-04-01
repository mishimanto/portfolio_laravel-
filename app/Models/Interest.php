<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = [
        'interest_title',
        'interest_icon',
        'color',
        'order'
    ];
}
