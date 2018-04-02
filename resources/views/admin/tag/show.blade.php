@extends('layouts.app')

@section('content')
<div class="container">
   <div class="panel panel-default">
   	<div class="panel-heading">Tag</div>
   	<div class="panel-body">
   		<h4>{{$tag->name}}</h4>
   	</div>
   </div>
</div>
@endsection