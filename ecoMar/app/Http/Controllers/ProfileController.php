<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        $registrations = $user
            ? $user->eventRegistrations()
                ->with(['event.category'])
                ->latest('created_at')
                ->get()
                ->sortBy(function ($reg) {
                    return $reg->event->event_date ?? '9999-12-31';
                })
                ->values()
            : collect();

        $now = now();
        $upcomingCount = $registrations->filter(function ($reg) use ($now) {
            $date = optional($reg->event)->event_date;
            if (!$date) {
                return false;
            }
            $eventDate = Carbon::parse($date);
            return $eventDate->isSameMonth($now) && $eventDate->isSameYear($now);
        })->count();

        $typeLabels = [
            'A' => 'Admin',
            'F' => 'Funcionário',
            'U' => 'Utilizador',
        ];

        return view('profile', [
            'user' => $user,
            'registrations' => $registrations,
            'upcomingCount' => $upcomingCount,
            'typeLabels' => $typeLabels,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'digits:9'],
            'location' => ['nullable', 'string', 'max:255'],
            'dob' => ['nullable', 'date'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'img_path' => ['nullable', 'image', 'max:3072'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        $user->name = $validated['name'];
        $user->phone = $validated['phone'] ?? null;
        $user->location = $validated['location'] ?? null;
        $user->dob = $validated['dob'] ?? null;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        if ($request->boolean('remove_image') && !$request->hasFile('img_path')) {
            $this->deleteAvatar($user->img_path);
            $user->img_path = null;
        } elseif ($request->hasFile('img_path')) {
            $this->deleteAvatar($user->img_path);

            $file = $request->file('img_path');
            $path = $file->store('profile_img', 'public');
            $user->img_path = $path;
        }

        $user->save();

        return back()->with('status', 'Perfil atualizado com sucesso.');
    }

    private function deleteAvatar(?string $path): void
    {
        if (!$path) {
            return;
        }

        Storage::disk('public')->delete($path);
    }
}
