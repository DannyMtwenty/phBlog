@extends('layouts.app')

@section('content')
        <h1>Posts</h1>

    



<div class="card" style="width: 30rem;">
  <img class="card-img-top" src="/storage/cover_images/{{$post->cover_image}}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">  {{$post->title}}</h5>
    <p class="card-text">  {{$post->body}}</p>
    <a href="/posts/" class="btn btn-sm btn-primary">Back</a>

       {{-- if user not authenticated --}}
       @if (!auth::guest())
       {{-- if post belong to user --}}
   @if (auth::user()->id == $post->user_id)
       
   
   <a href="/posts/{{$post->id}}/edit" class="btn btn-sm btn-warning">Edit</a>

   {{Form::open(['action' => ['App\Http\Controllers\PostsController@destroy',$post->id], 'method' => 'POST', 'class' => 'float-right'])}}
   {{Form::hidden('_method','DELETE')}}
   {{Form::submit('Delete', ['class' => 'btn btn-sm btn-danger mt-1'])}}
   {{Form::close()}}
   @endif

   @endif
  </div>
</div>


              
       
        
  @endsection