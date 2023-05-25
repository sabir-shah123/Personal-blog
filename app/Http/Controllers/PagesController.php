<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Mail\Contact;
use App\Message;
use App\Post;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{

    // BLOG PAGE
    public function blog()
    {
        $month = request('month');
        $year = request('year');

        $posts = Post::latest()->withCount('comments')
            ->when($month, function ($query, $month) {
                return $query->whereMonth('created_at', Carbon::parse($month)->month);
            })
            ->when($year, function ($query, $year) {
                return $query->whereYear('created_at', $year);
            })
            ->where('status', 1)
            ->paginate(10);
            

        return view('pages.blog.index', compact('posts'));
    }

    public function blogshow($slug)
    {
        $post = Post::with('comments')->withCount('comments')->where('slug', $slug)->first();

        $blogkey = 'blog-' . $post->id;
        if (!Session::has($blogkey)) {
            $post->increment('view_count');
            Session::put($blogkey, 1);
        }

        return view('pages.blog.single', compact('post'));
    }

    // BLOG COMMENT
    public function blogComments(Request $request, $id)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $post = Post::find($id);

        $post->comments()->create(
            [
                'user_id' => Auth::id(),
                'body' => $request->body,
                'parent' => $request->parent,
                'parent_id' => $request->parent_id,
            ]
        );

        return back();
    }

    // BLOG CATEGORIES
    public function blogCategories()
    {
        $posts = Post::latest()->withCount(['comments', 'categories'])
            ->whereHas('categories', function ($query) {
                $query->where('categories.slug', '=', request('slug'));
            })
            ->where('status', 1)
            ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // BLOG TAGS
    public function blogTags()
    {
        $posts = Post::latest()->withCount('comments')
            ->whereHas('tags', function ($query) {
                $query->where('tags.slug', '=', request('slug'));
            })
            ->where('status', 1)
            ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // BLOG AUTHOR
    public function blogAuthor()
    {
        $posts = Post::latest()->withCount('comments')
            ->whereHas('user', function ($query) {
                $query->where('username', '=', request('username'));
            })
            ->where('status', 1)
            ->paginate(10);

        return view('pages.blog.index', compact('posts'));
    }

    // MESSAGE TO AGENT (SINGLE AGENT PAGE)
    public function messageAgent(Request $request)
    {
        $request->validate([
            'agent_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        Message::create($request->all());

        if ($request->ajax()) {
            return response()->json(['message' => 'Message send successfully.']);
        }

    }

    // CONATCT PAGE
    public function contact()
    {
        return view('pages.contact');
    }

    public function messageContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        $message = $request->message;
        $mailfrom = $request->email;

        Message::create([
            'agent_id' => 1,
            'name' => $request->name,
            'email' => $mailfrom,
            'phone' => $request->phone,
            'message' => $message,
        ]);

        $adminname = User::find(1)->name;
        $mailto = $request->mailto;

        Mail::to($mailto)->send(new Contact($message, $adminname, $mailfrom));

        if ($request->ajax()) {
            return response()->json(['message' => 'Message send successfully.']);
        }

    }

    public function contactMail(Request $request)
    {
        return $request->all();
    }

    // GALLERY PAGE
    public function gallery()
    {
        $galleries = Gallery::latest()->paginate(12);

        return view('pages.gallery', compact('galleries'));
    }

}
