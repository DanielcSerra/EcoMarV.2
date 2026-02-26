<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'user_id', // Chave Estrangeira
        'date_start',
        'date_end',
        'title',
        'country',
        'description',
        'image',
        'goal',
        'goal_current',
        'is_large',
    ];

    public function user()
    {
        // Uma campanha pertence a um utilizador que a criou (FK user_id)
        return $this->belongsTo(User::class);
    }
}
