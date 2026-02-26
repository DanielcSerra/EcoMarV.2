<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot()
    {
        Paginator::useBootstrap();

        View::share('adminNav', []);

        View::share('adminNavGroups', [
            [
                'title' => 'Geral',
                'items' => [
                    ['slug' => 'dashboard', 'title' => 'Dashboard', 'icon' => 'ri-dashboard-line'],
                    ['slug' => 'users', 'title' => 'Utilizadores', 'icon' => 'ri-user-3-line'],
                ],
            ],
            [
                'title' => 'Eventos',
                'items' => [
                    ['slug' => 'events', 'title' => 'Eventos', 'icon' => 'ri-calendar-event-line'],
                    ['slug' => 'event-categories', 'title' => 'Categorias', 'icon' => 'ri-price-tag-3-line'],
                    ['slug' => 'event-registrations', 'title' => 'Inscrições', 'icon' => 'ri-user-add-line'],
                    ['slug' => 'event-suggestions', 'title' => 'Sugestões', 'icon' => 'ri-lightbulb-flash-line'],
                ],
            ],
            [
                'title' => 'Campanhas',
                'items' => [
                    ['slug' => 'campaigns', 'title' => 'Campanhas', 'icon' => 'ri-hand-heart-line'],
                    ['slug' => 'donations', 'title' => 'Donativos', 'icon' => 'ri-seedling-line'],
                ],
            ],
            [
                'title' => 'Conteúdos',
                'items' => [
                    ['slug' => 'news', 'title' => 'Notícias', 'icon' => 'ri-newspaper-line'],
                    ['slug' => 'news-categories', 'title' => 'Categorias Notícia', 'icon' => 'ri-price-tag-3-line'],
                    ['slug' => 'comments', 'title' => 'Comentátios', 'icon' => 'ri-chat-2-line'],
                    ['slug' => 'testimonies', 'title' => 'Depoimentos', 'icon' => 'ri-double-quotes-l'],
                ],
            ],
            [
                'title' => 'Patrocinadores',
                'items' => [
                    ['slug' => 'sponsors', 'title' => 'Patrocinadores', 'icon' => 'ri-hand-coin-line'],
                    ['slug' => 'sponsor-categories', 'title' => 'Categorias', 'icon' => 'ri-price-tag-3-line'],
                    ['slug' => 'sponsor-signups', 'title' => 'Candidaturas', 'icon' => 'ri-mail-add-line'],
                ],
            ],
            [
                'title' => 'Comunicação',
                'items' => [
                    ['slug' => 'contacts', 'title' => 'Contactos', 'icon' => 'ri-chat-3-line'],
                    ['slug' => 'newsletters', 'title' => 'Newsletters', 'icon' => 'ri-mail-line'],
                ],
            ],
        ]);
    }

}
