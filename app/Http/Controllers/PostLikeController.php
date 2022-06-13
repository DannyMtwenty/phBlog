<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostLikeController extends Controller
{
//make sure the user is authenticated
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function store(Post $post,Request $request)
    {
        //creates like
        if($post->likedBy(auth()->user())){

            return response(null,404);
        }
        else
        {
            $post->likes()->create(['user_id'=>$request->user()->id]);       

        return back();
    }

    }
    public function destroy(Post $post,Request $request)
    {
        //deletes like 
        $request->user()->likes()->delete(['post_id'=>$post->id]);
        return back();    
    }
        
}
