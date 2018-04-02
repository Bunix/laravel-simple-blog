@extends('layouts.app')

@section('content')
     <div class="card p-5 w-100 mx-auto">
     	<div class="card-heading">
				<h4>{{ $comment->commentable->title}}</h4>
				<p>{{$comment->user->name}} | {{$comment->created_at->format('M-d-Y')}}</p>
	    </div>
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
						     </ul>
			</div>	    	

	    	@if($comment->replies->count() == 0)
               <i>Be the first to comment</i>
            @else
               <i>Replies</i>
	    	@endif
	    	
	     	@foreach($comment->replies as $reply)
						<div class="card mt-2 pl-2">
							<div class="card-heading">{{ $reply->user->name}}</div>
							<div class="card-block">
								{{ $reply->body}}
							</div>
							<div class="card-footer">
								<ul class="nav">
									<li class="nav-item p-0">
										<a class="nav-link p-0" 
										onclick="javascript:like('reply',{{$reply->id}})">
											<i class="fa fa-thumbs-o-up"></i>
											{{ $reply->likes->count()}}
										</a>
									</li>
									<li class="nav-item p-0">
										<a class="nav-link p-0 pl-3" 
										onclick="javascript:dislike('reply',{{$reply->id}})">
										<i class="fa fa-thumbs-o-down"></i>
										{{$reply->dislikes->count()}}
									    </a>
									</li>
							     </ul>
						    </div>
						</div>
			@endforeach

						<form method="POST" action="{{route('reply.store')}}">
					    	{{ csrf_field() }}
					    	<input type="hidden" name="_id" value="{{$comment->id}}">

							<div class="form-group{{ $errors->has('reply') ? ' has-warning' : '' }}">
								<label class="form-control-label" for="textarea">Reply</label>
								<textarea class="form-control" id="textarea" name="reply"></textarea>
								@if ($errors->has('reply'))
                                    <span class="has-warning">
                                        <strong>{{ $errors->first('reply') }}</strong>
                                    </span>
                                @endif
							</div>
							<div class="form-group">
								<input type="submit" value="Reply">
							</div>
					    </form>
	    </div>
     </div>
@endsection