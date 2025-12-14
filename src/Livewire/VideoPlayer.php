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

    public function mount(
        string $src = '',
        ?string $poster = null,
        bool $autoplay = false,
        bool $loop = false,
        bool $muted = false,
        bool $controls = true,
        string $aspectRatio = '16:9'
    ): void {
        $this->src = $src;
        $this->poster = $poster;
        $this->autoplay = $autoplay;
        $this->loop = $loop;
        $this->muted = $muted;
        $this->controls = $controls;
        $this->aspectRatio = $aspectRatio;
    }

    public function getAspectRatioClass(): string
    {
        return match($this->aspectRatio) {
            '16:9' => 'aspect-video',
            '4:3' => 'aspect-[4/3]',
            '1:1' => 'aspect-square',
            '21:9' => 'aspect-[21/9]',
            default => 'aspect-video',
        };
    }

    public function render()
    {
        return view('ld-video-player::livewire.video-player');
    }
}
