<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_title',
        'site_description',
        'background_image',
        'favicon',
        'show_social_icons'
    ];
}
