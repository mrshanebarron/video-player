# Video Player

HTML5 video player component for Laravel applications. Supports multiple aspect ratios, autoplay, loop, poster images, and native controls. Works with Livewire and Vue 3.

## Installation

```bash
composer require mrshanebarron/video-player
```

## Livewire Usage

### Basic Usage

```blade
<livewire:sb-video-player src="https://example.com/video.mp4" />
```

### With Poster Image

```blade
<livewire:sb-video-player
    src="/videos/demo.mp4"
    poster="/images/video-poster.jpg"
/>
```

### Aspect Ratios

```blade
<!-- 16:9 (default) -->
<livewire:sb-video-player src="/video.mp4" aspect-ratio="16:9" />

<!-- 4:3 -->
<livewire:sb-video-player src="/video.mp4" aspect-ratio="4:3" />

<!-- Square -->
<livewire:sb-video-player src="/video.mp4" aspect-ratio="1:1" />

<!-- Ultrawide -->
<livewire:sb-video-player src="/video.mp4" aspect-ratio="21:9" />
```

### Autoplay with Muted

```blade
<livewire:sb-video-player
    src="/video.mp4"
    :autoplay="true"
    :muted="true"
/>
```

### Loop Video

```blade
<livewire:sb-video-player src="/video.mp4" :loop="true" />
```

### Hide Controls

```blade
<livewire:sb-video-player src="/video.mp4" :controls="false" />
```

### Livewire Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `src` | string | `''` | Video source URL |
| `poster` | string | `null` | Poster image URL |
| `autoplay` | boolean | `false` | Auto-start playback |
| `loop` | boolean | `false` | Loop video |
| `muted` | boolean | `false` | Start muted |
| `controls` | boolean | `true` | Show player controls |
| `aspectRatio` | string | `'16:9'` | Aspect ratio: `16:9`, `4:3`, `1:1`, `21:9` |

## Vue 3 Usage

### Setup

```javascript
import { SbVideoPlayer } from './vendor/sb-video-player';
app.component('SbVideoPlayer', SbVideoPlayer);
```

### Basic Usage

```vue
<template>
  <SbVideoPlayer src="/videos/intro.mp4" />
</template>
```

### With Options

```vue
<template>
  <SbVideoPlayer
    src="/videos/demo.mp4"
    poster="/images/poster.jpg"
    aspect-ratio="16:9"
    :controls="true"
    :autoplay="false"
    :loop="false"
    :muted="false"
  />
</template>
```

### Vue Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `src` | String | `''` | Video URL |
| `poster` | String | `null` | Poster image |
| `autoplay` | Boolean | `false` | Autoplay |
| `loop` | Boolean | `false` | Loop |
| `muted` | Boolean | `false` | Muted |
| `controls` | Boolean | `true` | Show controls |
| `aspectRatio` | String | `'16:9'` | Aspect ratio |

### Events

| Event | Payload | Description |
|-------|---------|-------------|
| `play` | - | Video started playing |
| `pause` | - | Video paused |
| `ended` | - | Video finished |
| `timeupdate` | number | Current time changed |

## Supported Formats

The component uses the native HTML5 video element and supports:
- MP4 (H.264)
- WebM
- Ogg

```blade
<!-- MP4 source -->
<livewire:sb-video-player src="/video.mp4" />

<!-- External sources work too -->
<livewire:sb-video-player
    src="https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4"
/>
```

## Responsive Behavior

The video player is fully responsive and maintains its aspect ratio:

```blade
<div class="max-w-4xl mx-auto">
    <livewire:sb-video-player src="/video.mp4" />
</div>
```

## Background Video

Create a background video effect:

```blade
<div class="relative">
    <livewire:sb-video-player
        src="/background.mp4"
        :autoplay="true"
        :loop="true"
        :muted="true"
        :controls="false"
    />
    <div class="absolute inset-0 flex items-center justify-center">
        <h1 class="text-white text-4xl">Overlay Content</h1>
    </div>
</div>
```

## Styling

The video player includes:
- Responsive aspect ratio container
- Rounded corners
- Native browser controls
- Full-width display

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Tailwind CSS 3.x

## License

MIT License
