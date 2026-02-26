<?php

namespace Database\Seeders;

use App\Models\SponsorSignup;
use Illuminate\Database\Seeder;

class SponsorSignupSeeder extends Seeder
{
    public function run(): void
    {
        $signups = [
            [
                'nome' => 'Empresa Sustentável Lda',
                'email' => 'contato@empresasustentavel.pt',
                'mensagem' => 'Gostaria de apoiar os projetos de conservação marinha da EcoMar. Temos interesse em ser patrocinador oficial do vosso programa de educação ambiental.',
            ],
            [
                'nome' => 'Marina Norte',
                'email' => 'info@marinanorte.pt',
                'mensagem' => 'A nossa empresa está comprometida com a preservação dos ecossistemas marinhos. Gostaríamos de explorar oportunidades de patrocínio com a vossa organização.',
            ],
            [
                'nome' => 'Oceanográfica Portugal',
                'email' => 'sponsorship@oceanografica.pt',
                'mensagem' => 'Temos um grande interesse em patrocinar as vossas campanhas de limpeza de praias e educação sobre a importância dos oceanos.',
            ],
            [
                'nome' => 'Verde Azul - Consultoria Ambiental',
                'email' => 'verde.azul@consultoria.pt',
                'mensagem' => 'Adoraríamos fazer parte da missão da EcoMar. Estamos dispostos a contribuir com recursos financeiros e conhecimento técnico.',
            ],
            [
                'nome' => 'Turismo Costeiro Sustentável',
                'email' => 'booking@turismocosteiro.pt',
                'mensagem' => 'Como operador turístico responsável, queremos ser patrocinador de projetos que promovam o turismo sustentável e a conservação marinha.',
            ],
            [
                'nome' => 'Pesca Responsável Portuguesa',
                'email' => 'contact@pescaresponsavel.pt',
                'mensagem' => 'A nossa associação de pescadores está interessada em apoiar iniciativas que conciliem a pesca com a preservação dos recursos marinhos.',
            ],
            [
                'nome' => 'Energia Renovável Costeira',
                'email' => 'patrocinio@energiacosteira.pt',
                'mensagem' => 'Como empresa de energias renováveis, queremos patrocinar projetos que promovam a sustentabilidade nos ambientes marinhos.',
            ],
            [
                'nome' => 'Restauração Ecológica Marina',
                'email' => 'info@restauracao-marina.pt',
                'mensagem' => 'Estamos a implementar projetos de restauração de ecossistemas marinhos e gostaríamos de colaborar com a EcoMar.',
            ],
            [
                'nome' => 'Educação Ambiental Portugal',
                'email' => 'patrocinio@educacaoambiental.pt',
                'mensagem' => 'Como organização dedicada à educação ambiental, queremos ser parceiros nos programas educacionais sobre conservação marinha.',
            ],
            [
                'nome' => 'Comércio Sustentável do Atlântico',
                'email' => 'comercio@atlantico-sustentavel.pt',
                'mensagem' => 'A nossa plataforma de comércio justo marinho gostaria de patrocinar as vossas ações de sensibilização para a sustentabilidade.',
            ],
        ];

        foreach ($signups as $signup) {
            SponsorSignup::create($signup);
        }
    }
}
