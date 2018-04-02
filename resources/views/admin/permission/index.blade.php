@extends('layouts.admin')

@section('content')
<div class="container">
   <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link bg-primary" href="{{route('permission.create')}}">Create a Permission</a>
              </li>
   </ul>
   
    @include('components.flash')

   <div class="panel panel-default">
   	<div class="panel-heading">Permissions</div>
   	<div class="panel-body" >
   		@foreach($permissions as $p)
         <span style="border:1px solid #eee;padding:5px;">
      		<span class="btn"><a href="{{route('permission.edit',['id'=>$p->id])}}">{{$p->name}}</a></span>
         </span>
   		@endforeach
   	</div>
   </div>
</div>
@endsection