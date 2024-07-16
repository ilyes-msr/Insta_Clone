<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\Post;

class EditPostModal extends ModalComponent
{
  public $id;
  public Post $post;
  public $description;

  public static function modalMaxWidth(): string
  {
    return '7xl';
  }

  public function mount()
  {
    $this->post = Post::find($this->id);

//    $this->post = $post;
    $this->description = $this->post->description;
  }

  public function update()
  {
    $this->validate([
      'description' => 'required',
    ]) ;

    $this->post->update([
      'description' => $this->description
    ]);

    return redirect()->route('show_post', ['post' => $this->post->slug]);
  }
  public function render()
  {
    return view('livewire.edit-post-modal');
  }
}
