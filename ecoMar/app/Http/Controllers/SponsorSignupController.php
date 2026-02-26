<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Models\SponsorSignup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SponsorSignupAdminController extends Controller
{
    public function index()
    {
        $items = SponsorSignup::latest()->paginate(10);

        return view('_admin.sponsor-signups.index', [
            'items' => $items,
            'resourceKey' => 'sponsor-signups',
            'resource' => [
                'title' => 'Candidaturas de Patrocínio',
                'fields' => [
                    'nome' => ['label' => 'Nome', 'list' => true],
                    'email' => ['label' => 'Email', 'list' => true],
                    'mensagem' => ['label' => 'Mensagem', 'list' => true],
                    'created_at' => ['label' => 'Enviado em', 'type' => 'datetime', 'list' => true],
                ],
            ],
        ]);
    }

    public function create()
    {
        $item = new SponsorSignup();

        return view('_admin.sponsor-signups.create', [
            'item' => $item,
            'route' => route('admin.sponsor-signups.store'),
            'method' => 'POST',
            'resource' => [
                'title' => 'Criar Pedido de Patrocínio',
            ],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensagem' => 'nullable|string|max:2000',
        ]);

        SponsorSignup::create($request->only('nome', 'email', 'mensagem'));

        return redirect()
            ->route('admin.sponsor-signups.index')
            ->with('success', 'Pedido criado com sucesso!');
    }

    public function show($id)
    {
        $item = SponsorSignup::findOrFail($id);

        $resource = [
            'title' => 'Ver Pedido de Patrocínio',
            'fields' => [
                'nome' => ['label' => 'Nome'],
                'email' => ['label' => 'Email'],
                'mensagem' => ['label' => 'Mensagem'],
                'created_at' => ['label' => 'Enviado em', 'type' => 'datetime'],
            ],
        ];

        return view('_admin.sponsor-signups.show', compact('item', 'resource'));
    }

    public function edit($id)
    {
        $item = SponsorSignup::findOrFail($id);

        return view('_admin.sponsor-signups.edit', [
            'item' => $item,
            'route' => route('admin.sponsor-signups.update', $item->id),
            'method' => 'PUT',
            'resource' => [
                'title' => 'Editar Pedido de Patrocínio',
            ],
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = SponsorSignup::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mensagem' => 'nullable|string|max:2000',
        ]);

        $item->update($request->only('nome', 'email', 'mensagem'));

        return redirect()
            ->route('admin.sponsor-signups.index')
            ->with('success', 'Pedido atualizado com sucesso!');
    }

    public function approve(SponsorSignup $signup)
    {
        $defaultCategoryId = \App\Models\SponsorCategory::first()?->id;

        $sponsor = Sponsor::create([
            'name' => $signup->nome,
            'description' => $signup->mensagem,
            'status' => 1,
            'signup_id' => $signup->id,
            'category_id' => $defaultCategoryId,
            'approved_by' => auth()->id(),
        ]);

        // Delete the signup after approval
        $signup->delete();

        return redirect()->route('admin.sponsor-signups.index')
                         ->with('status', 'Pedido aprovado e convertido em patrocinador.');
    }

    public function destroy(SponsorSignup $signup)
    {
        $signup->delete();
        return redirect()->back()->with('status', 'Pedido eliminado com sucesso.');
    }
}
