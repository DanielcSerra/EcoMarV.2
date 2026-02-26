<?php

namespace App\Http\Controllers\Admin;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = Donation::class;
        $this->slug = 'donations';
        $this->title = 'Donativos';
        $this->order = ['created_at', 'desc'];

        $this->fields = [
            'name' => ['label' => 'Nome', 'type' => 'text', 'list' => true],
            'num_donated' => ['label' => 'Valor', 'type' => 'number', 'step' => '0.01', 'list' => true],
            'created_at' => ['label' => 'Data', 'type' => 'datetime', 'list' => true, 'hide_in_form' => true],
        ];

        $this->rules = [
            'store' => [
                'name' => 'nullable|string|max:255',
                'num_donated' => 'required|numeric|min:0',
            ],
            'update' => [
                'name' => 'nullable|string|max:255',
                'num_donated' => 'required|numeric|min:0',
            ],
        ];
    }

    protected function getSearchFields(): array
    {
        return ['name'];
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules['store']);
        $data['name'] = $data['name'] ?: 'Anónimo';

        $this->model::create($data);

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Registo criado com sucesso.');
    }

    public function update(Request $request, int $id)
    {
        $donation = $this->model::findOrFail($id);

        $data = $request->validate($this->rules['update']);
        $data['name'] = $data['name'] ?: 'Anónimo';

        $donation->update($data);

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Registo atualizado.');
    }
}
