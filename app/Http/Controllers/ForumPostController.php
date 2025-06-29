<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use Illuminate\Http\Request;

class ForumPostController extends Controller
{
    /**
     * Display a listing of the resource with optional category filtering.
     */
    public function index(Request $request)
    {
        $query = ForumPost::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $posts = $query->latest()->paginate(10)->withQueryString();

        return view('forum.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Spreading the Word,Zero Waste,Recipes,Others',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'agreed_to_guidelines' => 'accepted',
        ]);

        $path = $request->file('image')?->store('forum_images', 'public');

        ForumPost::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image_path' => $path,
            'agreed_to_guidelines' => true,
        ]);

        return redirect()->route('forum-posts.index')->with('success', 'Post successfully created!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = ForumPost::findOrFail($id);
        return view('forum.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = ForumPost::findOrFail($id);
        return view('forum.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $post = ForumPost::findOrFail($id);

        // Authorization check
        if ($post->user_id !== auth()->id()) {
            return redirect()->route('forum-posts.index')->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Spreading the Word,Zero Waste,Recipes,Others',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'agreed_to_guidelines' => 'accepted',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('forum_images', 'public');
            $post->image_path = $path;
        }

        $post->title = $request->title;
        $post->category = $request->category;
        $post->content = $request->content;
        $post->agreed_to_guidelines = $request->has('agreed_to_guidelines');

        $post->save();

        return redirect()->route('forum-posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = ForumPost::findOrFail($id);
        $post->delete();

        return redirect()->route('forum-posts.index')->with('success', 'Post deleted successfully!');
    }
}
