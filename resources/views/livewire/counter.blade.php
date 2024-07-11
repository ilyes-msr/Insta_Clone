<div>
  <h1>{{$count}}</h1>

  <button wire:click="increment">+</button>
  <button wire:click="decrement">-</button>

  <p>{{$message}}</p>
  <input wire:model.live="message" type="text">
</div>
