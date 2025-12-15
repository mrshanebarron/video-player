<?php

namespace MrShaneBarron\VideoPlayer\View\Components;

use Illuminate\View\Component;

class VideoPlayer extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('sb-video-player::components.video-player');
    }
}
