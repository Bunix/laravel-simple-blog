@extends('layouts.admin')

@section('content')
<div class="container">
   <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link bg-primary" href="{{route('role.create')}}">New Role</a>
              </li>
    </ul>
    @include('components.flash')

   <div class="panel panel-default">
   	<div class="panel-heading">Roles</div>
   	<div class="panel-body">
   		@foreach($roles as $r)
   		<span class="btn"><a href="{{route('role.edit',['id'=>$r->id])}}">{{$r->name}}</a></span>
   		@endforeach
   	</div>
   </div>
</div>
@endsection