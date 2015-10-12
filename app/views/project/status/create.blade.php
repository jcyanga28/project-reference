@extends('layout.backend')

@section('content')

	<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => 'project.status.store','class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('project_status')) has-error @endif">
			{{ Form::label('status_desc', 'Project Status') }}
			{{ Form::text('project_status','',array('class' => 'form-control', 'placeholder' => 'Project Status', 'id' => 'projects_input')) }}
			@if ($errors->has('project_status')) <p class="help-block">{{ $errors->first('project_status') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('description')) has-error @endif">
			{{ Form::label('description', 'Description') }}
			{{ Form::text('description','',array('class' => 'form-control', 'placeholder' => 'Write Description here.', 'id' => 'projects_input')) }}
			@if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('project.status.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop