@extends('layout.backend')

@section('content')

<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => array('project.classification.update', $classification->id), 'method' => 'PUT', 'class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('project_classification')) has-error @endif">
			{{ Form::label('classification_desc', 'Project Classification') }}
			{{ Form::text('project_classification', strtoupper($classification->classification), array('class' => 'form-control', 'placeholder' => 'Project Classification', 'id' => 'projects_input')) }}
			@if ($errors->has('project_classification')) <p class="help-block">{{ $errors->first('project_classification') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('description')) has-error @endif">
			{{ Form::label('description', 'Description') }}
			{{ Form::text('description', strtoupper($classification->description), array('class' => 'form-control', 'placeholder' => 'Write Description here.', 'id' => 'projects_input')) }}
			@if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('project.classification.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop