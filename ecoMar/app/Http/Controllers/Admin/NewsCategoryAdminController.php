<?php

namespace App\Http\Controllers\Admin;

use App\Models\NewsCategory;


class NewsCategoryAdminController extends BaseAdminController
{
    public function __construct()
    {

        $this->model = NewsCategory::class;
        $this->slug = 'news-categories';
        $this->title = 'Categorias de Notícias';

        $this->fields = [
            'name' => [
                'label' => 'Nome',
                'type' => 'text',
                'list' => true,
            ],
        ];

        $rules = [
            'name' => 'required|string|max:100',
        ];

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
