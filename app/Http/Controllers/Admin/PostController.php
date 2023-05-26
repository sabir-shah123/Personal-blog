<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Toastr;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->withCount('comments')->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:posts|max:255',
            'image' => 'required|mimes:jpeg,jpg,png',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
            'excerpt' => 'required',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('posts')) {
                Storage::disk('public')->makeDirectory('posts');
            }
            $postimage = Image::make($image)->resize(1600, 980)->stream();
            Storage::disk('public')->put('posts/' . $imagename, $postimage);

        } else {
            $imagename = 'default.png';
        }

        $post = new Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imagename;
        $post->body = $request->body;
        $post->excerpt = $request->excerpt;
        if (isset($request->status)) {
            $post->status = true;
        }
        $post->is_approved = true;
        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        Toastr::success('message', 'Post created successfully.');
        return redirect()->route('admin.posts.index');

    }

    public function show(Post $post)
    {
        $post = Post::withCount('comments')->find($post->id);

        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        $post = Post::find($post->id);
        $selectedtag = $post->tags->pluck('id');
        return view('admin.posts.edit', compact('categories', 'tags', 'post', 'selectedtag'));
    }

    public function update(Request $request, $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => 'mimes:jpeg,jpg,png',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
            'excerpt' => 'required',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->title);

        $post = Post::find($post->id);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('posts')) {
                Storage::disk('public')->makeDirectory('posts');
            }
            if (Storage::disk('public')->exists('posts/' . $post->image)) {
                Storage::disk('public')->delete('posts/' . $post->image);
            }
            $postimage = Image::make($image)->resize(1600, 980)->stream();
            Storage::disk('public')->put('posts/' . $imagename, $postimage);

        } else {
            $imagename = $post->image;
        }

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imagename;
        $post->body = $request->body;
        $post->excerpt = $request->excerpt;

        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }
        $post->is_approved = true;
        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('message', 'Post updated successfully.');
        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $post = Post::find($post->id);

        if (Storage::disk('public')->exists('posts/' . $post->image)) {
            Storage::disk('public')->delete('posts/' . $post->image);
        }

        $post->delete();
        $post->categories()->detach();
        $post->tags()->detach();
        $post->comments()->delete();

        Toastr::success('message', 'Post deleted successfully.');
        return back();
    }
}
