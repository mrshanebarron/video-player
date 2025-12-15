<?php

namespace MrShaneBarron\VideoPlayer;

use Illuminate\Support\ServiceProvider;
use MrShaneBarron\VideoPlayer\Livewire\VideoPlayer;
use MrShaneBarron\VideoPlayer\View\Components\video-player as BladeVideoPlayer;
use Livewire\Livewire;

class VideoPlayerServiceProvider extends ServiceProvider
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
            BladeVideoPlayer::class,
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
