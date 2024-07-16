<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class FollowButton extends Component
{
  public $post;
  protected $user;
  public $userId;
  public $follow_state;
  public $classes;

  public function mount()
  {
    $this->user = User::find($this->userId);

    $this->set_follow_state($this->user);
  }

  public function toggle_follow()
  {
    $this->user = User::find($this->userId);
    auth()->user()->toggle_follow($this->user);
    $this->set_follow_state($this->user);
    $this->dispatch('toggleFollow');

  }
  public function render()
  {
      return view('livewire.follow-button');
  }

  protected function set_follow_state()
  {
    if(auth()->user()->is_pending($this->user)) {
      $this->follow_state = 'Pending';
    } elseif(auth()->user()->is_following($this->user)) {
      $this->follow_state = 'Unfollow';
    } else {
      $this->follow_state = 'Follow';
    }
  }
}
