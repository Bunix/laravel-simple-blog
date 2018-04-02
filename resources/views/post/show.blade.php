@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Post</div>
			<div class="panel-body">
				<div><a href=""></a>{{$post->title}}</div>
				<img src="">
				<div>{{$post->desc}}</div>
				<div>
					<span><a href="{{route('post.edit',['id'=>$post->id])}}">edit</a>
                    <span><a href="">delete</a>
				</div>
			</div>
		</div>
	</div>
@endsection