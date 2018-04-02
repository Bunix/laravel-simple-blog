@extends('layouts.admin')

@section('content')
<div class="container">
	@include('components.flash')
	
    <div class="panel panel-default">
                <div class="panel-heading">Edit Tag</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{route('tag.update',['id'=>$tag->id])}}">
                    	<input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $tag->name}}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
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