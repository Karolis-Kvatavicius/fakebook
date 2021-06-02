<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($user, $post)
    {
        if (!Like::where('user_id', $user)->where('post_id', $post)->exists()) {
            $data = ['user_id' => $user, 'post_id' => $post];
            Like::create($data);
        }
        return redirect()->back();
    }
}
