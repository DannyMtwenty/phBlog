@extends('layouts.app')

@section('content')
<h1>Create Post</h1>

{!! Form::open(['action' => ['App\Http\Controllers\PostsController@update',$post->id], 'method' => 'POST','enctype'=>"multipart/form-data"]) !!}
<div class='form-group'>
 {{   Form::label('title', 'Title');}}
   {{ Form::text('title', $post-> title, ['class' => 'form-control','placeholder'=> 'title']);}}
</div>
<div class='form-group'>
   {{ Form::label('body', 'Body');}}
    {{Form::textarea('body', $post-> body, ['class' => 'form-control', 'placeholder'=> 'body']);}}
    </div>

    <div class='form-group'>
     
      {{Form::file('cover_image',['class' => 'mt-2']);}}
      </div>  


    {{Form::hidden('_method','PUT');}}


    {{Form::submit('Submit', ['class' => 'btn btn-primary mt-2']);}}

   
{!! Form::close() !!}
       
@endsection
  