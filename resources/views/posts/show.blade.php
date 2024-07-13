<x-app-layout>
  <div class="h-screen md:flex md:flex-row">
    <div class="flex h-full items-center overflow-hidden bg-black md:w-7/12">
      <img class="h-auto w-full" src="/storage/{{$post->image}}" alt="{{ $post->description }}">
    </div>
    <div class="flex w-full flex-col bg-white md:w-5/12">
      <div class="border-b-2">
        <div class="flex items-center p-5">
          <img src="{{$post->user->image}}" alt="{{$post->user->username}}"
               class="mr-5 h-10 w-10 rounded-full">
          <div class="grow">
            <a href="/{{$post->user->username}}" class="font-bold">
              {{ $post->user->username }}
            </a>
          </div>
          @can('update', $post)
            <a href="/p/{{$post->slug}}/edit"><i class='bx bx-message-square-edit text-xl' ></i></a>
            <form action="/p/{{$post->slug}}/delete" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" onclick="return confirm('Are you sure?')">
                <i class="bx bx-message-square-x ml-2 text-xl text-red-600"></i>
              </button>
            </form>
          @endcan
          @cannot('update', $post)
            <livewire:follow-button :post="$post" :userId="$post->user_id" classes="text-blue-500"/>
          @endcannot
        </div>
      </div>
      <div class="grow overflow-y-auto">
        <div class="flex items-start p-5">
          <img src="{{$post->user->image}}" class="mr-5 h-10 w-10 rounded-full">
          <div>
            <a href="{{ $post->user->username }}" class="font-bold">{{ $post->user->username }}</a>
            {{ $post->description }}
          </div>
        </div>
        <div>
          @foreach($post->comments as $comment)
            <div class="flex items-start px-5 py-2">
              <img src="{{ $comment->owner->image }}" alt="" class="h-100 mr-5 w-10 rounded-full">
              <div class="flex flex-col">
                <div>
                  <a href="/{{ $comment->owner->username }}" class="font-bold">{{ $comment->owner->username }}</a>
                  {{$comment->body}}
                </div>
                <div class="mt-1 text-sm font-bold text-gray-400">
                  {{ $comment->created_at->diffForHumans(null, true, true) }}
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="p-3 flex flex-row border-t">
        <livewire:like :post="$post"/>
        <a class="grow" onclick="document.getElementById('comment_body').focus()">
          <i class="bx bx-comment text-3xl hover:text-gray-400 cursor-pointer mr-3"></i>
        </a>
      </div>
      <livewire:likedby :post="$post" />
      <div class="border-t-2 p-5">
        <form action="/p/{{ $post->slug }}/comment" method="POST">
          @csrf
          <div class="flex flex-row">
            <textarea name="body" id="comment_body" placeholder="Add a comment.." class="h-5 grow resize-none overflow-hidden border-none bg-none p-0 placeholder-gray-400 outline-0 focus:ring-0" ></textarea>
            <button class="ml-5 border-none bg-white text-blue-500" type="submit">Post</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
