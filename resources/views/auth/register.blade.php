@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="mx-auto m-4">
            <div class="card">
               <div class="card-heading text-center"><h3 class="card-title p-2">SignUp</h3></div>
               <div class="card-block px-5">
                   {!! Form::open(['route'=>'register'])!!}

                   <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                       {!! Form::label('name', 'Name', ['class' => 'form-control-label']) !!}
                       {!! Form::text('name', $value = old('name'), $attributes = array('class'=>'form-control','required')) !!}
                               @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                   </div>

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
                       {!! Form::label('password_confirmation', 'Confirm Password', ['class' => 'form-control-label']) !!}
                       {!! Form::password('password_confirmation',['class'=>'form-control','required'] )!!}
                   </div>

                   <div class="form-group">
                       {!! Form::submit('SignUp',['class'=>'btn btn-secondary']) !!}
                   </div>

                   {!! Form::close()!!}
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
