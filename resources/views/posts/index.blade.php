@extends('layouts.app')

@section('content')
        <h1>Posts</h1>

        @if(count($posts) > 0)
  
           
               @foreach($posts as $post)
                 
                <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><h3><a href="/posts/{{$post->id}}">posted at:   {{$post->title}}</a></h3></li>
                    <li class="list-group-item"><small>{{$post->created_at}}</small></li>  
                </ul>
                </div>

                @endforeach

        @else
            <p>No posts found</p>

        @endif
       
        
  @endsection