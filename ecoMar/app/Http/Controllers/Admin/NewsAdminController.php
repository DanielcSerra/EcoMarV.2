<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Http\Request;


class NewsAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = News::class;
        $this->slug = 'news';
        $this->title = 'Notícias';
        $this->with = ['category', 'creator'];
        $this->order = ['date_upload', 'desc'];

        $this->fields = [
            'title' => [
                'label' => 'Título',
                'type' => 'text',
                'list' => true,
            ],
            'description' => [
                'label' => 'Descrição',
                'type' => 'textarea',
            ],
            'date_upload' => [
                'label' => 'Data',
                'type' => 'date',
                'list' => true,
            ],
            'author' => [
                'label' => 'Autor',
                'type' => 'text',
                'list' => true,
            ],
            'img_path' => [
                'label' => 'Imagem',
                'type' => 'file',
            ],
            'category_id' => [
                'label' => 'Categoria',
                'type' => 'select',
                'options' => [NewsCategory::class, 'name'],
                'display' => 'category.name',
                'list' => true,
            ],
            'user_id' => [
                'label' => 'Criado por',
                'type' => 'select',
                'options' => [User::class, 'name'],
                'display' => 'creator.name',
            ],
        ];

        $this->rules = [
            'store' => [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'date_upload' => 'required|date',
                'author' => 'required|string|max:255',
                'img_path' => 'nullable|image|max:5120',
                'category_id' => 'required|exists:news_categories,id',
                'user_id' => 'nullable|exists:users,id',
            ],
            'update' => [
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'date_upload' => 'required|date',
                'author' => 'required|string|max:255',
                'img_path' => 'nullable|image|max:5120',
                'remove_image' => 'nullable|boolean',
                'category_id' => 'required|exists:news_categories,id',
                'user_id' => 'nullable|exists:users,id',
            ],
        ];
    }

    protected function getSearchFields(): array
    {
        return ['title', 'description', 'author'];
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules['store']);

        if ($request->hasFile('img_path')) {
            $file = $request->file('img_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('news');
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            $file->move($path, $filename);
            $data['img_path'] = 'news/' . $filename;
        }

        $this->model::create($data);

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Notícia criada com sucesso.');
    }

    public function update(Request $request, int $id)
    {
        $item = $this->model::findOrFail($id);

        $data = $request->validate($this->rules['update']);

        if ($request->boolean('remove_image') && $item->img_path) {
            unlink(public_path($item->img_path));
            $data['img_path'] = null;
        }

        if ($request->hasFile('img_path')) {
            if ($item->img_path) {
                unlink(public_path($item->img_path));
            }
            $file = $request->file('img_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = public_path('news');
            if (!is_dir($path)) {
                mkdir($path, 0755, true);
            }
            $file->move($path, $filename);
            $data['img_path'] = 'news/' . $filename;
        }

        $item->update($data);

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Notícia atualizada.');
    }

    public function destroy(int $id)
    {
        $item = $this->model::findOrFail($id);

        if ($item->img_path) {
            unlink(public_path($item->img_path));
        }

        $item->delete();

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Notícia eliminada.');
    }
}
