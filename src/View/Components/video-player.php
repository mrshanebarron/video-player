<?php

namespace MrShaneBarron\video-player\View\Components;

use Illuminate\View\Component;

class video-player extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('ld-video-player::components.video-player');
    }
}
