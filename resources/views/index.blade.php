@extends('layouts.app')

@section('content')
     <div>
		@foreach($articles as $article)
		<div class="card p-5 w-100 mx-auto">
			<div class="card-title">
				<h4>{{ $article->title}}</h4>				
			</div>
			<div class="card-subtitle">
				<p>By {{ $article->author->name}} {{ $article->created_at->format('M-d-Y')}}</p>
			</div>
			<img class="card-img-top w-100 h-7"  src="{{$article->src}}" alt="Card image cap">
			<div class="card-block">
				<p>{{ $article->desc}}</p>
			</div>
			<div class="card-footer bg-light">
				<ul class="nav">
					<li class="nav-item p-0">
						<a class="nav-link p-0" 
						    onclick="javascript:like('article',{{$article->id}})">
							<i class="fa fa-thumbs-o-up"></i>
							{{$article->likes->count()}}
						</a>
					</li>
					<li class="nav-item p-0">
						<a class="nav-link p-0 pl-3" 
						onclick="javascript:dislike('article',{{$article->id}})">
						<i class="fa fa-thumbs-o-down"></i>
						{{$article->dislikes->count()}}
					    </a>
					</li>
					<li class="nav-item p-0">
						<a href="{{route('comment.view',['id'=>$article->id])}}" class="nav-link p-0 pl-3" ><i class="fa fa-comments-o pr-2"></i>{{$article->comments->count()}}</a></li>
				    <li class="nav-item p-0">
						<a class="nav-link p-0 pl-3"><i class="fa fa-share-alt pr-2"></i></a>
					</li>

				</ul>
			</div>
		</div>
		@endforeach
	</div>
@endsection