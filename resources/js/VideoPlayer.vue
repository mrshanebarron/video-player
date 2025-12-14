<template>
  <div class="relative bg-black rounded-lg overflow-hidden group">
    <video
      ref="videoRef"
      :src="src"
      :poster="poster"
      @timeupdate="updateProgress"
      @loadedmetadata="onLoaded"
      @ended="onEnded"
      @play="playing = true"
      @pause="playing = false"
      class="w-full"
      :autoplay="autoplay"
      :loop="loop"
      :muted="muted"
    ></video>

    <div
      v-if="showControls"
      :class="['absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4 transition-opacity', controlsVisible || !playing ? 'opacity-100' : 'opacity-0 group-hover:opacity-100']"
    >
      <!-- Progress bar -->
      <div
        class="h-1 bg-white/30 rounded-full mb-3 cursor-pointer"
        @click="seek"
        ref="progressRef"
      >
        <div class="h-full bg-white rounded-full" :style="{ width: progress + '%' }"></div>
      </div>

      <div class="flex items-center gap-4">
        <!-- Play/Pause -->
        <button @click="togglePlay" class="text-white hover:text-blue-400">
          <svg v-if="!playing" class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
          <svg v-else class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
        </button>

        <!-- Volume -->
        <div class="flex items-center gap-2">
          <button @click="toggleMute" class="text-white hover:text-blue-400">
            <svg v-if="volume === 0" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.2.05-.41.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z"/></svg>
            <svg v-else class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z"/></svg>
          </button>
          <input
            v-model.number="volume"
            type="range"
            min="0"
            max="1"
            step="0.1"
            class="w-20 h-1 accent-white"
            @input="updateVolume"
          >
        </div>

        <!-- Time -->
        <span class="text-white text-sm ml-auto">{{ formatTime(currentTime) }} / {{ formatTime(duration) }}</span>

        <!-- Fullscreen -->
        <button @click="toggleFullscreen" class="text-white hover:text-blue-400">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';

export default {
  name: 'LdVideoPlayer',
  props: {
    src: { type: String, required: true },
    poster: { type: String, default: '' },
    autoplay: { type: Boolean, default: false },
    loop: { type: Boolean, default: false },
    muted: { type: Boolean, default: false },
    showControls: { type: Boolean, default: true }
  },
  emits: ['play', 'pause', 'ended'],
  setup(props, { emit }) {
    const videoRef = ref(null);
    const progressRef = ref(null);
    const playing = ref(false);
    const progress = ref(0);
    const currentTime = ref(0);
    const duration = ref(0);
    const volume = ref(1);
    const controlsVisible = ref(true);

    const togglePlay = () => {
      if (videoRef.value) {
        playing.value ? videoRef.value.pause() : videoRef.value.play();
      }
    };

    const updateProgress = () => {
      if (videoRef.value) {
        currentTime.value = videoRef.value.currentTime;
        progress.value = (currentTime.value / duration.value) * 100;
      }
    };

    const seek = (e) => {
      if (videoRef.value && progressRef.value) {
        const rect = progressRef.value.getBoundingClientRect();
        const percent = (e.clientX - rect.left) / rect.width;
        videoRef.value.currentTime = percent * duration.value;
      }
    };

    const onLoaded = () => {
      if (videoRef.value) duration.value = videoRef.value.duration;
    };

    const onEnded = () => emit('ended');

    const toggleMute = () => {
      volume.value = volume.value === 0 ? 1 : 0;
      updateVolume();
    };

    const updateVolume = () => {
      if (videoRef.value) videoRef.value.volume = volume.value;
    };

    const toggleFullscreen = () => {
      if (videoRef.value) {
        if (document.fullscreenElement) {
          document.exitFullscreen();
        } else {
          videoRef.value.requestFullscreen();
        }
      }
    };

    const formatTime = (seconds) => {
      const mins = Math.floor(seconds / 60);
      const secs = Math.floor(seconds % 60);
      return `${mins}:${secs.toString().padStart(2, '0')}`;
    };

    return {
      videoRef, progressRef, playing, progress, currentTime, duration, volume, controlsVisible,
      togglePlay, updateProgress, seek, onLoaded, onEnded, toggleMute, updateVolume, toggleFullscreen, formatTime
    };
  }
};
</script>
