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

    <hr>
    
    <div class="d-flex flex-row ">
    <a href="/posts/" class="btn btn-sm btn-primary">Back</a>
    <a href="/posts/{{$post->id}}/edit" class="btn btn-sm btn-warning">Edit</a>

    {{Form::open(['action' => ['App\Http\Controllers\PostsController@destroy',$post->id], 'method' => 'POST', 'class' => 'float-right'])}}
    {{Form::hidden('_method','DELETE')}}
    {{Form::submit('Delete', ['class' => 'btn btn-sm btn-danger '])}}
    {{Form::close()}}

    </div>
    
    
  </div>
</div>

              
       
        
  @endsection