@extends('layouts.admin')

@section('content')
<div class="container">
	@include('components.flash')
	
    <div class="panel panel-default">
                <div class="panel-heading">Edit Role</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('role.update',['id'=>$role->id])}}">
                    	<input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Role Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $role->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Permissions</label>

                            <div class="col-md-6">
                                @foreach($permissions as $p)
                                   <input type="checkbox" name="permissions[]" value="{{$p->id}}"
                                       @if($role->permissions->contains($p->id))
                                       checked=checked
                                       @endif
                                   >
                                   <label>{{$p->name}}</label>
                                @endforeach

                                @if ($errors->has('permission'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('permission') }}</strong>
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