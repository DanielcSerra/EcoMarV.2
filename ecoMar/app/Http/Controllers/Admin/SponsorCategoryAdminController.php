<?php

namespace App\Http\Controllers\Admin;

use App\Models\SponsorCategory;

class SponsorCategoryAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = SponsorCategory::class;
        $this->slug = 'sponsor-categories';
        $this->title = 'Categorias de Patrocinadores';
        $this->order = ['id', 'desc'];

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