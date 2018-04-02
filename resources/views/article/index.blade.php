@extends('layouts.admin')

@section('content')
   <div>
   	   <h1>Articles</h1>
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link bg-primary" href="{{route('article.create')}}">Create a Article</a>
              </li>
            </ul>
   	   @include('components.flash')
   	    <table class="table-responsive table-sm w-100">
   	   	<caption>Articles table</caption>
   	   	<thead>
   	   		<tr>
   	   			<th>Title</th>
   	   			<th>desc</th>
                  <th>publish</th>
   	   			<th>Actions</th>
   	   		</tr>
   	   	</thead>
   	   	<tbody>
   	   		@foreach($articles as $article)
   	   		<tr>
   	   			<td>{{$article->title}}</td>
   	   			<td>{{$article->desc}}</td>
                  <td>{{($article->published == 1 )?'true':'false'}}</td>
   	   			<td>
   	   				<div>
   	   				  <span>
   	   				  	<a href="{{route('article.edit',['id'=>$article->id])}}">
   	   				  	<i class="fa fa-edit"></i></a>
   	   				  </span>
   	   				  <span>
   	   				  	<a href="{{route('article.show',['id'=>$article->id])}}">
   	   				  	<i class="fa fa-eye"></i></a>
   	   				  </span>
   	   				  <span>
                        <a href="{{route('article.destroy',['id'=>$article->id])}}"
                           onclick="event.preventDefault();
                           document.getElementById('delete-form').submit()">
                        <i class="fa fa-close"></i>
                        </a>
                        <form id="delete-form" 
                        action="{{route('article.destroy',['id'=>$article->id])}}" method="POST"
                        style="display: none">
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