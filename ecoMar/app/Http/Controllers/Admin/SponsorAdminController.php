<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsor;
use App\Models\SponsorCategory;
use App\Models\User;

class SponsorAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = Sponsor::class;
        $this->slug = 'sponsors';
        $this->title = 'Patrocinadores';
        $this->with = ['category'];
        $this->order = ['id', 'desc'];

        $this->fields = [
            'name' => ['label' => 'Nome', 'type' => 'text', 'list' => true],
            'description' => ['label' => 'Descrição', 'type' => 'textarea'],
            'category_id' => [
                'label' => 'Categoria',
                'type' => 'select',
                'options' => [SponsorCategory::class, 'name'],
                'display' => 'category.name',
                'list' => true,
            ],
            'status' => ['label' => 'Ativo', 'type' => 'checkbox', 'list' => true],
            'approved_by' => [
                'label' => 'Aprovado por',
                'type' => 'select',
                'options' => [User::class, 'name'],
            ],
            'img_path' => ['label' => 'Imagem', 'type' => 'file'],
        ];

        $this->rules = [
            'store' => [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:sponsors_categories,id',
                'status' => 'nullable|boolean',
                'approved_by' => 'nullable|exists:users,id',
                'img_path' => 'nullable|image|max:5120',
            ],
            'update' => [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'category_id' => 'required|exists:sponsors_categories,id',
                'status' => 'nullable|boolean',
                'approved_by' => 'nullable|exists:users,id',
                'img_path' => 'nullable|image|max:5120',
                'remove_image' => 'nullable|boolean',
            ],
        ];
    }

    protected function getSearchFields(): array
    {
        return ['name', 'description', 'category.name'];
    }
}