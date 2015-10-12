@extends('layout.backend')

@section('content')

<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('route' => array('task.forcompany.update', $get_taskforcompany->id), 'method' => 'PUT', 'class' => 'bs-component', 'files' => true)) }}
		<div class="form-group @if ($errors->has('company')) has-error @endif">
			{{ Form::label('company_desc', '*Company Name') }}
			<span>{{ Form::select('company', array($my_company->id => $my_company->company_name) + $get_company, null, array('class' => 'form-control company_input', 'id' => 'company_name')) }}</span>
			@if ($errors->has('company')) <p class="help-block">{{ $errors->first('company') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('task')) has-error @endif">
			{{ Form::label('task_desc', '*Request Type') }}
			<span>{{ Form::select('task', array($my_task->id => $my_task->task) + $get_task, null, array('class' => 'form-control contact_task_input', 'id' => 'contact_person_task')) }}</span>
			@if ($errors->has('task')) <p class="help-block">{{ $errors->first('task') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('amount')) has-error @endif">
			{{ Form::label('amount_desc', '*Amount') }}
			{{ Form::text('amount', $get_taskforcompany->amount,array('class' => 'form-control', 'placeholder' => '0.00', 'id' => 'amount_input')) }}
			@if ($errors->has('amount')) <p class="help-block">{{ $errors->first('amount') }}</p> @endif
		</div>

		<div class="form-group">
			<div class="row">
			  <div class="col-lg-6">
				{{ Form::label('date_start_desc', '*Date Start', array('class' => 'control-label')) }}<br/>
				<span>{{ Form::text('date_start', date("m-d-Y", strtotime($get_taskforcompany->date_start)), array('class' => 'form-control date_input', 'id' => 'daterange_start', 'data-date-format' => 'mm/dd/yyyy', 'placeholder' => 'mm/dd/yyyy')) }}</span>
				@if ($errors->has('date_start')) <p class="help-block">{{ $errors->first('date_start') }}</p> @endif
			  </div>
			  
			  <div class="col-lg-6">	
			    {{ Form::label('date_end_desc', '*Date End', array('class' => 'control-label')) }}<br/>
			    <span>{{ Form::text('date_end', date("m-d-Y", strtotime($get_taskforcompany->date_end)), array('class' => 'form-control date_input', 'id' => 'daterange_end', 'data-date-format' => 'mm/dd/yyyy', 'placeholder' => 'mm/dd/yyyy')) }}</span>
			    @if ($errors->has('date_end')) <p class="help-block">{{ $errors->first('date_end') }}</p> @endif
			  </div>
			</div>  	
		</div>

		<div class="form-group @if ($errors->has('remarks')) has-error @endif">
			{{ Form::label('remarks_desc', '*Remarks') }}
			{{ Form::textarea('remarks', strtoupper($get_taskforcompany->remarks), array('size' => '65x4', 'id' => 'remarks_input')) }}
			@if ($errors->has('remarks')) <p class="help-block">{{ $errors->first('remarks') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::label('filesimg_desc', 'File/Image Attachment', array('class' => 'control-label')) }}
			<span>{{ Form::file('image[]', array('id' => 'photo_files', 'class' => 'photo_files', 'accept' => 'pdf|gif|jpg|png|xls|xlsx|doc|docx|jpeg|bmp', 'multiple'=>true)) }}</span>
			@if ($errors->has('image')) <p class="help-block">{{ $errors->first('image') }}</p> @endif
		</div>

		@if(count($getattached) > 0)
		<span style="font-size: 11px; color: red; font-weight: bold;">NOTE : Check the image or file name that you want to delete.</span><br/>
		@endif
		@if(count($getattached)>0)
		<div class="form-group">
				{{ Form::label('photo_files_desc', 'Attached files & images', array('class' => 'control-label')) }}<br/>
				@foreach($getattached as $rows)
					{{ Form::checkbox('delete_image[]', $rows->file_img) }} <span style="font-size: 12px;">{{ $rows->file_img }}</span><br/>
				@endforeach
		</div>
		@endif
		<hr/>

		<div class="form-group">
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
			{{ HTML::linkRoute('create.mytask.company', 'Back', array(), array('class' => 'btn btn-default')) }}
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