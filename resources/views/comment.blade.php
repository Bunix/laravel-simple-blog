@extends('layouts.app')

@section('content')
		<div class="card p-5 w-100 mx-auto">
			<div class="card-heading">
				<h4>{{ $article->title}}</h4>
			</div>
			<div class="card-subtitle">
				<p>By {{ $article->author->name}} {{ $article->created_at->format('M-d-Y')}}</p>
			</div>
			<img class="card-img-top w-100"  src="{{$article->src}}" alt="Card image cap">
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
						<a class="nav-link p-0 pl-3"><i class="fa fa-share-alt pr-2"></i></a></li>

				</ul>
			<div class="comment-container">
				<h5>comments</h5>
				@foreach($article->comments as $comment)
				<div class="card pl-3 mt-3">
					<div class="card-heading">{{$comment->user->name}}</div>
					<div class="card-block">
						<p>{{ $comment->body}}</p>
						<div class="card-footer">
							<ul class="nav">
								<li class="nav-item p-0">
									<a class="nav-link p-0" 
									onclick="javascript:like('comment',{{$comment->id}})"><i class="fa fa-thumbs-o-up"></i>
										{{$comment->likes->count()}}
									</a>
								</li>
								<li class="nav-item p-0">
									<a class="nav-link p-0 pl-3" 
									onclick="javascript:dislike('comment',{{$comment->id}})">
									<i class="fa fa-thumbs-o-down"></i>
									{{$comment->dislikes->count()}}
								    </a>
								</li>
								<li class="nav-item p-0">
									<a href="{{route('reply.view',['id'=>$comment->id])}}" class="nav-link p-0 pl-3">
									<i class="fa fa-reply"></i>
									{{$comment->replies->count()}}
								    </a>
								</li>
						     </ul>
						</div>
					</div>
				</div>
				@endforeach
			
				    <form method="POST" action="{{route('comment.store')}}">
				    	{{ csrf_field() }}
				    	<input type="hidden" name="_type" value="Article">
				    	<input type="hidden" name="_id" value="{{$article->id}}">
						<div class="form-group{{ $errors->has('body') ? ' has-warning' : '' }}">
							<label class="form-control-label" for="textarea">Comment</label>
							<textarea class="form-control" id="textarea" name="body"></textarea>
							@if ($errors->has('body'))
                                    <span class="has-warning">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
						</div>
						<div class="form-group">
							<input type="submit" value="comment">
						</div>
					</form>
				</div>
			</div>
		</div>
@endsection()