<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SponsorCategory;

class SponsorCategorySeeder extends Seeder
{
    public function run(): void
    {
        
        $categories = [
            ['name' => 'Apoio Financeiro'],
            ['name' => 'Parceiros Ambientais'],
            ['name' => 'Apoio Logístico'],
        ];

        foreach ($categories as $cat) {
            SponsorCategory::create($cat);
        }
    }
}