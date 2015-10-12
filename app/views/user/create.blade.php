@extends('layout.backend')

@section('content')

	<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => 'user.store','class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('first_name')) has-error @endif">
			{{ Form::label('firstname_desc', 'First Name') }}
			{{ Form::text('first_name','',array('class' => 'form-control', 'placeholder' => 'First Name', 'id' => 'users_input')) }}
			@if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('middle_initial')) has-error @endif">
			{{ Form::label('middleinitial_desc', 'Middle Initial') }}
			{{ Form::text('middle_initial','',array('class' => 'form-control', 'placeholder' => 'Middle Innitial', 'id' => 'users_input')) }}
			@if ($errors->has('middle_initial')) <p class="help-block">{{ $errors->first('middle_initial') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('last_name')) has-error @endif">
			{{ Form::label('lastname_desc', 'Last Name') }}
			{{ Form::text('last_name','',array('class' => 'form-control', 'placeholder' => 'Last Name', 'id' => 'users_input')) }}
			@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('department')) has-error @endif">
			{{ Form::label('department_desc', 'Department') }}
			{{ Form::select('department',$departments, null, array('class' => 'form-control', 'id' => 'users_input')) }}
			@if ($errors->has('department')) <p class="help-block">{{ $errors->first('department') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('name')) has-error @endif">
			{{ Form::label('role_desc', 'Role') }}
			{{ Form::select('name',$roles, null, array('class' => 'form-control', 'id' => 'users_input')) }}
			@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('email')) has-error @endif">
			{{ Form::label('email_desc', 'E-mail') }}
			{{ Form::text('email','',array('class' => 'form-control', 'placeholder' => 'E-mail', 'id' => 'users_input')) }}
			@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('username')) has-error @endif">
			{{ Form::label('username_desc', 'Username') }}
			{{ Form::text('username','',array('class' => 'form-control', 'placeholder' => 'Username', 'id' => 'users_input')) }}
			@if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('password')) has-error @endif">
			{{ Form::label('password_desc', 'Password') }}
			{{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password', 'id' => 'users_input')) }}
			@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
			{{ Form::label('passwordconfirmation_desc', 'Password Confirmation') }}
			{{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Confirm Password', 'id' => 'users_input')) }}
			@if ($errors->has('password_confirmation')) <p class="help-block">{{ $errors->first('password_confirmation') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('user.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop