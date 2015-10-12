@extends('layout.backend')

@section('content')

<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => array('department.update', $department->id), 'method' => 'PUT', 'class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('department')) has-error @endif">
			{{ Form::label('department_desc', 'Department') }}
			{{ Form::text('department', strtoupper($department->department), array('class' => 'form-control', 'placeholder' => 'Department', 'id' => 'dept_input')) }}
			@if ($errors->has('department')) <p class="help-block">{{ $errors->first('department') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('department.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop