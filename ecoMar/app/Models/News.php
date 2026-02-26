<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $fillable = [
        'user_id', // Chave Estrangeira
        'category_id', // Chave Estrangeira
        'date_upload',
        'author',
        'title',
        'description',
        'img_path',
    ];
    public function user()
    {
        // Uma notícia pertence a um utilizador (FK user_id)
        return $this->belongsTo(User::class);
    }

    public function author()
    {
        // Alias de user() para compatibilidade com controladores/listas
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        // Uma notícia pertence a uma categoria (FK category_id)
        return $this->belongsTo(NewsCategory::class);
    }

      public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id'); // diz que creator_id aponta para a tabela users
    }

}



