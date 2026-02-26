<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{

    protected $table = 'sponsors';

    // Desativa timestamps se não estiver usando created_at / updated_at
    public $timestamps = false;

    // Campos que podem ser preenchidos em massa
    protected $fillable = [
        'category_id', // FK para a categoria
        'name',
        'description',
        'img_path',
        'status',      // 1 = ativo, 0 = inativo
        'approved_by', // FK para User (pode ser NULL)
        'signup_id'    // FK para SponsorSignup
    ];

    /**
     *
     */
    public function category()
    {
        return $this->belongsTo(SponsorCategory::class, 'category_id');
    }

    public function signup()
    {
        return $this->belongsTo(SponsorSignup::class, 'signup_id');
    }

    /**
     *
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     *
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
