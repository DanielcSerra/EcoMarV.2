<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

abstract class BaseAdminController extends Controller
{
    /** @var class-string<Model> */
    protected string $model;

    protected string $slug;
    protected string $title;
    protected string $description = '';

    protected array $fields = [];

    protected array $rules = [
        'store' => [],
        'update' => [],
    ];

    protected array $with = [];

    protected array $order = ['id', 'desc'];

    public function index(Request $request)
    {
        $query = $this->model::query();

        if (!empty($this->with)) {
            $query->with($this->with);
        }

        // Busca - pesquisa em campos especificados
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query = $this->applySearch($query, $search);
        }

        if (!empty($this->order)) {
            $query->orderBy($this->order[0], $this->order[1] ?? 'asc');
        }

        $items = $query->paginate(10);

        return view($this->viewPath('index'), $this->baseViewData([
            'items' => $items,
            'search' => $request->input('search'),
        ]));
    }

    protected function applySearch($query, $search)
    {
        // Campos padrão para busca - pode ser sobrescrito em subclasses
        $searchFields = $this->getSearchFields();

        if (empty($searchFields)) {
            return $query;
        }

        return $query->where(function ($q) use ($search, $searchFields) {
            foreach ($searchFields as $field) {
                // Se o campo contém um ponto, é uma relação
                if (strpos($field, '.') !== false) {
                    [$relation, $column] = explode('.', $field);
                    $q->orWhereHas($relation, function ($query) use ($column, $search) {
                        $query->where($column, 'LIKE', '%' . $search . '%');
                    });
                } else {
                    $q->orWhere($field, 'LIKE', '%' . $search . '%');
                }
            }
        });
    }

    protected function getSearchFields(): array
    {
        return [];
    }

    public function create()
    {
        return view($this->viewPath('create'), $this->baseViewData([
            'item' => null,
            'route' => route('admin.' . $this->slug . '.store'),
            'method' => 'POST',
            'options' => $this->optionsForFields(),
        ]));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules['store']);

        $this->model::create($data);

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Registo criado com sucesso.');
    }

    public function show(int $id)
    {
        $query = $this->model::query();

        if (!empty($this->with)) {
            $query->with($this->with);
        }

        $item = $query->findOrFail($id);

        return view($this->viewPath('show'), $this->baseViewData([
            'item' => $item,
        ]));
    }

    public function edit(int $id)
    {
        $query = $this->model::query();

        if (!empty($this->with)) {
            $query->with($this->with);
        }

        $item = $query->findOrFail($id);

        return view($this->viewPath('edit'), $this->baseViewData([
            'item' => $item,
            'route' => route('admin.' . $this->slug . '.update', $item->id),
            'method' => 'PUT',
            'options' => $this->optionsForFields(),
        ]));
    }

    public function update(Request $request, int $id)
    {
        $item = $this->model::findOrFail($id);

        $data = $request->validate($this->rules['update']);

        $item->update($data);

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Registo atualizado.');
    }

    public function destroy(int $id)
    {
        $item = $this->model::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Registo eliminado.');
    }

    protected function definition(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'fields' => $this->fields,
        ];
    }

    protected function viewPath(string $file): string
    {
        return '_admin.' . $this->slug . '.' . $file;
    }

    protected function baseViewData(array $extra = []): array
    {
        return array_merge([
            'resourceKey' => $this->slug,
            'resource' => $this->definition(),
        ], $extra);
    }

    protected function optionsForFields(): array
    {
        $options = [];

        foreach ($this->fields as $name => $field) {
            if (isset($field['options'])) {
                $options[$name] = $this->buildOptions($field['options']);
            }
        }

        return $options;
    }

    protected function buildOptions(array $config)
    {
        if (Arr::isAssoc($config)) {
            return $config;
        }

        if (count($config) === 2 && class_exists($config[0])) {
            [$class, $column] = $config;
            return $class::orderBy($column)->pluck($column, 'id');
        }

        return [];
    }
}
