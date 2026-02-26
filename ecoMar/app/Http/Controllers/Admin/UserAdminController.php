<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\EventSuggestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = User::class;
        $this->slug = 'users';
        $this->title = 'Utilizadores';

        $this->fields = [
            'name' => ['label' => 'Nome', 'type' => 'text', 'list' => true],
            'email' => ['label' => 'Email', 'type' => 'email', 'list' => true],
            'phone' => ['label' => 'Telefone', 'type' => 'text'],
            'location' => ['label' => 'Localização', 'type' => 'text'],
            'dob' => ['label' => 'Data de nascimento', 'type' => 'date'],
            'img_path' => ['label' => 'Foto de perfil', 'type' => 'file'],
            'type' => [
                'label' => 'Tipo',
                'type' => 'select',
                'options' => ['A' => 'Administrador', 'F' => 'Funcionário', 'U' => 'Utilizador'],
                'list' => true,
            ],
            'password' => [
                'label' => 'Password',
                'type' => 'password',
                'hide_on_show' => true,
            ],
        ];
        $this->rules = [
            'store' => [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'phone' => 'nullable|digits:9',
                'location' => 'nullable|string|max:255',
                'dob' => 'nullable|date',
                'img_path' => 'nullable|image|max:3072',
                'type' => 'required|in:A,F,U',
                'password' => 'required|string|min:8',
            ],
        ];
    }

    protected function getSearchFields(): array
    {
        return ['name', 'email', 'location'];
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules['store']);

        // password sempre encriptada
        $data['password'] = Hash::make($data['password']);

        // upload opcional da imagem
        if ($request->hasFile('img_path')) {
            $data['img_path'] = $request->file('img_path')->store('profile_img', 'public');
        }

        $this->model::create($data);

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Registo criado com sucesso.');
    }

    public function destroy(int $id)
    {
        $hasRelations =
            EventRegistration::where('user_id', $id)->exists() ||
            EventSuggestion::where('user_id', $id)->exists() ||
            Event::where('created_by', $id)->exists();

        if ($hasRelations) {
            return back()->withErrors('Não é possível eliminar este utilizador porque tem registos associados.');
        }

        $user = $this->model::findOrFail($id);

        if ($user->img_path) {
            Storage::disk('public')->delete($user->img_path);
        }

        $user->delete();

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Registo eliminado.');
    }

    public function update(Request $request, int $id)
    {
        $user = $this->model::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|digits:9',
            'location' => 'nullable|string|max:255',
            'dob' => 'nullable|date',
            'img_path' => 'nullable|image|max:3072',
            'remove_image' => 'nullable|boolean',
            'type' => 'required|in:A,F,U',
            'password' => 'nullable|string|min:8',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('img_path')) {
            if ($user->img_path) {
                Storage::disk('public')->delete($user->img_path);
            }
            $data['img_path'] = $request->file('img_path')->store('profile_img', 'public');
        }

        if ($request->boolean('remove_image')) {
            if ($user->img_path) {
                Storage::disk('public')->delete($user->img_path);
            }
            $data['img_path'] = null;
        }

        $user->update($data);

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Registo atualizado.');
    }
}
