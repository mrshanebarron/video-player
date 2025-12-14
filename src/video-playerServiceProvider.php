<?php

namespace MrShaneBarron\video-player;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\video-player\Livewire\video-player;
use MrShaneBarron\video-player\View\Components\video-player as Bladevideo-player;
use Livewire\Livewire;

class video-playerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ld-video-player.php', 'ld-video-player');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ld-video-player');

        Livewire::component('ld-video-player', video-player::class);

        $this->loadViewComponentsAs('ld', [
            Bladevideo-player::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ld-video-player.php' => config_path('ld-video-player.php'),
            ], 'ld-video-player-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/ld-video-player'),
            ], 'ld-video-player-views');
        }
    }
}
