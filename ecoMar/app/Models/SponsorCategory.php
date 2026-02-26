<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorCategory extends Model
{
    public $timestamps = false;

    
    protected $table = 'sponsors_categories';

    protected $fillable = [
        'name',
    ];

    
    public function sponsors()
    {
        return $this->hasMany(Sponsor::class, 'category_id');
    }
}