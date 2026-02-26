<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use App\Models\User;

class CampaignAdminController extends BaseAdminController
{
	public function __construct()
	{
		$this->model = Campaign::class;
		$this->slug = 'campaigns';
		$this->title = 'Campanhas';
		$this->with = ['user'];
		$this->order = ['date_start', 'desc'];

		$this->fields = [
			'title' => ['label' => 'Título', 'type' => 'text', 'list' => true],
			'description' => ['label' => 'Descrição', 'type' => 'textarea'],
			'date_start' => ['label' => 'Data de Início', 'type' => 'date', 'list' => true],
			'date_end' => ['label' => 'Data de Fim', 'type' => 'date', 'list' => true],
			'country' => ['label' => 'País', 'type' => 'text', 'list' => true],
			'image' => ['label' => 'Imagem', 'type' => 'file'],
			'goal' => ['label' => 'Meta (kg)', 'type' => 'number', 'list' => true],
			'goal_current' => ['label' => 'Meta Atual (kg)', 'type' => 'number', 'list' => true],
			'is_large' => ['label' => 'Campanha Grande', 'type' => 'checkbox', 'list' => true],
		];

		$this->rules = [
			'store' => [
				'title' => 'required|string|max:255',
				'description' => 'nullable|string',
				'date_start' => 'required|date',
				'date_end' => 'nullable|date|after_or_equal:date_start',
				'country' => 'required|string|max:255',
				'image' => 'nullable|image|max:5120',
				'goal' => 'required|numeric|min:0',
				'goal_current' => 'nullable|numeric|min:0',
				'is_large' => 'nullable|boolean',
			],
			'update' => [
				'title' => 'required|string|max:255',
				'description' => 'nullable|string',
				'date_start' => 'required|date',
				'date_end' => 'nullable|date|after_or_equal:date_start',
				'country' => 'required|string|max:255',
				'image' => 'nullable|image|max:5120',
				'remove_image' => 'nullable|boolean',
				'goal' => 'required|numeric|min:0',
				'goal_current' => 'nullable|numeric|min:0',
				'is_large' => 'nullable|boolean',
			],
		];
	}

	public function store(\Illuminate\Http\Request $request)
	{
		$data = $request->validate($this->rules['store']);
		$data['user_id'] = auth()->id();

		if ($request->hasFile('image')) {
			$data['image'] = $request->file('image')->store('campaigns', 'public');
		}

		$this->model::create($data);

		return redirect()->route('admin.' . $this->slug . '.index')
			->with('success', 'Item criado com sucesso!');
	}

	public function update(\Illuminate\Http\Request $request, int $id)
	{
		$item = $this->model::findOrFail($id);
		$data = $request->validate($this->rules['update']);

		if ($request->hasFile('image')) {
			$data['image'] = $request->file('image')->store('campaigns', 'public');
		} elseif (isset($data['remove_image']) && $data['remove_image']) {
			$data['image'] = null;
		}

		$item->update($data);

		return redirect()->route('admin.' . $this->slug . '.index')
			->with('success', 'Item atualizado com sucesso!');
	}

	protected function getSearchFields(): array
	{
		return ['title', 'description', 'country'];
	}
}
