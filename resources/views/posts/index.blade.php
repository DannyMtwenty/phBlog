@extends('layouts.app')

@section('content')
        <h1>Posts</h1>

        @if(count($posts) > 0)
  
   <div class="card">  
    <ul class="list-group list-group-flush">"  
               @foreach($posts as $post)

<div class="row">
    <div class="col-md-4">
        <img style="width: 100%"  src="/storage/cover_images/{{$post->cover_image}}" alt=""/>
    </div>
    <div class="col-md-8">
        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>                    
     
        <small><b>{{$post->created_at->diffForHumans()}}</b></small> <br>

     
<div class="flex items-center">

@auth    
    @if(!$post->likedBy(auth()->user())){

        <form action="{{ route('posts.likes',$post) }}" method="POST" class="mr-1">
            @csrf         
            <button type="submit" class="text-blue-500">Like</button>
        </form>
    }
    @else
    {
        
        <form action="{{ route('likes.delete',$post) }}"  method="POST" class="mr-1">
            @csrf   
            @method('DELETE')      
            <button type="submit" class="text-blue-500">Unlike</button>
        </form> 

    }
    @endif
    
@endauth         

        


        <span>{{$post->likes->count()}}-{{Str::plural('like',$post->likes->count())}}</span> 

</div>  
    </div>
</div>


          
       
                @endforeach

                <h4>Pagination</h4>
                {{$posts->links()}}
            
            </ul>

   </div>
 

        @else
            <p>No posts found</p>

        @endif
       
      
  @endsection