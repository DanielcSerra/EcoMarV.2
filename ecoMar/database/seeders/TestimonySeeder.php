<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimony;
use App\Models\User;

class TestimonySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::take(3)->get();

        $messages = [
            'Ser voluntário na EcoMar foi uma experiência transformadora. Senti que o meu contributo fez realmente a diferença.',
            'Participar nas ações da EcoMar abriu-me os olhos para a importância da proteção dos oceanos.',
            'A EcoMar deu-me a oportunidade de aprender, ajudar e conhecer pessoas incríveis com a mesma paixão pelo mar.',
        ];

        foreach ($users as $index => $user) {
            Testimony::create([
                'user_id' => $user->id,
                'message' => $messages[$index],
                'is_approved' => true,
            ]);
        }
    }
}
