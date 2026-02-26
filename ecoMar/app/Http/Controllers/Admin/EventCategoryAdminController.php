<?php

namespace App\Http\Controllers\Admin;

use App\Models\EventCategory;

class EventCategoryAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = EventCategory::class;
        $this->slug = 'event-categories';
        $this->title = 'Categorias de Eventos';
        $this->fields = [
            'name' => ['label' => 'Nome', 'type' => 'text', 'list' => true],
        ];

        $rules = ['name' => 'required|string|max:100'];
        $this->rules = [
            'store' => $rules,
            'update' => $rules,
        ];
    }

    protected function getSearchFields(): array
    {
        return ['name'];
    }
}
