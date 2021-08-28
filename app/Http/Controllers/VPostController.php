<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\VPost;
use Auth;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class VPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except('index', 'show');
    }

    public function index()
    {
        return view('vBlog.index')->with('posts', VPost::orderBy('updated_at', 'DESC')->get());
    }

    public function create()
    {
        return view('vBlog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'banner' => 'nullable|image|max:5048'
        ]);

        if (!empty($request->banner)) {
            $newImageName = uniqid() . '-' . $request->title . '.' . $request->banner->extension();
            $request->banner->move(public_path('vBlog'), $newImageName);
        }

        Auth::user()->posts()->create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'banner' => $newImageName ?? null,
        ]);

        return redirect(route('VPost.index'))->with('message', 'Your post has been added!');
    }

    public function show($id)
    {
        $post = $this->checkPostIfExisted($id);

        if (!$post) {
            return redirect(route('VPost.index'))->with('message', 'Post Not Found!');
        }

        $post->increment('view_click');
        return view('VBlog.show')->with('post', $post->first());
    }

    public function edit($id)
    {
        $post = $this->checkPostIfExisted($id);

        if (!$post) {
            return redirect(route('VPost.index'))->with('message', 'Post Not Found!');
        }

        return view('VBlog.edit')->with('post', $post->first());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = $this->checkPostIfExisted($id);

        if (!$post) {
            return redirect(route('VPost.index'))->with('message', 'Post Not Found!');
        }

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect(route('VPost.index'))->with('message', 'Your post has been updated!');
    }

    public function destroy($id)
    {
        $post = $this->checkPostIfExisted($id);

        if (!$post) {
            return redirect(route('VPost.index'))->with('message', 'Post Not Found!');
        }

        $post->delete();
        return redirect(route('VPost.index'))->with('message', 'Your post has been deleted!');
    }

    private function checkPostIfExisted($id)
    {
        $post = VPost::find($id);
        if ($post->count() === 0) return false;
        return $post;
    }
}
