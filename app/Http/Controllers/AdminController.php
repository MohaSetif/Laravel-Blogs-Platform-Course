<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Publishing or rejecting blogs by the admin. 
     */
    public function updateBlogStatus(Request $request, $id){
        $blog = Blog::where('id', $id)->first();
        if(!$blog){
            return response()->json(['message' => 'Blog not found'], 404);
        }

        $blog->status = $request->input('status');
        $blog->update();

        return redirect(route('admin.dashboard'))
            ->with('success', 'Blog status updated successfully');
    }

    public function listBlogs(){
        $blogs = Blog::where('status', 'pending')->get();
        return view('admin.dashboard', compact('blogs'));
    }
}