<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // Adicione este USE

class NewsCategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. DESATIVAR chaves estrangeiras
        Schema::disableForeignKeyConstraints();

        // 2. Limpar dados existentes (Truncate)
        DB::table('news_categories')->truncate(); // <-- A linha que dava erro

        // 3. Inserir categorias específicas
        $categories = [
            ['name' => 'Sustentabilidade'],
            ['name' => 'Proteção Ambiental'],
            ['name' => 'Conservação Marinha'],
            ['name' => 'Educação Maritima'],
        ];

        DB::table('news_categories')->insert($categories);

        // 4. REATIVAR chaves estrangeiras
        Schema::enableForeignKeyConstraints();
    }
}
