<div>
  <li class="flex flex-col md:flex-row text-center">
    <div class="md:mr-1 font-bold md:font-normal">
      {{$this->count}}
    </div>
    <button class="text-neutral-500 md:text-black" onclick="Livewire.dispatch('openModal', { component: 'following-modal', arguments: { userId: {{ $userId }} } })">
      {{ __('following') }}
    </button>
  </li>
</div>
