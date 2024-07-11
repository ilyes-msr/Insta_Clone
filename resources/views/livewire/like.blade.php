<div>
    <a wire:click="toggle_like">
      @if($post->liked(auth()->user()))
        <i class='bx bxs-heart mr-3 text-3xl text-red-600 cursor-pointer'></i>
      @else
        <i class='bx bx-heart mr-3 text-3xl cursor-pointer hover:text-gray-400'></i>
      @endif
    </a>
</div>
