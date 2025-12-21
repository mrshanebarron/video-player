@php
$aspectRatios = [
    '16:9' => 'padding-bottom: 56.25%;',
    '4:3' => 'padding-bottom: 75%;',
    '1:1' => 'padding-bottom: 100%;',
    '21:9' => 'padding-bottom: 42.86%;',
];
$aspectStyle = $aspectRatios[$this->aspectRatio ?? '16:9'] ?? $aspectRatios['16:9'];
@endphp

<div style="width: 100%; position: relative; {{ $aspectStyle }} background: black; border-radius: 8px; overflow: hidden;">
    <video
        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: contain;"
        @if($this->poster) poster="{{ $this->poster }}" @endif
        @if($this->autoplay) autoplay @endif
        @if($this->loop) loop @endif
        @if($this->muted) muted @endif
        @if($this->controls) controls @endif
        playsinline
    >
        <source src="{{ $this->src }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
