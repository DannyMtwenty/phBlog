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
 @auth
        {{-- if post belong to user --}}
    {{-- @if (auth::user()->id == $post->user_id) --}}
    @can('delete', $post)
    
      <a href="/posts/{{$post->id}}/edit" class="btn btn-sm btn-warning">Edit</a>

      <form action="{{ route('post.delete',$post) }}"  method="POST" class="mr-1">
        @csrf   
        @method('DELETE')      
        <button type="submit" class="bg-blue-500 hover:bg-red-700 text-danger font-bold py-2 px-4 rounded">Delete</button>
    </form> 
    {{-- @endif --}}
    @endcan

   @endauth
  </div>
</div>


              
       
        
  @endsection