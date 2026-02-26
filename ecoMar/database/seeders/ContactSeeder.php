<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use Carbon\Carbon;


class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $rows = [
            [
                'title' => 'Pedido de informação',
                'name' => 'Ana Marques',
                'message' => 'Gostaria de saber mais informações sobre as doações.',
                'email' => 'ana.marques@email.com',
                'created_at' => $now->copy()->subDays(5),
            ],
            [
                'title' => 'Sugestão',
                'name' => 'Tiago Alves',
                'message' => 'Parabéns pelo excelente trabalho que estão a fazer.',
                'email' => 'tiago.alves@email.com',
                'created_at' => $now->copy()->subDays(4),
            ],
            [
                'title' => 'Problema no site',
                'name' => 'Carla Pereira',
                'message' => 'Encontrei um erro ao tentar submeter o formulário.',
                'email' => 'carla.pereira@email.com',
                'created_at' => $now->copy()->subDays(3),
            ],
            [
                'title' => 'Contacto geral',
                'name' => 'Rui Costa',
                'message' => 'Como posso tornar-me voluntário?',
                'email' => 'rui.costa@email.com',
                'created_at' => $now->copy()->subDays(2),
            ],
            [
                'title' => 'Agradecimento',
                'name' => 'Joana Silva',
                'message' => 'Muito obrigado pelo apoio prestado!',
                'email' => 'joana.silva@email.com',
                'created_at' => $now->copy()->subDay(),
            ],
        ];

        foreach ($rows as &$row) {
            $row['updated_at'] = $row['created_at'];
        }

        Contact::insert($rows);
    }
}
