<?php

namespace App\Livewire;

use Livewire\Component;

class AudioPlayer extends Component
{
    public $isPlaying = false;

    public function play()
    {
        $this->isPlaying = true;
    }

    public function pause()
    {
        $this->isPlaying = false;
    }

    public function render()
    {
        return view('livewire.audio-player');
    }
}
