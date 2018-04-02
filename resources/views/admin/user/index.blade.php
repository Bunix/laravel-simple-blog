@extends('layouts.admin')

@section('content')
	<div>
   	   <h1>Users</h1>
            <ul class="nav nav-pills">
              <li class="nav-item ">
                <a class="nav-link bg-primary" href="{{route('user.create')}}">New User</a>
              </li>
            </ul>
   	   @include('components.flash')
   	    <table class="table-responsive table-sm w-100">
   	   	<caption>Videos table</caption>
   	   	<thead>
   	   		<tr>
   	   			<th>Name</th>
   	   			<th>Email Address</th>
                  <th>Role</th>
   	   			<th>Actions</th>
   	   		</tr>
   	   	</thead>
   	   	<tbody>
   	   		@foreach($users as $user)
   	   		<tr>
   	   			<td>{{$user->name}}</td>
   	   			<td>{{$user->email}}</td>
                <td>@foreach($user->roles as $role)
                          {{$role->name}}
                    @endforeach
                </td>
   	   			<td>
   	   				<div>
   	   				  <span>
   	   				  	<a href="{{route('user.edit',['id'=>$user->id])}}">
   	   				  	<i class="fa fa-edit"></i></a>
   	   				  </span>
   	   				  <span>
   	   				  	<a href="{{route('user.show',['id'=>$user->id])}}">
   	   				  	<i class="fa fa-eye"></i></a>
   	   				  </span>
   	   				  <span>
   	   				  	<a href="{{route('user.destroy',['id'=>$user->id])}}"
                           onclick="event.preventDefault();
                           document.getElementById('delete-form').submit();">
   	   				  	<i class="fa fa-close"></i></a>
                        <form id="delete-form" action="{{route('user.destroy',['id'=>$user->id])}}" method="POST" style="display: none;">
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