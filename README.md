# Laravel Design Video Player

Video player component for Laravel. Supports Livewire, Blade, and Vue 3.

## Installation

```bash
composer require mrshanebarron/video-player
```

## Usage

### Livewire Component

```blade
<livewire:ld-video-player />
```

### Blade Component

```blade
<x-ld-video-player />
```

## Configuration

Publish the config file:

```bash
php artisan vendor:publish --tag=ld-video-player-config
```

## Customization

### Publishing Views

```bash
php artisan vendor:publish --tag=ld-video-player-views
```

## License

MIT
