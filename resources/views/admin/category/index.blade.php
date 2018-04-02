@extends('layouts.admin')

@section('content')
<div class="container">
	<ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link bg-primary" href="{{route('category.create')}}">New Category</a>
              </li>
    </ul>
   
    @include('components.flash')

   <div class="panel panel-default">
   	<div class="panel-heading">Categories</div>
   	<div class="panel-body">
   		@foreach($categories as $c)
   		<span class="btn"><a href="{{ route('category.edit',['id'=>$c->id])}}">{{$c->name}}</a></span>
   		@endforeach
   	</div>
   </div>
</div>
@endsection