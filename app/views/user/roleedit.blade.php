@extends('layout.backend')

@section('content')

<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => array('role.updateprivilleges', $user_id), 'method' => 'PUT', 'class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('name')) has-error @endif">
			{{ Form::label('role', 'Update User-Role') }}
			{{ Form::select('name', array($myrole->id => $myrole->name) + $roles, null, array('class' => 'form-control', 'id' => 'update_userrole')) }}
			@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('user.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop