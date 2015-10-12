@extends('layout.backend')

@section('content')

	<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => 'client.store','class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('client')) has-error @endif">
			{{ Form::label('clienttype_desc', 'Client Type') }}
			{{ Form::text('client','',array('class' => 'form-control', 'placeholder' => 'Client Type', 'id' => 'clienttype_input')) }}
			@if ($errors->has('client')) <p class="help-block">{{ $errors->first('client') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('description')) has-error @endif">
			{{ Form::label('desc', 'Description') }}
			{{ Form::text('description','',array('class' => 'form-control', 'placeholder' => 'Client Description', 'id' => 'clienttype_input')) }}
			@if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('client.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop