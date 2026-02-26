<?php

namespace App\Http\Controllers\Admin;

use App\Models\EventSuggestion;
use App\Models\User;

class EventSuggestionAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = EventSuggestion::class;
        $this->slug = 'event-suggestions';
        $this->title = 'Sugestões de Eventos';
        $this->with = ['user'];
        $this->order = ['created_at', 'desc'];

        $this->fields = [
            'user_id' => [
                'label' => 'Utilizador',
                'type' => 'select',
                'options' => [User::class, 'name'],
                'display' => 'user.name',
                'list' => true,
            ],
            'title' => ['label' => 'Título', 'type' => 'text', 'list' => true],
            'description' => ['label' => 'Descrição', 'type' => 'textarea'],
            'created_at' => ['label' => 'Criado em', 'type' => 'datetime', 'list' => true, 'hide_in_form' => true],
        ];

        $rules = [
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ];

        $this->rules = [
            'store' => $rules,
            'update' => $rules,
        ];
    }

    protected function getSearchFields(): array
    {
        return ['title', 'description'];
    }
}
