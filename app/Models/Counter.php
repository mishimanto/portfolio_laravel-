<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    protected $fillable = [
        'counter_title',
        'counter_icon',
        'pre_value',
        'post_value',
        'order'
    ];
}
