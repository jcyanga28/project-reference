@extends('layout.backend')

@section('content')

	<div class="row">

	<div class="col-lg-6">
		<div class="form-group">
			<img src="{{ URL::asset('asset/img/user-img' . '/' . $userinfo->image) }}" alt="default" class="img-square" style="height: 125px; width: 125px; border: solid 1px #666;border-radius: 10px;">
		</div>
	{{ Form::open(array('route' => array('profile.update', $userinfo->id), 'method' => 'PUT', 'class' => 'bs-component', 'files' => true)) }}
		<div class="form-group">
			{{ Form::label('profilepics_desc', 'Change Profile Picture', array('class' => 'control-label')) }}
			{{ Form::file('image', array('class' => 'photo_files', 'id' => 'profile_input')) }}	
			<span style="font-size: 13px;">IMAGE NAME :</span> &nbsp; {{ Form::label('profilepics_desc', strtoupper($userinfo->image), array('id' => 'yourimg')) }}
		</div>
		<div class="form-group @if ($errors->has('first_name')) has-error @endif">
			{{ Form::label('firstname_desc', 'First Name') }}
			{{ Form::text('first_name', strtoupper($userinfo->first_name), array('class' => 'form-control', 'placeholder' => 'First Name', 'id' => 'profile_input')) }}
			@if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('middle_initial')) has-error @endif">
			{{ Form::label('middleinitial_desc', 'Middle Initial') }}
			{{ Form::text('middle_initial', strtoupper($userinfo->middle_initial), array('class' => 'form-control', 'placeholder' => 'Middle Innitial', 'id' => 'profile_input')) }}
			@if ($errors->has('middle_initial')) <p class="help-block">{{ $errors->first('middle_initial') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('last_name')) has-error @endif">
			{{ Form::label('lastname_desc', 'Last Name') }}
			{{ Form::text('last_name', strtoupper($userinfo->last_name), array('class' => 'form-control', 'placeholder' => 'Last Name', 'id' => 'profile_input')) }}
			@if ($errors->has('last_name')) <p class="help-block">{{ $errors->first('last_name') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('email')) has-error @endif">
			{{ Form::label('email_desc', 'E-mail') }}
			{{ Form::text('email', strtoupper($userinfo->email), array('class' => 'form-control', 'placeholder' => 'E-mail', 'id' => 'profile_input')) }}
			@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
		</div>
		<hr/>

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('user.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>

	{{ Form::close() }}
	</div>
</div>

@stop