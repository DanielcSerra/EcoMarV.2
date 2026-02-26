<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $adminUser = User::where('type', 'A')->first();

        News::create([
            'title' => 'Limpeza da praia da Costa Verde',
            'description' => 'A comunidade local juntou-se para uma grande ação de limpeza na praia, recolhendo lixo de diferentes tipos, desde plásticos e embalagens até resíduos deixados inadvertidamente por visitantes.
            Este esforço contou com a participação de
            voluntários de todas as idades, incluindo famílias,
            estudantes e organizações ambientais, todos comprometidos
            com a preservação do ambiente.
            A iniciativa não só ajudou a manter a praia limpa e
            segura para a fauna e flora locais, como também serviu
            para sensibilizar a população sobre a importância da
            sustentabilidade e da redução de desperdício.
            Além da limpeza, foram promovidas atividades educativas
            sobre reciclagem e proteção ambiental, reforçando a
            consciência coletiva de que cada gesto conta para um
            futuro mais sustentável.
            Este evento é um exemplo inspirador de como a união da
            comunidade pode gerar impactos positivos duradouros no meio
            ambiente e fortalecer o espírito de responsabilidade ambiental entre todos os cidadão.',
            'date_upload' => Carbon::now(),
            'author' => 'Guilherme peres',
            'img_path' => 'img/Ambiental1.png',
            'category_id' => 1,
            'user_id' => $adminUser->id,

        ]);
        News::create([
            'title' => 'Ação de reciclagem na praia mobiliza voluntários',
            'description' => 'Uma grande ação de reciclagem foi realizada na praia, reunindo dezenas de voluntários com o objetivo de recolher resíduos e promover a separação correta do lixo encontrado ao longo da costa.
             Durante a iniciativa, foram recolhidos diversos tipos de resíduos, como garrafas de plástico, latas, embalagens, vidro e outros materiais deixados por visitantes, que foram posteriormente separados para reciclagem.
             A ação contou com a participação de moradores locais, estudantes, famílias e associações ambientais, que trabalharam em conjunto para tornar a praia mais limpa e segura para os banhistas e para a fauna marinha.
             Além da recolha de resíduos, foram instalados pontos de reciclagem ao longo da praia, incentivando os frequentadores a adotarem comportamentos mais responsáveis.
            Foram também realizadas atividades educativas, incluindo explicações sobre o impacto do lixo nos oceanos e a importância da reciclagem para a preservação dos ecossistemas marinhos.
             Os organizadores destacaram que pequenas atitudes, como separar o lixo e reduzir o uso de plásticos descartáveis, podem ter um impacto significativo na proteção do ambiente.
            Esta iniciativa reforçou o espírito de união da comunidade e mostrou que a reciclagem é uma ferramenta fundamental para a construção de um futuro mais sustentável e consciente.',
            'date_upload' => Carbon::now(),
            'author' => 'Ana Silvestre',
            'img_path' => 'img/Ambiental2.png',
            'category_id' => 2,
            'user_id' => $adminUser->id,

        ]);
        News::create([
            'title' => 'Caminhada ecológica reúne participantes em defesa da natureza',
            'description' => 'Uma caminhada ecológica reuniu dezenas de participantes num percurso natural, com o objetivo de promover a valorização dos espaços verdes e a preservação do meio ambiente.
             Durante o trajeto, os participantes tiveram a oportunidade de conhecer a fauna e flora locais, guiados por especialistas em biodiversidade.
             A iniciativa contou com o apoio de associações ambientais e entidades locais, que destacaram a importância de proteger os recursos naturais da região.
            Além da caminhada, foram realizadas ações de recolha de resíduos e momentos de reflexão sobre o impacto das atividades humanas na natureza.
            Os participantes destacaram a experiência como uma forma de aprender e, ao mesmo tempo, contribuir para a proteção do ambiente.
            Este evento reforça a ideia de que o contacto com a natureza pode inspirar atitudes mais responsáveis e conscientes no quotidiano',
            'date_upload' => Carbon::now(),
            'author' => 'Guilherme peres',
            'img_path' => 'img/baleia.jpg',
            'category_id' => 4,
            'user_id' => $adminUser->id,

        ]);


         News::create([
            'title' => 'Projeto sustentável reduz poluição marinha na costa local',
            'description' => 'Um novo projeto de sustentabilidade foi implementado na zona costeira com o objetivo de reduzir a poluição marinha e promover práticas mais responsáveis entre moradores e visitantes.
             A iniciativa incluiu ações de limpeza da praia, instalação de ecopontos e campanhas de sensibilização sobre a importância da redução do uso de plásticos descartáveis.
             Ao longo do projeto, voluntários, associações ambientais e entidades locais trabalharam em conjunto para recolher resíduos acumulados na areia e nas zonas rochosas.
             Os materiais recolhidos foram separados e encaminhados para reciclagem, contribuindo para a diminuição do impacto ambiental no ecossistema marinho.
             Além das ações práticas, foram realizadas atividades educativas para explicar os efeitos do lixo no mar e os riscos para a fauna marinha.
             Os organizadores destacaram que a sustentabilidade dos oceanos depende do compromisso de toda a sociedade.
             Esta iniciativa tornou-se um exemplo de como a união entre comunidade e instituições pode gerar resultados positivos e duradouros na proteção do mar',
            'date_upload' => Carbon::now(),
            'author' => 'Guilherme peres',
            'img_path' => 'img/foca.jpg',
            'category_id' => 1,
            'user_id' => $adminUser->id,

        ]);

        News::create([
            'title' => 'Ação de proteção ambiental protege zonas costeiras e espécies marinhas',
            'description' => 'ma grande ação de proteção ambiental foi realizada ao longo da costa, com o objetivo de preservar ecossistemas frágeis e espécies ameaçadas.
             A iniciativa incluiu monitorização da fauna e flora marinhas, recolha de lixo e implementação de medidas para reduzir a degradação ambiental.
             Voluntários, cientistas e pescadores locais colaboraram para garantir que os habitats naturais fossem respeitados e recuperados.
             Foram organizadas atividades educativas para sensibilizar turistas e residentes sobre os impactos da poluição e a importância da conservação ambiental.
             Os responsáveis destacaram que a proteção ambiental é fundamental para manter o equilíbrio dos ecossistemas e a sustentabilidade das comunidades costeiras.
             Esta ação reforçou o papel da comunidade na preservação do património natural e na defesa do ambiente marinho',
            'date_upload' => Carbon::now(),
            'author' => 'Guilherme peres',
            'img_path' => 'img/tartaruga-oceanos.jpg',
            'category_id' => 2,
            'user_id' => $adminUser->id,

        ]);


         News::create([
            'title' => 'EcoMar lidera projeto de sustentabilidade para praias limpas',
            'description' => 'A Associação EcoMar lançou um projeto de sustentabilidade com o objetivo de reduzir a poluição nas praias e promover hábitos responsáveis entre moradores e turistas.
             Voluntários recolheram resíduos, separaram materiais recicláveis e participaram em workshops sobre redução de plástico descartável.
             Escolas e empresas locais juntaram-se à iniciativa, reforçando a colaboração comunitária na proteção do ambiente.
             EcoMar destacou que pequenas mudanças no comportamento diário podem gerar impactos significativos na preservação do litoral e na sustentabilidade dos ecossistemas costeiros.
             O projeto tornou-se um exemplo de ação prática que une comunidade e instituições em prol do futuro do mar.',
            'date_upload' => Carbon::now(),
            'author' => 'Guilherme peres',
            'img_path' => 'storage/img/imagem_noticia_2.jpg',
            'category_id' => 1,
            'user_id' => $adminUser->id,

        ]);


            News::create([
            'title' => 'EcoMar promove educação marítima junto de jovens',
            'description' => 'A Associação EcoMar desenvolveu um programa de educação marítima para aproximar jovens do oceano e sensibilizá-los para a preservação ambiental.
             Estudantes participaram em visitas guiadas, workshops sobre ecossistemas marinhos e atividades de monitorização da biodiversidade.
            Professores e especialistas reforçaram a importância da educação marítima para formar cidadãos conscientes e responsáveis.
            EcoMar destacou que ensinar desde cedo sobre proteção ambiental fortalece a ligação entre a comunidade escolar e o património marítimo, promovendo atitudes mais sustentáveis.
            O programa teve grande adesão e deixou os jovens motivados a proteger o mar.',
            'date_upload' => Carbon::now(),
            'author' => 'Guilherme peres',
            'img_path' => 'img/equipa.jpg',
            'category_id' => 4,
            'user_id' => $adminUser->id,

        ]);


           News::create([
            'title' => 'EcoMar incentiva práticas sustentáveis em comunidades costeiras',
            'description' => 'A Associação EcoMar lançou ações de sensibilização sobre sustentabilidade nas comunidades costeiras, mostrando a importância de reduzir o uso de plásticos e adotar hábitos ecológicos.
             Voluntários participaram em atividades práticas de reciclagem e limpeza de praias, enquanto workshops ensinaram técnicas de reutilização e economia circular.
             A iniciativa destacou que pequenas ações do dia a dia podem gerar grandes impactos positivos no ambiente marinho.
            EcoMar reforçou que a sustentabilidade é uma responsabilidade coletiva e que todos podem contribuir para praias e oceanos mais limpos.',
            'date_upload' => Carbon::now(),
            'author' => 'Guilherme peres',
            'img_path' => 'storage/img/imagem_noticia_2.jpg',
            'category_id' => 1,
            'user_id' => $adminUser->id,

        ]);


          News::create([
            'title' => 'EcoMar incentiva práticas sustentáveis em comunidades costeiras',
            'description' => 'A Associação EcoMar lançou ações de sensibilização sobre sustentabilidade nas comunidades costeiras, mostrando a importância de reduzir o uso de plásticos e adotar hábitos ecológicos.
             Voluntários participaram em atividades práticas de reciclagem e limpeza de praias, enquanto workshops ensinaram técnicas de reutilização e economia circular.
             A iniciativa destacou que pequenas ações do dia a dia podem gerar grandes impactos positivos no ambiente marinho.
            EcoMar reforçou que a sustentabilidade é uma responsabilidade coletiva e que todos podem contribuir para praias e oceanos mais limpos.',
            'date_upload' => Carbon::now(),
            'author' => 'Guilherme Peres',
            'img_path' => 'storage/img/imagem_noticia_2.jpg',
            'category_id' => 1,
            'user_id' => $adminUser->id,

        ]);

        News::create([
            'title' => 'EcoMar realiza monitorização da fauna marinha',
            'description' => 'A Associação EcoMar promoveu uma ação de monitorização da fauna marinha, observando espécies e registrando dados para melhorar estratégias de conservação.
             Voluntários participaram ativamente na recolha de lixo e na observação de ecossistemas, aprendendo sobre o impacto humano nos oceanos.
             EcoMar destacou que proteger o mar exige conhecimento científico aliado à ação comunitária.
             A iniciativa contribuiu para preservar espécies locais e sensibilizar a população sobre a importância da conservação marinha.',
            'date_upload' => Carbon::now(),
            'author' => 'Guilherme Peres',
            'img_path' => 'storage/img/imagem_noticia_2.jpg',
            'category_id' => 3,
            'user_id' => $adminUser->id,

        ]);


         News::create([
            'title' => 'EcoMar implementa sistema de reciclagem em praias',
            'description' => 'A Associação EcoMar instalou pontos de reciclagem em praias movimentadas, incentivando visitantes a separar resíduos e reduzir plásticos no mar.
             O projeto inclui campanhas de sensibilização, palestras educativas e acompanhamento dos resíduos recolhidos.
             EcoMar destacou que a prátca de reciclagem é uma das formas mais eficazes de garantir a sustentabilidade costeira e proteger os ecossistemas marinhos.',
            'date_upload' => Carbon::now(),
            'author' => 'Guilherme Peres',
            'img_path' => 'storage/img/imagem_noticia_2.jpg',
            'category_id' => 1,
            'user_id' => $adminUser->id,

        ]);

        News::create([
            'title' => 'EcoMar fortalece proteção ambiental com parceria comunitária',
            'description' => 'A Associação EcoMar firmou parcerias com comunidades locais para reforçar a proteção ambiental em zonas costeiras e marinhas.
            A ação incluiu limpeza de praias, instalação de ecopontos, monitorização de espécies e educação ambiental junto de turistas e residentes.
            EcoMar destacou que a colaboração entre cidadãos, escolas e autoridades é essencial para preservar o mar e promover a sustentabilidade dos ecossistemas costeiros.',
            'date_upload' => Carbon::now(),
            'author' => 'Guilherme Peres',
            'img_path' => 'img/Ambiental3.png',
            'category_id' => 2,
            'user_id' => $adminUser->id,

        ]);
    }
}
