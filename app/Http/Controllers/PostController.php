<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    protected $redirectTo = '/my-posts';

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', ['posts' => Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'bail|required|min:10|max:1000',
            'image' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->image !== null) {
            $filenameWithExt = $request
                ->file('image')
                ->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request
                ->file('image')
                ->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request
                ->file('image')
                ->storePubliclyAs('public/posts-images', $fileNameToStore);

            Post::create([
                'user_id' => Auth::id(),
                'content' => $request['content'],
                'image' => 'storage/posts-images/' . $fileNameToStore,
            ]);
        } else {
            Post::create([
                'user_id' => Auth::id(),
                'content' => $request['content'],
            ]);
        }

        return redirect($this->redirectTo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('create_post', ['post' => Post::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'bail|required|min:10|max:1000',
            'image' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->image !== null) {
            $filenameWithExt = $request
                ->file('image')
                ->getClientOriginalName();
            // Get Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just Extension
            $extension = $request
                ->file('image')
                ->getClientOriginalExtension();
            // Filename To store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request
                ->file('image')
                ->storePubliclyAs('public/posts-images', $fileNameToStore);

            $post = Post::find($id);
            Storage::delete(str_replace('storage/', 'public/', $post->image));
            $post->update([
                'content' => $request['content'],
                'image' => 'storage/posts-images/' . $fileNameToStore,
            ]);
        } else {
            Post::where('id', $id)->update([
                'content' => $request['content'],
            ]);
        }
        return redirect($this->redirectTo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Like::where('user_id', Auth::id())->where('post_id', $id)->delete();
        Comment::where('post_id', $id)->delete();
        $post = Post::find($id);
        Storage::delete(str_replace('storage/', 'public/', $post->image));
        $post->delete();
        return redirect($this->redirectTo);
    }

    // 
    public function showUserPosts()
    {
        $userPosts = Post::where('user_id', Auth::id())->get();
        return view('home', ['posts' => $userPosts]);
    }
}
