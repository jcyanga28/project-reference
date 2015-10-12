@extends('layout.backend')

@section('content')

<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => array('project.category.update', $categories->id), 'method' => 'PUT', 'class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('project_category')) has-error @endif">
			{{ Form::label('category_desc', 'Project Category') }}
			{{ Form::text('project_category', strtoupper($categories->category), array('class' => 'form-control', 'placeholder' => 'Project Category', 'id' => 'projects_input')) }}
			@if ($errors->has('project_category')) <p class="help-block">{{ $errors->first('project_category') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('description')) has-error @endif">
			{{ Form::label('description', 'Description') }}
			{{ Form::text('description', strtoupper($categories->description), array('class' => 'form-control', 'placeholder' => 'Write Description here.', 'id' => 'projects_input')) }}
			@if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('project.category.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop