<div class="card my-4">
  <div class="card-header">
    <img src="{{$post->user->image}}" alt="" class="w-9 h-9 rounded-full mr-3">
    <a href="/{{$post->user->username}}" class="font-bold">{{$post->user->username}}</a>
  </div>

  <div class="card-body">
    <div class="max-h-[35rem] overflow-hidden">
      <img src="/storage/{{$post->image}}" alt="{{$post->description}}" class="h-auto w-full object-cover">
    </div>

    <div class="p-3 flex flex-row">
      <livewire:like :post="$post"/>
      <a href="/p/{{$post->slug}}" class="grow">
        <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
      </a>
    </div>

    <div class="p-3">
      <a href="/{{$post->user->username}}" class="font-bold mr-1">{{$post->user->username}}</a>
      {{$post->description}}
    </div>

    @if($post->comments()->count() > 0)
      <a href="/p/{{$post->slug}}" class="p-3 font-bold text-sm text-gray-500">
        {{ __('View all ' . $post->comments()->count() . ' comments') }}
      </a>
    @endif

    <div class="p-3 text-gray-400 uppercase text-xs">
      {{$post->created_at->diffForHumans()}}
    </div>
  </div>

  <div class="card-footer">
    <form action="/p/{{$post->slug}}/comment" method="POST">
      @csrf
      <div class="flex flex-row">
        <textarea name="body" placeholder="{{ __('Add a comment...')}}" autocomplete="off" autocorrect="off" class="grow border-none resize-none focus:ring-0 outline-0 bg-none max-h-60 h-5 p-0 overflow-y-hidden placeholder-gray-400"></textarea>
        <button class="bg-white border-none text-blue-500 ml-5" type="submit">{{__('POST')}}</button>
      </div>
    </form>
  </div>
</div>
