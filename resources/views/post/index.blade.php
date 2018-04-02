@extends('layouts.admin')

@section('content')
   <div>
   	   <h1>Videos</h1>
            <ul class="nav nav-pills">
              <li class="nav-item ">
                <a class="nav-link bg-primary" href="{{route('post.create')}}">Create a video Post</a>
              </li>
            </ul>
   	   @include('components.flash')
   	    <table class="table-responsive table-sm w-100">
   	   	<caption>Videos table</caption>
   	   	<thead>
   	   		<tr>
   	   			<th>Title</th>
   	   			<th>desc</th>
                  <th>published</th>
   	   			<th>Actions</th>
   	   		</tr>
   	   	</thead>
   	   	<tbody>
   	   		@foreach($posts as $post)
   	   		<tr>
   	   			<td>{{$post->title}}</td>
   	   			<td>{{$post->desc}}</td>
                  <td>{{($post->published == 1 )?'true':'false'}}</td>
   	   			<td>
   	   				<div>
   	   				  <span>
   	   				  	<a href="{{route('post.edit',['id'=>$post->id])}}">
   	   				  	<i class="fa fa-edit"></i></a>
   	   				  </span>
   	   				  <span>
   	   				  	<a href="{{route('post.show',['id'=>$post->id])}}">
   	   				  	<i class="fa fa-eye"></i></a>
   	   				  </span>
   	   				  <span>
   	   				  	<a href="{{route('post.destroy',['id'=>$post->id])}}"
                           onclick="event.preventDefault();
                           document.getElementById('delete-form').submit();">
   	   				  	<i class="fa fa-close"></i></a>
                        <form id="delete-form" action="{{route('post.destroy',['id'=>$post->id])}}" method="POST" style="display: none;">
                           <input type="hidden" name="_method" value="DELETE">
                         {{ csrf_field() }}
                        </form>
   	   				  </span>
   	   			   </div>
   	   		    </td>
   	   		</tr>
   	   		@endforeach
   	   	</tbody>
   	   </table>
   </div>
	
@endsection