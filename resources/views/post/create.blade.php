@extends('layouts.admin')

@section('content')
<div class="container">
	<div class="panel">
		<div class="panel-heading">Create Post</div>
		<div class="panel-body">
                    <form class="form-horizontal" method="POST"
                        enctype="multipart/form-data"  action="{{ route('post.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Content</label>

                            <div class="col-md-6">
                                <textarea id="content" class="form-control" name="content">{{old('content')}}</textarea>
                                
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('featured_file') ? ' has-error' : '' }}">
                            <label for="featured_file" class="col-md-4 control-label">Featured Clip</label>

                            <div class="col-md-6">
                                <input id="featured_file" type="file" class="form-control" name="feature_file" value="{{ old('featured_file') }}" required autofocus>

                                @if ($errors->has('featured_file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('featured_file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Category</label>

                            <div class="col-md-6">
                                @foreach($categories as $c)
                                   <span class="d-inline-block">
                                    <input type="checkbox" name="categories[]" value="{{$c->id}}">
                                   <label>{{$c->name}}</label></span>
                                @endforeach

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Tags</label>

                            <div class="col-md-6">
                                @foreach($tags as $t)
                                   <span class="d-inline-block">
                                    <input type="checkbox" name="tags[]" value="{{$t->id}}">
                                   <label>{{$t->name}}</label></span>
                                @endforeach

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
	</div>
</div>
@endsection