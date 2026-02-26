<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorSignup extends Model
{
    protected $fillable = ['nome', 'email', 'mensagem'];
    public function sponsor()
{
    return $this->hasOne(Sponsor::class, 'signup_id');
}
}

