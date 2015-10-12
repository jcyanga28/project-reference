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

		<div class="form-group @if ($errors->has('project_category')) has-error @endif">
			@if(isset($project_categories))
				<?php
					$cat = $project_categories->category;
					$cat_id = $project_categories->id;
				?>
			@else
				<?php
					$cat = 'CHOOSE CATEGORY HERE';
					$cat_id = '0';
				?>
			@endif

			{{ Form::label('project_category_desc', 'PROJECT CATEGORY') }}
			{{ Form::select('project_category', array($cat_id => $cat) + $categories, null, array('class' => 'form-control project_categories_report', 'id' => 'categories')) }}
			@if ($errors->has('project_category')) <p class="help-block">{{ $errors->first('project_category') }}</p> @endif
		</div>

		<div class="form-group @if ($errors->has('area_place')) has-error @endif">
			@if(isset($areas_search))
				<?php
					$area = $areas_search->area_place;
					$area_id = $areas_search->id;
				?>
			@else
				<?php
					$area = 'CHOOSE AREA HERE';
					$area_id = '0';
				?>
			@endif

			{{ Form::label('area_desc', 'AREA PLACE') }}<br/>
			{{ Form::select('area_place', array($area_id => $area) + $areas, null, array('class' => 'form-control area_report', 'id' => 'areas')) }}
			@if ($errors->has('area_place')) <p class="help-block">{{ $errors->first('area_place') }}</p> @endif
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
	
	@if(count($project_via_categories)>0)
	{{ Form::open(array('route' => 'generate.projectsviacategories.report', 'method' => 'POST','class' => 'bs-component')) }}
			<input type="hidden" name="hid_agree_val" @if(isset($_GET['agree_value'])) value="{{ Input::get('agree_value') }}" @endif id="agree_value" />
			<input type="hidden" name="hid_proj_cat" @if(isset($_GET['project_category'])) value="{{ Input::get('project_category') }}" @endif id="project_category" />
			<input type="hidden" name="hid_area" @if(isset($_GET['area_place'])) value="{{ Input::get('area_place') }}" @endif id="area_place" />
			<input type="hidden" name="hid_from" @if(isset($_GET['date_from'])) value="{{ Input::get('date_from') }}" @endif id="date_from" />
			<input type="hidden" name="hid_to" @if(isset($_GET['date_to'])) value="{{ Input::get('date_to') }}" @endif id="date_to" />
		<div style="float: right;">	
		{{ Form::submit('EXPORT TO EXCEL', array('class' => 'btn btn-success', 'id' => 'btn-print')) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
	{{ Form::close() }}
	<br/><br/>
	@endif

	<table id="tbl_form_design" class="table table-striped">
		<thead>
			<tr>
				<td><b>PROJECT NAME</b></td>
				<td><b>PROJECT OWNER</b></td>
				<td><b>PAINTING DATE</b></td>
			</tr>
		</thead>

		<tbody>
			@if(count($project_via_categories) == 0)
				<tr>
					<td colspan="4">No record found!</td>
				</tr>
			@else	
				@foreach($project_via_categories as $row)	
				<tr style="background-color: #F9F9F9;">
					<td>{{ $row->project_name }}</td>
					<td>{{ $row->project_owner }}</td>
				@if($row->painting_dtstart == "0000-00-00")
					<?php $dtstart = "00-00-0000"; ?>
				@else	
					<?php $dtstart = date("m-d-Y", strtotime($row->painting_dtstart)); ?>
				@endif	
				@if($row->painting_dtend == "0000-00-00")
					<?php $dtend = "00-00-0000"; ?>
				@else	
					<?php $dtend = date("m-d-Y", strtotime($row->painting_dtend)); ?>
				@endif	
					<td>{{ $dtstart . ' ' . 'TO' . ' ' . $dtstart }}</td>
				</tr>
				@endforeach
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
			$("#categories").prop('disabled', true);
			$("#areas").prop('disabled', true);
			$("#daterange_start").prop('disabled', true);
			$("#daterange_end").prop('disabled', true);
			$("#daterange_start").val('');
			$("#daterange_end").val('');
			// location.reload();
		}

		$("#categories").chosen({allow_single_deselect: true});
		$("#areas").chosen({allow_single_deselect: true});

		$('.search_all').each(function(){
		$(this).change(function(){

			if($('.search_all').is(':checked')) 
			{
				$("#categories").prop('disabled', true);
				$("#areas").prop('disabled', true);
				location.reload();
				$('#agree_value').val('1');

			}else{
				
				$("#categories").prop('disabled', false);
				$("#areas").prop('disabled', false);
				location.reload();
				$('#agree_value').val('0');
			}

		});	
		});

		$("#daterange_start").datepicker({
		dateFormat: "yy-mm-dd",
		onSelect: function(selected) {
		  $("#daterange_end").datepicker("option","minDate", selected)
		}
		
		});


		$("#daterange_end").datepicker({
			dateFormat: "yy-mm-dd",
			onSelect: function(selected) {
			  $("#daterange_start").datepicker("option","maxDate", selected)
			}
		});

	});
</script>

@stop