<?php

namespace App\Http\Controllers\Admin;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = Newsletter::class;
        $this->slug = 'newsletters';
        $this->title = 'Newsletters';
        $this->order = ['created_at', 'desc'];

        $this->fields = [
            'email' => ['label' => 'Email', 'type' => 'email', 'list' => true],
            'created_at' => ['label' => 'Criado em', 'type' => 'datetime', 'list' => true, 'hide_in_form' => true],
        ];

        $this->rules = [
            'store' => [
                'email' => 'required|email|unique:newsletters,email',
            ],

        ];
    }

    public function update(Request $request, int $id)
    {
        $item = $this->model::findOrFail($id);

        $data = $request->validate([
            'email' => 'required|email|unique:newsletters,email,' . $id,
        ]);

        $item->update($data);

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Registo atualizado.');
    }

    protected function getSearchFields(): array
    {
        return ['email'];
    }
}
