@extends('layout.backend')

@section('content')

<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => 'task.forcontact.store','class' => 'bs-component', 'files' => true)) }}
		<div class="form-group @if ($errors->has('contact')) has-error @endif">
			{{ Form::label('contact_desc', '*Contact Person') }} <b style="font-size:11px;font-style:italic;">(In-Company or Individual)</b>
			<span>{{ Form::select('contact', array('' => 'SELECT CONTACT PERSON') + $get_contact, null, array('class' => 'form-control contact_input', 'id' => 'contact_person')) }}</span>
			@if ($errors->has('contact')) <p class="help-block">{{ $errors->first('contact') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('task')) has-error @endif">
			{{ Form::label('task_desc', '*Request Type') }}
			<span>{{ Form::select('task', array('' => 'SELECT REQUEST TYPE') + $get_task, null, array('class' => 'form-control contact_task_input', 'id' => 'contact_person_task')) }}</span>
			@if ($errors->has('task')) <p class="help-block">{{ $errors->first('task') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('amount')) has-error @endif">
			{{ Form::label('amount_desc', '*Amount') }}
			{{ Form::text('amount','',array('class' => 'form-control', 'placeholder' => '0.00', 'id' => 'amount_input')) }}
			@if ($errors->has('amount')) <p class="help-block">{{ $errors->first('amount') }}</p> @endif
		</div>

		<div class="form-group">
			<div class="row">
			  <div class="col-lg-6">
				{{ Form::label('date_start_desc', '*Date Start', array('class' => 'control-label')) }}<br/>
				<span>{{ Form::text('date_start', '', array('class' => 'form-control date_input', 'id' => 'daterange_start', 'data-date-format' => 'mm/dd/yyyy', 'placeholder' => 'mm/dd/yyyy')) }}</span>
				@if ($errors->has('date_start')) <p class="help-block">{{ $errors->first('date_start') }}</p> @endif
			  </div>
			  
			  <div class="col-lg-6">	
			    {{ Form::label('date_end_desc', '*Date End', array('class' => 'control-label')) }}<br/>
			    <span>{{ Form::text('date_end', '', array('class' => 'form-control date_input', 'id' => 'daterange_end', 'data-date-format' => 'mm/dd/yyyy', 'placeholder' => 'mm/dd/yyyy')) }}</span>
			    @if ($errors->has('date_end')) <p class="help-block">{{ $errors->first('date_end') }}</p> @endif
			  </div>
			</div>  	
		</div>

		<div class="form-group @if ($errors->has('remarks')) has-error @endif">
			{{ Form::label('remarks_desc', '*Remarks') }}
			{{ Form::textarea('remarks', 'Write remarks here.', array('size' => '65x4', 'id' => 'remarks_input')) }}
			@if ($errors->has('remarks')) <p class="help-block">{{ $errors->first('remarks') }}</p> @endif
		</div>
		
		<div class="form-group">
			{{ Form::label('filesimg_desc', 'Attach File/Image', array('class' => 'control-label')) }}
			<span>{{ Form::file('image[]', array('id' => 'photo_files', 'class' => 'photo_files', 'accept' => 'pdf|gif|jpg|png|xls|xlsx|doc|docx|jpeg|bmp', 'multiple'=>true)) }}</span>
			@if ($errors->has('image')) <p class="help-block">{{ $errors->first('image') }}</p> @endif
		</div>
		<hr/>

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('create.mytask', 'Back', array(), array('class' => 'btn btn-default')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>

<script type="text/javascript">
$(document).ready(function() {	
var domain ="http://"+document.domain;

	$('#photo_files').MultiFile({ 
	  STRING: {
	   remove: '<img src="<?php echo URL::asset('asset/img/delete.png') ?>" height="16" width="15" alt="x"/>'
	  }
	 }); 

	$("#daterange_start").datepicker({
		dateFormat: "mm-dd-yy",
		onSelect: function(selected) {
		  $("#daterange_end").datepicker("option","minDate", selected)
		}
		
	});

	$("#daterange_end").datepicker({
		dateFormat: "mm-dd-yy",
		onSelect: function(selected) {
		  $("#daterange_start").datepicker("option","maxDate", selected)
		}
	});


});
</script>

@stop