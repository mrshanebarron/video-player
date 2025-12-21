<?php

namespace MrShaneBarron\VideoPlayer\Livewire;

use Livewire\Component;

class VideoPlayer extends Component
{
    public string $src = '';
    public ?string $poster = null;
    public bool $autoplay = false;
    public bool $loop = false;
    public bool $muted = false;
    public bool $controls = true;
    public string $aspectRatio = '16:9';

    public function render()
    {
        return view('sb-video-player::livewire.video-player');
    }
}
