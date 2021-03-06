<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use Illuminate\Support\Facades\Storage;
use DB;

class PostsController extends Controller
{

  // ensure the user is authenticated
  /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          // $posts= Post::all();
          //$posts= Post::all();
          //$posts= DB::select('select * from posts');

         //  
         //  $posts= Post::paginate(4);
         //eager loading
           $posts= Post::orderBy('created_at','desc')->with('user','likes')->paginate(5);
           return view('posts.index')->with('posts',$posts);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate(request(),[
        'title'=>'required',
        'body'=>'required',
        'cover_image'=>'image|nullable|max:1999'
      ]);

      //handle file upload
      if($request->hasFile('cover_image')){
        //get filename with extension
        $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
        //get just filename
        $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
        //get just extension
        $extension=$request->file('cover_image')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore=$filename.'_'.time().'.'.$extension;
        //upload image
        $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        
      }else

      {
        $fileNameToStore='noimage.jpg';
      }


        
        $post= new Post;
        $post->title= $request->title;
        $post->body= $request->body;
        $post -> cover_image= $fileNameToStore;
        $post ->user_id= auth()->user()->id;
        $post->save();

      return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $post =Post::find($id);
       return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post =Post::find($id);

      if(auth()->user()->id !== $post->user_id){
        return redirect('/posts')->with('error','Unauthorized Page');
      }

      return view('posts.edit')->with('post',$post);
       
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
      $this->validate(request(),[
        'title'=>'required',
        'body'=>'required',
        'cover_image'=>'image|nullable|max:1999'
      ]);

      //handle file upload
      if($request->hasFile('cover_image')){
        //get filename with extension
        $filenameWithExt=$request->file('cover_image')->getClientOriginalName();
        //get just filename
        $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
        //get just extension
        $extension=$request->file('cover_image')->getClientOriginalExtension();
        //filename to store
        $fileNameToStore=$filename.'_'.time().'.'.$extension;
        //upload image
        $path=$request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        
      }
      

        $post =Post::find($id);
        $post->title= $request->title;
        $post->body= $request->body;
        if($request->hasFile('cover_image')){
          $post -> cover_image= $fileNameToStore;
        }
        $post ->user_id= auth()->user()->id;
        $post->save();

      return redirect('/posts')->with('success','Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

   
    public function destroy(Post $post)
    {

      // $post =Post::find($id);

      //if img is not empty,delete it
     if($post -> cover_image !== 'noimage.jpg'){
      Storage::delete('public/cover_images/'.$post->cover_image);
      }
      $this -> authorize('delete',$post); //the user is implicit
      $post->delete();

      // if(auth()->user()->id !== $post->user_id){
      //   return redirect('/posts')->with('error','Unauthorized Page');
      // }

      return redirect('/posts')->with('success','Post deleted');
    }
}
