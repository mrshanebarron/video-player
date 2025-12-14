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
        $this->mergeConfigFrom(__DIR__ . '/../config/sb-video-player.php', 'sb-video-player');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'sb-video-player');

        Livewire::component('sb-video-player', video-player::class);

        $this->loadViewComponentsAs('ld', [
            Bladevideo-player::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/sb-video-player.php' => config_path('sb-video-player.php'),
            ], 'sb-video-player-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/sb-video-player'),
            ], 'sb-video-player-views');
        }
    }
}
