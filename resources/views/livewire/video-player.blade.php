<div class="w-full {{ $this->getAspectRatioClass() }} bg-black rounded-lg overflow-hidden">
    <video
        class="w-full h-full object-contain"
        @if($poster) poster="{{ $poster }}" @endif
        @if($autoplay) autoplay @endif
        @if($loop) loop @endif
        @if($muted) muted @endif
        @if($controls) controls @endif
        playsinline
    >
        <source src="{{ $src }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
