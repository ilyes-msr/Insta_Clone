<?php

namespace App\Livewire;

use Livewire\Component;

class Like extends Component
{
  public $post;

  public function toggle_like()
  {
    $this->post->likes()->toggle(auth()->user());
    $this->dispatch('likeToggled');
  }
    public function render()
    {
        return view('livewire.like');
    }
}
