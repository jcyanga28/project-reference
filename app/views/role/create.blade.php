@extends('layout.backend')

@section('content')

	<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => 'role.store','class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('name')) has-error @endif">
			{{ Form::label('role', 'Role') }}
			{{ Form::text('name','',array('class' => 'form-control', 'placeholder' => 'Role', 'id' => 'role_input')) }}
			@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('role.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop