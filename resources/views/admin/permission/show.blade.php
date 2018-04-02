@extends('layouts.app')

@section('content')
<div class="container">
   <div class="panel panel-default">
   	<div class="panel-heading">permission</div>
   	<div class="panel-body">
   		<h4>{{$permission->name}}</h4>
   		<div>
   			@foreach($permission->roles as $role)
               <span>{{$role->name}}</span>
   			@endforeach
   		</div>
   	</div>
   </div>
</div>
@endsection