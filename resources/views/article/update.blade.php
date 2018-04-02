@extends('layouts.admin')

@section('content')
<div class="container">
    @include('components.flash')
	<div class="card">
		<div class="card-heading text-center">Edit Article</div>
		<div class="card-block mx-auto">
                    <form method="POST"  enctype="multipart/form-data"
                    action="{{ route('article.update',['id'=>$article->id]) }}">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="form-control-label">Title</label>

                            <div>
                                <input id="title" type="text" class="form-control" name="title" value="{{$article->title}}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="form-control-label">Content</label>

                            <div >
                                <textarea id="content" class="form-control" name="content">
                                    {{$article->desc}}
                                </textarea>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('featured_file') ? ' has-error' : '' }}">
                            <label for="featured_file" class="form-control-label">Featured Image</label>

                            <div>
                                <input id="featured_file" type="file" class="form-control" name="featured_file" value="{{ old('featured_file') }}" required autofocus>
                                <img class="img-fluid" style="max-width: 300px;" src="{{$article->src}}" alt="image">

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
                                    <input type="checkbox" name="categories[]" value="{{$c->id}}"
                                       @if($article->categories->contains($c->id))
                                       checked=checked
                                       @endif
                                   >
                                   <label>{{$c->name}}</label></span>
                                @endforeach

                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Tags</label>

                            <div class="col-md-6">
                                @foreach($tags as $t)
                                   <span class="d-inline-block">
                                    <input type="checkbox" name="tags[]" value="{{$t->id}}"
                                       @if($article->tags->contains($t->id))
                                       checked=checked
                                       @endif
                                   >
                                   <label>{{$t->name}}</label></span>
                                @endforeach

                                @if ($errors->has('tag'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tag') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                        </div>
                    </form>
                </div>
	</div>
</div>
@endsection