@extends('layouts.admin')

@section('content')
<div class="container">
	        <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link bg-primary" href="{{route('tag.create')}}">New Tag</a>
              </li>
            </ul>
   
    @include('components.flash')

   <div class="panel panel-default">
   	<div class="panel-heading">Tags</div>
   	<div class="panel-body">
   		@foreach($tags as $t)
   		<span class="btn"><a href="{{route('tag.edit',['id'=>$t->id])}}">{{$t->name}}</a></span>
   		@endforeach
   	</div>
   </div>
</div>
@endsection