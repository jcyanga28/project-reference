@extends('layout.backend')

@section('content')

<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => array('item.update', $item->id), 'method' => 'PUT', 'class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('item')) has-error @endif">
			{{ Form::label('item_desc', 'Item') }}
			{{ Form::text('item', strtoupper($item->item), array('class' => 'form-control', 'placeholder' => 'Item', 'id' => 'item_input')) }}
			@if ($errors->has('item')) <p class="help-block">{{ $errors->first('item') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('item.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop