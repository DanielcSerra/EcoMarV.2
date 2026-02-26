<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{

    public function index()
    {

        
        $events = Event::query()
            ->orderBy('event_date', 'desc') 
            ->latest()
            ->take(3)
            ->get();

 
        $processedEvents = $events->map(function ($event) {
            $imgSrc = null;
            if ($event->img_path) {
                $candidate = ltrim($event->img_path, '/');
  
                if (str_starts_with($candidate, 'storage/')) {
                    $candidate = substr($candidate, 8);
                }
                if (str_starts_with($candidate, 'public/')) {
                    $candidate = substr($candidate, 7);
                }
                
                if (filter_var($event->img_path, FILTER_VALIDATE_URL)) {
                    $imgSrc = $event->img_path;
                } elseif (Storage::disk('public')->exists($candidate)) {
                    $imgSrc = asset('storage/' . $candidate);
                }
            }
          
            if (!$imgSrc) {
                $imgSrc = 'https://picsum.photos/900/1200?random=' . $event->id;
            }

            return [
                'headline' => $event->title,
                'miniTitle' => $event->location . ' - ' . date('d M Y', strtotime($event->event_date)),
                'description' => \Illuminate\Support\Str::limit($event->description, 150),
                'image' => $imgSrc,
                'url' => route('eventos') 
            ];
        });
        while ($processedEvents->count() < 3) {
             $processedEvents->push([
                'headline' => "EcoMar Eventos",
                'miniTitle' => "Junta-te a nós",
                'description' => "Inscreve-te nos nossos próximos eventos e ajuda a limpar os oceanos.",
                'image' => "https://picsum.photos/900/1200?random=" . rand(100,200),
                'url' => route('eventos')
             ]);
        }

        // --- SOBRE-NOS Data ---
        $sobreNosSlides = [
            [
                'leftText' => 'Preservar,',
                'description' => 'Partilhamos resultados e dados de impacto de todas as nossas ações, garantindo confiança e responsabilidade.',
                'image' => asset('img/transparencia.jpg'),
                'imgId' => 'card-0'
            ],
            [
                'leftText' => 'proteger,',
                'description' => 'Trabalhamos em rede com escolas, universidades, municípios e ONGs para amplificar o impacto positivo.',
                'image' => asset('img/colaboracao.jpg'),
                'imgId' => 'card-1'
            ],
            [
                'leftText' => 'inspirar.',
                'description' => 'Usamos tecnologia, ciência e criatividade para encontrar soluções sustentáveis e inspirar novas gerações.',
                'image' => asset('img/inovacao.jpg'),
                'imgId' => 'card-2'
            ]
        ];

        // --- Recent News Data ---
        $recentNews = News::query()
            ->orderBy('date_upload', 'desc')
            ->take(4)
            ->get();

        $processedNews = $recentNews->map(function ($news) {
            $imgSrc = null;
            
            if ($news->img_path) {
                if (filter_var($news->img_path, FILTER_VALIDATE_URL)) {
                    $imgSrc = $news->img_path;
                } else {
                    // Normalize path and use asset() just like the blade view
                    $imgSrc = asset($news->img_path);
                }
            } else {
                $imgSrc = asset('img/default-news.jpg');
            }
            
            return [
                'image' => $imgSrc,
                'publicationDate' => 'Publicada ' . date('d/m/Y \à\s H:i', strtotime($news->date_upload)),
                'headline' => $news->title,
                'url' => route('noticias.comentarios', $news->id)
            ];
        });

        return view('index', [
            'slides' => $processedEvents, 
            'sobreNosSlides' => $sobreNosSlides,
            'recentNews' => $processedNews
        ]);
    }
}
