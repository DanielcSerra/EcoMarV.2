<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminUser = User::where('type', 'A')->first();

        $limpezaCatId = EventCategory::where('name', 'Limpezas de Praia e Costeiras')->value('id');

        Event::create([
            'title' => 'Limpeza Costeira — Costa da Caparica',
            'description' => 'Limpeza de praia e dunas, com triagem básica (plástico/metal/vidro) e registo de resíduos.',
            'event_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
            'event_time' => '09:30:00',
            'location' => 'Costa da Caparica',
            'img_path' => 'events/praia_caparica.jpeg',
            'category_id' => $limpezaCatId,
            'created_by' => $adminUser->id,
        ]);

        Event::create([
            'title' => 'Limpeza de Praia — Carcavelos',
            'description' => 'Ação de limpeza com foco em beatas e micro-resíduos. Recomendado levar luvas reutilizáveis.',
            'event_date' => Carbon::now()->addDays(14)->format('Y-m-d'),
            'event_time' => '10:00:00',
            'location' => 'Carcavelos, Lisboa',
            'img_path' => 'events/praia_carcavelos.jpg',
            'category_id' => $limpezaCatId,
            'created_by' => $adminUser->id,
        ]);

        Event::create([
            'title' => 'Limpeza Costeira — Praia do Guincho',
            'description' => 'Limpeza de areal e arribas (zona acessível). Atenção ao vento: traz casaco e calçado firme.',
            'event_date' => Carbon::now()->addDays(21)->format('Y-m-d'),
            'event_time' => '09:00:00',
            'location' => 'Cascais, Lisboa',
            'img_path' => 'events/praia_guicho.jpg',
            'category_id' => $limpezaCatId,
            'created_by' => $adminUser->id,
        ]);

        Event::create([
            'title' => 'Limpeza de Praia — Matosinhos',
            'description' => 'Limpeza do areal e passeio marítimo, com separação de recicláveis sempre que possível.',
            'event_date' => Carbon::now()->addDays(28)->format('Y-m-d'),
            'event_time' => '09:30:00',
            'location' => 'Matosinhos, Porto',
            'img_path' => 'events/praia_matosinhos.jpg',
            'category_id' => $limpezaCatId,
            'created_by' => $adminUser->id,
        ]);

        Event::create([
            'title' => 'Limpeza Costeira — Praia de Faro (Ilha de Faro)',
            'description' => 'Ação na Ria Formosa: recolha de lixo no areal e passadiços, com foco em plásticos leves.',
            'event_date' => Carbon::now()->addDays(35)->format('Y-m-d'),
            'event_time' => '10:30:00',
            'location' => 'Faro, Algarve',
            'img_path' => 'events/praia_faro.jpg',
            'category_id' => $limpezaCatId,
            'created_by' => $adminUser->id,
        ]);

        Event::create([
            'title' => 'Triagem e Contagem de Resíduos — Pós-Limpezas',
            'description' => 'Sessão para pesar/contar resíduos recolhidos, registar categorias e preparar relatório do mês.',
            'event_date' => Carbon::now()->addDays(38)->format('Y-m-d'),
            'event_time' => '18:00:00',
            'location' => 'Armazém ecoMar, Peniche',
            'img_path' => 'events/armazem.jpeg',
            'category_id' => $limpezaCatId,
            'created_by' => $adminUser->id,
        ]);

        Event::create([
            'title' => 'Limpeza de Praia — Baleal',
            'description' => 'Limpeza do areal e zonas rochosas acessíveis da Praia do Baleal, com recolha e separação de resíduos.',
            'event_date' => Carbon::now()->addDays(42)->format('Y-m-d'),
            'event_time' => '09:30:00',
            'location' => 'Baleal, Peniche',
            'img_path' => 'events/praia_baleal.jpg',
            'category_id' => $limpezaCatId,
            'created_by' => $adminUser->id,
        ]);

        Event::create([
            'title' => 'Limpeza Costeira — Praia da Nazaré',
            'description' => 'Ação de limpeza costeira envolvendo voluntários locais, com foco em plásticos e resíduos de pesca.',
            'event_date' => Carbon::now()->addDays(49)->format('Y-m-d'),
            'event_time' => '10:00:00',
            'location' => 'Nazaré, Leiria',
            'img_path' => 'events/praia_nazare.webp',
            'category_id' => $limpezaCatId,
            'created_by' => $adminUser->id,
        ]);

    }
}
