<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema; // Adicione este USE

class EventCategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. DESATIVAR chaves estrangeiras
        Schema::disableForeignKeyConstraints();

        // 2. Limpar dados existentes (Truncate)
        DB::table('event_categories')->truncate(); // <-- A linha que dava erro

        // 3. Inserir categorias específicas
        $categories = [
            ['name' => 'Limpezas de Praia e Costeiras'],
            ['name' => 'Educação e Sensibilização Ambiental'],
            ['name' => 'Conservação Marinha'],
            ['name' => 'Ações Comunitárias'],
        ];

        DB::table('event_categories')->insert($categories);

        // 4. REATIVAR chaves estrangeiras
        Schema::enableForeignKeyConstraints();
    }
}
