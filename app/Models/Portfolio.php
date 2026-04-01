<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'title',
        'image',
        'description',
        'client',
        'project_date',
        'project_url',
        'category_id',
        'order'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
