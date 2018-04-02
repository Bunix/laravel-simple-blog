@extends('layouts.admin')

@section('content')
	<div class="card">
		<div class="card-heading text-center"><h4 class="card-heading">Create Article</h4></div>
		<div class="card-block mx-auto">
                    <form  method="POST" action="{{ route('article.store') }}"
                    enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="form-control-label">Title</label>

                            <div>
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="form-control-label">Content</label>

                            <div>
                                <textarea id="content" class="form-control" name="content">{{old('content')}}</textarea>
                                
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('featured_file') ? ' has-error' : '' }}">
                            <label for="featured_file" class="col-md-4 control-label">Featured Image</label>

                            <div>
                                <input id="featured_file" type="file" class="form-control" name="featured_file" value="{{ old('featured_file') }}" required autofocus>

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
                        <div class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Tags</label>

                            <div class="col-md-6">
                                @foreach($tags as $t)
                                   <span class="d-inline-block">
                                    <input type="checkbox" name="tags[]" value="{{$t->id}}">
                                   <label>{{$t->name}}</label></span>
                                @endforeach

                                @if ($errors->has('tags'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="Save">
                        </div>
                    </form>
                </div>
	</div>
@endsection