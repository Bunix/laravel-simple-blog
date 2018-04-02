@extends('layouts.app')

@section('content')
    <div class="card p-4">
    	<div class="card-subtitle"> Results for your search "{{$query}}"</div>
    	<div class="card-block">
    		@if($results->count() < 1)
    		<p>No results</p>
    		@else

    		  @foreach($results as $result)
	    		<div class="mt-2 p-2">
	    			<div class="card-subtitle">
	    				<a href="{{route('comment.view',['id'=>$result->id])}}">{{$result->title}}</a>
	    			</div>
	    			<div class="card-block">
	    				<p>{{$result->desc}}</p>
	    			</div>
	    		</div>
    		  @endforeach
    		@endif
    	</div>
    </div>
@endsection