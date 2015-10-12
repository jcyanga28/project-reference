@extends('layout.backend')

@section('content')

<div class="row">
    
    <div class="col-xs-12 col-sm-6 col-md-7">

	<table style="width: 100%;" id="detail_tbl_design" class="table table-hover">
		<tr>
			<td id="tbl_details_td">PROFESSION</td><td>{{ strtoupper($contact->position) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">FULLNAME</td><td>{{ strtoupper($contact->fullname) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">GENDER</td><td>{{ strtoupper($contact->gender) }}</td>
		</tr>
		@if($getcategory->category == 1)
		<tr>
			<td id="tbl_details_td">COMPANY</td><td>{{ strtoupper($contact->company_name) }}</td>
		</tr>
		@endif
		@if($getcategory->category == 1)
		<tr>
			<td id="tbl_details_td">DESIGNATED POSITION</td><td>{{ strtoupper($contact->incompany_position) }}</td>
		</tr>
		@endif
		<tr>
			<td id="tbl_details_td">
				@if($getcategory->category == 1)
					COMPANY ADDRESS
				@else
					PERSONAL ADDRESS
				@endif	
				</td><td>{{ $contact->street . ' ' . strtoupper($contact->city) . ',' . ' ' . strtoupper($contact->country) . ',' . ' ' . $contact->zip_code }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">CONTACT NUMBER</td><td>{{ $contact->contact_number }}</td>
		</tr>
		@if($contact->contact_number2)
		<tr>
			<td id="tbl_details_td">2ND CONTACT NUMBER</td>
			<td>
				@if($contact->contact_number2)
					{{ $contact->contact_number2 }}
				@else
					<b>N/A</b>
				@endif	
			</td>
		</tr>
		@endif
		@if($contact->contact_number3)
		<tr>
			<td id="tbl_details_td">3RD CONTACT NUMBER</td>
			<td>
				@if($contact->contact_number3)
					{{ $contact->contact_number3 }}
				@else
					<b>N/A</b>
				@endif	
			</td>
		</tr>
		@endif
		<tr>
			<td id="tbl_details_td">PREPARED BY</td><td>{{ strtoupper($contact->first_name) . ' ' . strtoupper($contact->last_name) }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">DATE & TIME CREATED</td>
			<td>
				<?php $datetime = explode(" ", $contact->created_at); ?>
				{{ date("m/d/Y", strtotime($datetime[0])) . ' ' . date("H:i:s", strtotime($datetime[1])) }}
			</td>
		</tr>
	</table> 

@if($contact->status == 1)	
<table>
	<tr>
		<td>
			{{ Form::label('remarks_desc', '*Remarks', array('class' => 'control-label')) }} <em style="color:#F00;font-size: 11px;">(Note : Need to write remarks if denying the contact request.)</em><br/>
			{{ Form::textarea('remarks', 'Write remarks here.', array('size' => '81x3', 'class' => 'remarks_input', 'id' => 'txtarea_input')) }}
		</td>
	</tr>
</table>
<br/>
@endif

<table>
	<tr>
		<td>
			<a href="javascript:history.back()"><button type="button" id="button_design" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </button></a>
		</td>
		<td>&nbsp;</td>
	@if($contact->status == 1)	
		<td>
			{{ Form::open(array('method' => 'PUT', 'route' => array('contact.a', $contact->id))) }}                       
				{{ Form::submit('Approve', array('id' => 'btn_design', 'class'=> 'btn btn-info btn-xs','onclick' => "if(!confirm('Are you sure to approve this record?')){return false;};")) }}
			{{ Form::close() }}
		</td>
		<td>&nbsp;</td>
		<td>
			{{ Form::open(array('method' => 'PUT', 'route' => array('contact.d', $contact->id))) }}  
				{{ Form::hidden('remarks_hid', '', array('class' => 'remarks_hid', 'id' => 'remarks_hid')) }}                    
				{{ Form::submit('Denied', array('id' => 'btn_design', 'class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to deny this record?')){return false;};")) }}
			{{ Form::close() }}
		</td>
	@endif	
	</tr>
</table>

</div>

<div class="col-xs-6 col-md-5">

 	@if($contact->status == 1)	
 	
 			<div>
 				<span id="related_title">Related Result.</span>
 			</div>
 	
 			<hr/>
 	
 			@if(count($almostsame_contact)==0)
 				<b>No Record found.</b>
 			
 			@else
 			<table style="border: 1px solid #eee; font-size: 11px;" class="table table-striped">
 				<thead>
 					<tr>
 						<td><b>FULLNAME</b></td>
 						<td><b>PREPARED BY</b></td>
 					</tr>
 				</thead>
 	
 				<tbody>
 					@foreach($almostsame_contact as $row)
 						<tr>
 							<td>{{ strtoupper($row->fullname) }}</td>
 							<td>{{ strtoupper($row->first_name) . ' ' . strtoupper($row->last_name) }}</td>
 						</tr>
 	
 					@endforeach	
 				</tbody>
 			</table>
 			@endif
 			
 		@endif

	</div>	

</div>

<script type="text/javascript">
$(document).ready(function() {	
	var domain ="http://"+document.domain;

	$('.remarks_input').each(function(){
		$(this).change(function(){

			if($(this).val() == "" || $(this).val() == "Write remarks here.")
			{
				$('.remarks_hid').val('');
			}else{
				$('.remarks_hid').val($(this).val());
			}

		});	
	});

});

</script>

@stop