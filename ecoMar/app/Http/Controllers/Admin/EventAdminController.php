<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\User;

class EventAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = Event::class;
        $this->slug = 'events';
        $this->title = 'Eventos';
        $this->with = ['category', 'creator'];
        $this->order = ['event_date', 'desc'];

        $this->fields = [
            'title' => ['label' => 'Título', 'type' => 'text', 'list' => true],
            'description' => ['label' => 'Descrição', 'type' => 'textarea'],
            'event_date' => ['label' => 'Data', 'type' => 'date', 'list' => true],
            'event_time' => ['label' => 'Hora', 'type' => 'time', 'list' => true],
            'location' => ['label' => 'Local', 'type' => 'text', 'list' => true],
            'img_path' => ['label' => 'Imagem', 'type' => 'file'],
            'category_id' => [
                'label' => 'Categoria',
                'type' => 'select',
                'options' => [EventCategory::class, 'name'],
                'display' => 'category.name',
                'list' => true,
            ],
            'created_by' => [
                'label' => 'Criado por',
                'type' => 'select',
                'options' => [User::class, 'name'],
                'display' => 'creator.name',
            ],
        ];

        $this->rules = [
            'store' => [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'event_date' => 'required|date',
                'event_time' => 'required|date_format:H:i',
                'location' => 'required|string|max:255',
                'img_path' => 'nullable|image|max:5120',
                'category_id' => 'required|exists:event_categories,id',
                'created_by' => 'nullable|exists:users,id',
            ],
            'update' => [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'event_date' => 'required|date',
                'event_time' => 'required|date_format:H:i',
                'location' => 'required|string|max:255',
                'img_path' => 'nullable|image|max:5120',
                'remove_image' => 'nullable|boolean',
                'category_id' => 'required|exists:event_categories,id',
                'created_by' => 'nullable|exists:users,id',
            ],
        ];
    }

    protected function getSearchFields(): array
    {
        return ['title', 'description', 'location'];
    }
}
