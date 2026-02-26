<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\User;
use App\Models\News;

class CommentAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = Comment::class;
        $this->slug = 'comments';
        $this->title = 'Comentários';
        $this->with = ['user', 'news'];
        $this->order = ['id', 'desc'];

        $this->fields = [
            'user_id' => [
                'label' => 'Utilizador',
                'type' => 'select',
                'options' => [User::class, 'name'],
                'display' => 'user.name',
                'list' => true,
            ],
            'news_id' => [
                'label' => 'Notícia',
                'type' => 'select',
                'options' => [News::class, 'title'],
                'display' => 'news.title',
                'list' => true,
            ],
            'message' => [
                'label' => 'Comentário',
                'type' => 'textarea',
                'list' => true,
            ],
        ];

        $this->rules = [
            'store' => [
                'user_id' => 'required|exists:users,id',
                'news_id' => 'required|exists:news,id',
                'message' => 'required|string|max:1000',
            ],
            'update' => [
                'user_id' => 'required|exists:users,id',
                'news_id' => 'required|exists:news,id',
                'message' => 'required|string|max:1000',
            ],
        ];
    }

    protected function getSearchFields(): array
    {
        return ['message', 'user.name', 'news.title'];
    }
}
