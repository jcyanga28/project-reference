@extends('layout.backend')

@section('content')

	<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => 'designated-position.store','class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('position')) has-error @endif">
			{{ Form::label('position_desc', 'Position') }}
			{{ Form::text('position','',array('class' => 'form-control', 'placeholder' => 'Position', 'id' => 'position_input')) }}
			@if ($errors->has('position')) <p class="help-block">{{ $errors->first('position') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('designated-position.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop