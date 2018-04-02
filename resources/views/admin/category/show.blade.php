@extends('layouts.app')

@section('content')
<div class="container">
   <div class="panel panel-default">
   	<div class="panel-heading">Category</div>
   	<div class="panel-body">
   		<h4>{{$category->name}}</h4>
   	</div>
   </div>
</div>
@endsection