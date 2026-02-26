<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\User;
use Illuminate\Http\Request;

class EventRegistrationAdminController extends BaseAdminController
{
    public function __construct()
    {
        $this->model = EventRegistration::class;
        $this->slug = 'event-registrations';
        $this->title = 'Inscrições em Eventos';
        $this->with = ['user', 'event'];

        $this->fields = [
            'user_id' => [
                'label' => 'Utilizador',
                'type' => 'select',
                'options' => [User::class, 'name'],
                'display' => 'user.name',
                'list' => true,
            ],
            'event_id' => [
                'label' => 'Evento',
                'type' => 'select',
                'options' => [Event::class, 'title'],
                'display' => 'event.title',
                'list' => true,
            ],
            'created_at' => [
                'label' => 'Criado em',
                'type' => 'datetime',
                'list' => true,
                'hide_in_form' => true,
            ],
        ];
    }

    protected function getSearchFields(): array
    {
        return ['user.name', 'event.title'];
    }

    public function store(Request $request)
    {
        $rules = [
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id|unique:event_registrations,user_id,NULL,id,event_id,' . $request->input('event_id'),
            'created_at' => 'nullable|date',
        ];

        $data = $request->validate($rules);

        // opcional: se não vier, define agora
        $data['created_at'] = $data['created_at'] ?? now();

        $this->model::create($data);

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Registo criado com sucesso.');
    }

    public function update(Request $request, int $id)
    {
        $item = $this->model::findOrFail($id);

        $rules = [
            'event_id' => 'required|exists:events,id',
            'user_id' => 'required|exists:users,id|unique:event_registrations,user_id,' . $id . ',id,event_id,' . $request->input('event_id'),
            'created_at' => 'nullable|date',
        ];

        $data = $request->validate($rules);

        $item->update($data);

        return redirect()->route('admin.' . $this->slug . '.index')
            ->with('status', 'Registo atualizado.');
    }
}
