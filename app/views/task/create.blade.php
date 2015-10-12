@extends('layout.backend')

@section('content')

	<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => 'task.store','class' => 'bs-component')) }}
		<div class="form-group @if ($errors->has('task')) has-error @endif">
			{{ Form::label('task_desc', 'Request Type') }}
			{{ Form::text('task','',array('class' => 'form-control', 'placeholder' => 'Task', 'id' => 'task_input')) }}
			@if ($errors->has('task')) <p class="help-block">{{ $errors->first('task') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('description')) has-error @endif">
			{{ Form::label('desc', 'Description') }}
			{{ Form::text('description','',array('class' => 'form-control', 'placeholder' => 'Description', 'id' => 'desc_input')) }}
			@if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
		</div>
		<br/>

		<div class="form-group">
			<b style="font-size:13px;">REQUEST RECEIVER</b>
			<br/>
			@foreach($get_user as $row)
			 <span>{{ Form::checkbox('task_receiver[]', $row->id) }}</span> <span style="font-size:11px;font-family:Tahoma;">{{ Form::label('task_receiver_names', $row->first_name . ' ' . $row->last_name, array('class' => 'control-label')) }}</span><br/>
			@endforeach
		</div>
		<br/>

		<div class="form-group">
			<b style="font-size:13px;">REQUEST APPROVER</b>
			<br/>
			@foreach($get_user as $row)
			 <span>{{ Form::checkbox('task_approver[]', $row->id) }}</span> <span style="font-size:11px;font-family:Tahoma;">{{ Form::label('task_approver_names', $row->first_name . ' ' . $row->last_name, array('class' => 'control-label')) }}</span><br/>
			@endforeach
		</div>		
		
		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('task.index', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
@stop