<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
    public function news()
    {
        // Uma categoria de notícia tem muitas notícias
        return $this->hasMany(News::class);
    }
}
