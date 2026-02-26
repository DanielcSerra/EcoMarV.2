<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminUser = User::where('type', 'U')->first();

        Comment::create([
            'message' => 'Preservar o ambiente é fundamental ',
            'news_id' => 1,
            'user_id' => $adminUser->id,

        ]);
        Comment::create([
            'message' => 'Muito bom ver a comunidade unida!',
            'news_id' => 3,
            'user_id' => $adminUser->id,

        ]);
        Comment::create([
            'message' => 'Espero que outras praias sigam o exemplo',
            'news_id' => 2,
            'user_id' => $adminUser->id,

        ]);

        Comment::create([
            'message' => 'Ola agradeco a iniciativa eco mar por nos ajudar neste a deixar a costa mais limpa',
            'news_id' => 8,
            'user_id' => $adminUser->id,

        ]);

        Comment::create([
            'message' => 'Sou grato por fazer parte desta ação incrivel de limpeza',
            'news_id' => 7,
            'user_id' => $adminUser->id,

        ]);

        Comment::create([
            'message' => 'Adorei a forma como a comunidade se uniu contra o obstaculo',
            'news_id' => 6,
            'user_id' => $adminUser->id,

        ]);

        Comment::create([
            'message' => 'Excelente iniciativa! Parabéns a todos os envolvidos.',
            'news_id' => 5,
            'user_id' => $adminUser->id,

        ]);

        Comment::create([
            'message' => 'Vamos todos fazer a nossa parte!',
            'news_id' => 4,
            'user_id' => $adminUser->id,

        ]);

        Comment::create([
            'message' => 'Iniciativa excelente, parabéns à organização!',
            'news_id' => 3,
            'user_id' => $adminUser->id,

        ]);

        Comment::create([
            'message' => 'Cada gesto conta para um planeta mais limpo',
            'news_id' => 2,
            'user_id' => $adminUser->id,

        ]);



    }
}
