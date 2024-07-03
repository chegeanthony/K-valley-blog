<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('id');

        if (Auth::guard('author')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('author/dashboard');
        }

        return back()->withErrors([
            'id' => 'The provided ID is incorrect.',
        ]);
    }    
    public function dashboard()
    {
        $author = Auth::guard('author')->user();
        $blogs = $author ? DB::table('blogs')->where('author_id', $author->id)->get() : collect();
        return view('author.dashboard', compact('author', 'blogs'));
    }

    public function updateProfile(Request $request)
    {
        $author = Auth::guard('author')->user();
        if ($author) {
            $data = $request->only(['name', 'bio', 'email']);
            DB::table('authors')->where('id', $author->id)->update($data);
            return back()->with('status', 'Profile updated successfully');
        }
        return back()->with('error', 'Unable to update profile');
    }

    public function createBlog(Request $request)
    {
        $author = Auth::guard('author')->user();
        if ($author) {
            $blogData = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'is_published' => 'boolean'
            ]);
            $blogData['author_id'] = $author->id;
            DB::table('blogs')->insert($blogData);
            return redirect()->route('author.dashboard')->with('status', 'Blog created successfully');
        }
        return back()->with('error', 'Unable to create blog');
    }

    public function updateBlog(Request $request, $blogId)
    {
        $author = Auth::guard('author')->user();
        $blog = DB::table('blogs')->where('id', $blogId)->first();
        
        if (!$author || !$blog || $author->id !== $blog->author_id) {
            return back()->with('error', 'Unauthorized action or blog not found.');
        }
        
        $blogData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'is_published' => 'boolean'
        ]);
        
        DB::table('blogs')->where('id', $blogId)->update($blogData);
        return back()->with('status', 'Blog updated successfully');
    }
}