<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{

  public function index()
  {
    $ids = auth()->user()->following()->wherePivot('confirmed', true)->get()->pluck('id');
    $posts = Post::whereIn('user_id', $ids)->latest()->get();

    $suggested_users = auth()->user()->suggested_users();
    return view('posts.index', compact(['posts', 'suggested_users']));
  }


  public function create()
  {
    return view('posts.create');
  }


  public function store(Request $request)
  {
    $data = $request->validate([
      'description' => ['required', 'max:256'],
      'image' => ['required', 'mimes:jpg,png,gif, jpeg']
    ]);
    $image = $request['image']->store('posts', 'public');
    $data['image'] = $image;

    $data['slug'] = Str::random(10);
    auth()->user()->posts()->create($data);

    return redirect()->back();
  }

  public function show(Post $post)
  {
    return view('posts.show', compact('post'));
  }

  public function edit(Post $post)
  {
    return view('posts.edit', compact('post'));
  }

  public function update(Request $request, Post $post)
  {
    $data = $request->validate([
      'description' => 'required',
      'image' => ['nullable', 'mimes:jpg,jpeg,png,gif']
    ]);

    if($request->has('image')) {
      $image = $request['image']->store('posts', 'public');
      $data['image'] = $image;
    }

    $post->update($data);

    return redirect('/p/' . $post->slug);
  }

  public function destroy(Post $post)
  {
    Storage::delete('public/' . $post->image);
    $post->delete();
    return redirect(url('home'));
  }

  public function explore()
  {
    $posts = Post::whereRelation('user', 'private_account', '=', 0)
        ->whereNot('user_id', auth()->id())
        ->simplePaginate(12);
    return view('posts.explore', compact('posts'));
  }
}
