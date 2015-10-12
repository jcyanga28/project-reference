@extends('layout.backend')

@section('content')

	<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => 'assign.area.store','class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('area_place')) has-error @endif">
			{{ Form::label('area_desc', 'Area Place') }}
			{{ Form::select('area_place', array('' => 'SELECT AREA') + $areas, null, array('class' => 'form-control', 'id' => 'assignarea_select')) }}
			@if ($errors->has('area_place')) <p class="help-block">{{ $errors->first('area_place') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('bdo_name')) has-error @endif">
			{{ Form::label('bdo_desc', 'BDO NAME') }}
			{{ Form::select('bdo_name', array('' => 'SELECT BDO') + $users, null, array('class' => 'form-control', 'id' => 'assignarea_select')) }}
			@if ($errors->has('bdo_name')) <p class="help-block">{{ $errors->first('bdo_name') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('area.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>


@stop