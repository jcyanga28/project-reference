@extends('layout.backend')

@section('content')

	<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => 'area.store','class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('area_number')) has-error @endif">
			{{ Form::label('area_no_desc', 'Area Number') }}
			{{ Form::text('area_number','',array('class' => 'form-control', 'placeholder' => 'Area Number', 'id' => 'area_input')) }}
			@if ($errors->has('area_number')) <p class="help-block">{{ $errors->first('area_number') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('area_place')) has-error @endif">
			{{ Form::label('area_place_desc', 'Area Place') }}
			{{ Form::text('area_place','',array('class' => 'form-control', 'placeholder' => 'Area Place', 'id' => 'area_input')) }}
			@if ($errors->has('area_place')) <p class="help-block">{{ $errors->first('area_place') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('area.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop