<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimony;
use App\Models\User;
use Illuminate\Http\Request;

class TestimonyAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = Testimony::class;
        $this->slug = 'testimonies';
        $this->title = 'Depoimentos';
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
            'message' => ['label' => 'Mensagem', 'type' => 'textarea'],
            'is_approved' => ['label' => 'Aprovado', 'type' => 'checkbox', 'list' => true],
            'created_at' => ['label' => 'Criado em', 'type' => 'datetime', 'list' => true, 'hide_in_form' => true],
        ];

        $this->rules = [
            'store' => [
                'user_id' => 'required|exists:users,id',
                'message' => 'required|string|min:10|max:300',
                'is_approved' => 'nullable|boolean',
            ],
            'update' => [
                'user_id' => 'required|exists:users,id',
                'message' => 'required|string|min:10|max:300',
                'is_approved' => 'nullable|boolean',
            ],
        ];
    }

    protected function getSearchFields(): array
    {
        return ['message', 'user.name'];
    }
}

