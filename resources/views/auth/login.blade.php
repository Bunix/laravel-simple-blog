@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="mx-auto m-4">
            <div class="card">
               <div class="card-heading text-center"><h3 class="card-title p-2">Login</h3></div>
               <div class="card-block px-5">
                   {!! Form::open(['route'=>'login'])!!}

                   <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                       {!! Form::label('email', 'E-Mail Address', ['class' => 'form-control-label']) !!}
                       {!! Form::email('email', $value = old('email'), $attributes = array('class'=>'form-control','required')) !!}
                               @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                   </div>

                   <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                       {!! Form::label('password', 'Password', ['class' => 'form-control-label']) !!}
                       {!! Form::password('password',['class'=>'form-control','required'] )!!}

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                   </div>

                   <div class="form-group">
                       {!! Form::checkbox('remember')!!}
                       {!! Form::label('remember', 'Remember Me', ['class' => 'form-control-label']) !!}
                   </div>

                   <div class="form-group">
                       {!! Form::submit('Login',['class'=>'btn btn-secondary']) !!}
                       {!! link_to_route('password.request', $title = "Forgot your password!", $parameters = array(), $attributes = array('class'=>'btn btn-link'))!!}
                   </div>

                   {!! Form::close()!!}
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
