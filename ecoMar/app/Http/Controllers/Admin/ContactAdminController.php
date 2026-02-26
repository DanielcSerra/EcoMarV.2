<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;

class ContactAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = Contact::class;
        $this->slug = 'contacts';
        $this->title = 'Contactos';
        $this->order = ['created_at', 'desc'];

        $this->fields = [
            'name' => ['label' => 'Nome', 'type' => 'text', 'list' => true],
            'email' => ['label' => 'Email', 'type' => 'email', 'list' => true],
            'title' => ['label' => 'Assunto', 'type' => 'text', 'list' => true],
            'message' => ['label' => 'Mensagem', 'type' => 'textarea'],
            'created_at' => ['label' => 'Recebido em', 'type' => 'datetime', 'list' => true, 'hide_in_form' => true],
        ];

        $this->rules = [
            'store' => [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'title' => 'required|string|max:255',
                'message' => 'required|string',
            ],
            'update' => [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'title' => 'required|string|max:255',
                'message' => 'required|string',
            ],
        ];
    }

    protected function getSearchFields(): array
    {
        return ['name', 'email', 'title', 'message'];
    }
}
