<?php

namespace App\Http\Controllers;

use App\Events\BlogCreated;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::where('status', 'published')->get();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Display a listing of the user's blogs.
     */
    public function userBlogs(User $user){
        $blogs = Blog::whereBelongsTo($user)->get();
        return view('blogs.user_blogs', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        if($request->hasFile('image')){
            $path = $request->file('image')->store('images', 'public');
        }

        $blog = Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path ?? null,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return redirect()->route('blogs.index')->with('message', 'Blog created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        if($blog->user_id !== Auth::id()){
            return redirect()->route('blogs.index')->with('error', 'You are not authorized to edit this blog.');
        }

        if($request->hasFile('image')){
            if($blog->image && Storage::disk('public')->exists($blog->image)){
                Storage::disk('public')->delete($blog->image);
            }
            $path = $request->file('image')->store('images', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $path ?? $blog->image,
        ]);

        return redirect()->route('blogs.index')->with('message', 'Blog created successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if($blog->user_id !== Auth::id()){
            return redirect()->route('blogs.index')->with('error', 'You are not authorized to delete this blog.');
        }

        if($blog->image && Storage::disk('public')->exists($blog->image)){
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('message', 'Blog deleted successfully!');
    }
}
