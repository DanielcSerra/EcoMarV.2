<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sponsor;
use App\Models\SponsorCategory;

class SponsorSeeder extends Seeder
{
    public function run(): void
    {
        
        $category1 = SponsorCategory::firstOrCreate(['name' => 'Apoio Financeiro']);
        $category2 = SponsorCategory::firstOrCreate(['name' => 'Parceiros Ambientais']);
        $category3 = SponsorCategory::firstOrCreate(['name' => 'Apoio Logístico']);

        
        Sponsor::create([
            'category_id' => $category1->id,
            'name' => 'Lidl Portugal',
            'description' => 'Apoio a iniciativas de sustentabilidade e responsabilidade ambiental.',
            'img_path' => 'img/Financeiro1.png',
            'status' => 1,
            'approved_by' => 1,
        ]);

        Sponsor::create([
            'category_id' => $category2->id,
            'name' => 'WWF',
            'description' => 'Organização internacional dedicada à conservação da natureza e proteção dos oceanos.',
            'img_path' => 'img/Ambiental1.png',
            'status' => 1,
            'approved_by' => 1,
        ]);

        Sponsor::create([
            'category_id' => $category3->id,
            'name' => 'Decathlon',
            'description' => 'Apoio com equipamentos e materiais para ações ambientais.',
            'img_path' => 'img/Logistico1.png',
            'status' => 1,
            'approved_by' => 1,
        ]);

                Sponsor::create([
            'category_id' => $category1->id,
            'name' => 'Continente',
            'description' => 'Promoção de práticas sustentáveis e proteção ambiental.',
            'img_path' => 'img/Financeiro2.png',
            'status' => 1,
            'approved_by' => 1,
        ]);

        Sponsor::create([
            'category_id' => $category2->id,
            'name' => 'ABAE',
            'description' => 'Promove praias limpas e educação ambiental.',
            'img_path' => 'img/Ambiental2.png',
            'status' => 1,
            'approved_by' => 1,
        ]);

        Sponsor::create([
            'category_id' => $category3->id,
            'name' => 'Valorsul',
            'description' => 'Gestão de resíduos e apoio logístico a projetos ambientais.',
            'img_path' => 'img/Logistico2.png',
            'status' => 1,
            'approved_by' => 1,
        ]);

                        Sponsor::create([
            'category_id' => $category1->id,
            'name' => 'Santander Portugal',
            'description' => 'Apoio a projetos de responsabilidade social e sustentabilidade ambiental.',
            'img_path' => 'img/Financeiro3.png',
            'status' => 1,
            'approved_by' => 1,
        ]);

        Sponsor::create([
            'category_id' => $category2->id,
            'name' => 'Oceano Azul',
            'description' => 'Proteção dos oceanos e zonas costeiras.',
            'img_path' => 'img/Ambiental3.png',
            'status' => 1,
            'approved_by' => 1,
        ]);

        Sponsor::create([
            'category_id' => $category3->id,
            'name' => 'Auchan',
            'description' => 'Apoio com materiais e logística para ações ambientais.',
            'img_path' => 'img/Logistico3.png',
            'status' => 1,
            'approved_by' => 1,
        ]);


    }
}