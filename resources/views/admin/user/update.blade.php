@extends('layouts.admin')

@section('content')
<div class="container">
	@include('components.flash')
	
    <div class="panel panel-default">
                <div class="panel-heading">Edit User</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('user.update',['id'=>$user->id])}}">
                    	<input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Email Address</label>

                            <div class="col-md-6">
                                <input id="name" type="email" class="form-control" name="email" value="{{ $user->email}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Roles</label>

                            <div class="col-md-6">
                                @foreach($role as $r)
                                   <input type="checkbox" name="roles[]" value="{{$r->id}}"
                                       @if($user->roles->contains($r->id))
                                       checked=checked
                                       @endif
                                   >
                                   <label>{{$r->name}}</label>
                                @endforeach

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
</div>
@endsection