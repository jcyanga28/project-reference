@extends('layout.backendnoloading')

@section('content')
<div class="row">

	<div class="col-lg-6">
	{{ Form::open(array('method' => 'get','class' => 'bs-component')) }}
		@if(isset($_GET['date_from']))
			<?php $from = $_GET['date_from']; ?>
		@else
			<?php $from = ''; ?>
		@endif

		@if(isset($_GET['date_to']))
			<?php $to = $_GET['date_to']; ?>
		@else
			<?php $to = ''; ?>
		@endif		
		<table>
			<tr>
				<td>FROM &nbsp;</td>
				<td>
					<span>{{ Form::text('date_from', $from, array('class' => 'form-control r_date_input_f', 'id' => 'daterange_start', 'data-date-format' => 'mm/dd/yyyy', 'placeholder' => 'mm/dd/yyyy')) }}</span>
					@if ($errors->has('date_from')) <p class="help-block">{{ $errors->first('date_from') }}</p> @endif
				</td>
				<td>&nbsp;&nbsp;&nbsp;</td>
				<td>TO &nbsp;</td>
				<td>
					<span>{{ Form::text('date_to', $to, array('class' => 'form-control r_date_input_t', 'id' => 'daterange_end', 'data-date-format' => 'mm/dd/yyyy', 'placeholder' => 'mm/dd/yyyy')) }}</span>
					@if ($errors->has('date_to')) <p class="help-block">{{ $errors->first('date_to') }}</p> @endif
				</td>
			</tr>
		</table>
		<br/>
		
		<div class="form-group @if ($errors->has('applicator')) has-error @endif">
			@if(isset($applicator))
				<?php
					$apps = $applicator->fullname;
					$apps_id = $applicator->id;
				?>
			@else
				<?php
					$apps = 'CHOOSE SUB-APPLICATOR HERE';
					$apps_id = '0';
				?>
			@endif
			{{ Form::label('applicator_desc', 'APPLICATOR') }}<br/>
			{{ Form::select('applicator', array($apps_id => $apps) + $app, null, array('class' => 'form-control applicator_report', 'id' => 'applicators')) }}
			@if ($errors->has('applicator')) <p class="help-block">{{ $errors->first('applicator') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('agree_value')) has-error @endif">
			<input type="checkbox" name="agree" value="0"   @if(Input::get('agree_value') == "1") checked='checked' @endif class="search_all"> <em style="color:red; font-size: 12px; font-style: italic;">SELECT ALL</em>
			<input type="hidden" name="agree_value" @if(isset($_GET['agree_value'])) value="{{ Input::get('agree_value') }}" @endif id="agree_value" />
			@if ($errors->has('agree_value')) <p class="help-block">{{ $errors->first('agree_value') }}</p> @endif
		</div>

		<div class="form-group">
			{{ Form::submit('GENERATE', array('class' => 'btn btn-danger', 'id' => 'btn-print')) }}
			{{ HTML::linkRoute('dashboard.index', 'BACK', array(), array('class' => 'btn btn-default', 'id' => 'btn-print')) }}
		</div>
	{{ Form::close() }}
	</div>
</div>
<br/>

<div class="row">

	<div class="col-lg-12">
	
	@if(isset($project_via_sub_applicator))
		@if(count($project_via_sub_applicator)>0)
		{{ Form::open(array('route' => 'generate.projectsviasubapplicators.report', 'method' => 'POST','class' => 'bs-component')) }}
				<input type="hidden" name="hid_agree_val" @if(isset($_GET['agree_value'])) value="{{ Input::get('agree_value') }}" @endif id="agree_value" />
				<input type="hidden" name="hid_app" @if(isset($_GET['applicator'])) value="{{ Input::get('applicator') }}" @endif id="applicator" />
				<input type="hidden" name="hid_from" @if(isset($_GET['date_from'])) value="{{ Input::get('date_from') }}" @endif id="date_from" />
				<input type="hidden" name="hid_to" @if(isset($_GET['date_to'])) value="{{ Input::get('date_to') }}" @endif id="date_to" />
			<div style="float: right;">	
			{{ Form::submit('EXPORT TO EXCEL', array('class' => 'btn btn-success', 'id' => 'btn-print')) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
		{{ Form::close() }}
		<br/><br/>
		@endif
	@endif

	<table id="tbl_form_design" class="table table-striped">
		<thead>
			<tr>
				<td><b>SUB-APPLICATOR NAME</b></td>
				<td><b>PROJECT NAME</b></td>
				<td><b>PREPARED BDO</b></td>
			</tr>
		</thead>

		<tbody>
			@if(isset($project_via_sub_applicator))
				@if(count($project_via_sub_applicator) > 0)
					@foreach($project_via_sub_applicator as $row)	
					<tr style="background-color: #F9F9F9;">
						<td>{{ strtoupper($row->fullname) }}</td>
						<td>{{ strtoupper($row->project_name) }}</td>
						<td>{{ strtoupper($row->bdo_name) }}</td>
					</tr>
					@endforeach
				@else
					<tr>
						<td><b>NO RECORD FOUND.</b></td>
						<td></td>
						<td></td>	
						<td></td>
					</tr>
				@endif
			@else
				<tr>
					<td><b>NO RECORD FOUND.</b></td>
					<td></td>
					<td></td>	
					<td></td>
				</tr>	
			@endif	
		</tbody>
	</table>
	
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
	var domain ="http://"+document.domain;
		
		var agree = $('#agree_value').val();	

		if(agree == 1)
		{
			$("#applicators").prop('disabled', true);
			$("#daterange_start").prop('disabled', true);
			$("#daterange_end").prop('disabled', true);
			$("#daterange_start").val('');
			$("#daterange_end").val('');
			// location.reload();
		}

		$("#applicators").chosen({allow_single_deselect: true});

		$('.search_all').each(function(){
		$(this).change(function(){

			if($('.search_all').is(':checked')) 
			{
				$("#applicators").prop('disabled', true);
				location.reload();
				$('#agree_value').val('1');

			}else{
				
				$("#applicators").prop('disabled', false);
				location.reload();
				$('#agree_value').val('0');
			}

		});	
		});

	});
</script>

@stop