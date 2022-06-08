@extends('layouts.app')

@section('content')
        <h1>Posts</h1>

    



<div class="card mt-2">
  <div class="card-header">
  {{$post->title}}
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <p class="card-text">{{$post->body}}</p>
    <a href="/posts/{{$post->id}}">posted at: {{$post->created_at}}</a>

    <a href="/posts/" class="btn btn-sm btn-primary">Back</a>
    
  </div>
</div>

              
       
        
  @endsection