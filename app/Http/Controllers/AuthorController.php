<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Author;

class AuthorController extends Controller
{
    public function login(Request $request)
    {
        $authorId = $request->input('id');
        
        try {
            $author = Author::find($authorId);
        
            if ($author) {
                Auth::guard('author')->login($author);
                $request->session()->regenerate();
                return redirect()->route('author.dashboard');
            } else {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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

    // AuthorController.php
    public function dashboard()
    {
        $author = Auth::guard('author')->user();

        if (!$author) {
            \Log::info('No authenticated author found.');
            return redirect()->route('login')->withErrors(['message' => 'You must be logged in to access this page.']);
        }

        return view('author.dashboard', ['author' => $author]);
    }


    public function logout(Request $request)
    {
        Auth::guard('author')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
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