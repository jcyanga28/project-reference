@extends('layout.backend')

@section('content')

<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => array('project.stage.update', $stages->id), 'method' => 'PUT', 'class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('project_stage')) has-error @endif">
			{{ Form::label('stage_desc', 'Project Stage') }}
			{{ Form::text('project_stage', strtoupper($stages->stage), array('class' => 'form-control', 'placeholder' => 'Project Stage', 'id' => 'projects_input')) }}
			@if ($errors->has('project_stage')) <p class="help-block">{{ $errors->first('project_stage') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('description')) has-error @endif">
			{{ Form::label('description', 'Description') }}
			{{ Form::text('description', strtoupper($stages->description), array('class' => 'form-control', 'placeholder' => 'Write Description here.', 'id' => 'projects_input')) }}
			@if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('project.stage.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop