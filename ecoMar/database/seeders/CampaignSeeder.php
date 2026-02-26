<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminUser = User::where('type', 'A')->first();

        Campaign::create([
            'user_id' => $adminUser->id,
            'date_start' => Carbon::now()->subDays(10)->format('Y-m-d'),
            'date_end' => Carbon::now()->addDays(20)->format('Y-m-d'),
            'title' => 'Campanha Limpeza Atlântico',
            'country' => 'portugal',
            'description' => 'Campanha de limpeza costeira em várias praias do Atlântico, envolvendo voluntários locais e internacionais.',
            'image' => 'img/campaigns/atlantico.jpg',
            'goal' => 5000.00,
            'goal_current' => 1200.00,
            'is_large' => true,
        ]);

        Campaign::create([
            'user_id' => $adminUser->id,
            'date_start' => Carbon::now()->subDays(5)->format('Y-m-d'),
            'date_end' => Carbon::now()->addDays(10)->format('Y-m-d'),
            'title' => 'Campanha Mangais Vivos',
            'country' => 'mocambique',
            'description' => 'Reflorestação de mangais e sensibilização ambiental junto das comunidades costeiras.',
            'image' => 'img/campaigns/mangais.jpg',
            'goal' => 3000.00,
            'goal_current' => 800.00,
            'is_large' => false,
        ]);

        Campaign::create([
            'user_id' => $adminUser->id,
            'date_start' => Carbon::now()->subDays(2)->format('Y-m-d'),
            'date_end' => Carbon::now()->addDays(15)->format('Y-m-d'),
            'title' => 'Campanha Oceano Limpo',
            'country' => 'brasil',
            'description' => 'Ações de limpeza e educação ambiental em praias urbanas e rurais do Brasil.',
            'image' => 'img/campaigns/oceano_limpo.jpg',
            'goal' => 4000.00,
            'goal_current' => 1500.00,
            'is_large' => false,
        ]);
    }
}
