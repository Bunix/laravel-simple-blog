@extends('layouts.admin')

@section('content')
<div class="container">
   <div class="panel panel-default">
   	<div class="panel-heading">Role</div>
   	<div class="panel-body">
   		<h4>{{$role->name}}</h4>
   		<div>
   			@foreach($role->permissions as $permission)
               <span>{{$permission->name}}</span>
   			@endforeach
   		</div>
   	</div>
   </div>
</div>
@endsection