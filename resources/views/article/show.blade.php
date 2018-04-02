@extends('layouts.admin')

@section('content')
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Article</div>
			<div class="panel-body">
				<div><a href=""></a>{{$article->title}}</div>
				<img src="">
				<div>{{$article->desc}}</div>
				<div>
					<span><a href="{{route('article.edit',['id'=>$article->id])}}">edit</a>
                    <span><a href="">delete</a>
				</div>
			</div>
		</div>
	</div>
@endsection