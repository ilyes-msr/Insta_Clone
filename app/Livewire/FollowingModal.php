<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class FollowingModal extends ModalComponent
{
  public $userId;
  protected $user;

  public static function modalMaxWidth(): string
  {
    return 'sm';
  }

  public function getFollowingListProperty()
  {
    $this->user = User::find($this->userId);
    return $this->user->following()->wherePivot('confirmed', true)->get();
  }

  public function render()
  {
      return view('livewire.following-modal');
  }

  public function unfollow($userId)
  {
    $following_user = User::find($userId);
    $this->user = User::find($this->userId);
    $this->user->unfollow($following_user);
    $this->dispatch('unfollowUser');
  }
}
