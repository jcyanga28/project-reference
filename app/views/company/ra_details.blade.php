@extends('layout.backend')

@section('content')

<div class="row">
    
    <div class="col-xs-12 col-sm-6 col-md-7">

		<table style="font-size:11px;" id="tbl_details_design" class="table table-hover">
			<tr>
				<td id="tbl_details_td">COMPANY</td><td>{{ $company->company_name }}</td>
			</tr>
			<tr>
				<td id="tbl_details_td">CLIENT TYPE</td><td>{{ $company->client_type }}</td>
			</tr>
			<tr>
			<td id="tbl_details_td">COMPANY ADDRESS</td><td>{{ strtoupper($company->street) . ' ' . strtoupper($company->city) . ',' . ' ' .  ' ' . strtoupper($company->region) . ' ' . strtoupper($company->country . '.') }}</td>
		</tr>
		@if($company->province != '' && $company->province != 0)
		<tr>
			<td id="tbl_details_td">PROVINCE</td>
			<td>
				@if($company->province != '' && $company->province != 0)
					{{ $company->province }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		@endif
		<tr>
			<td id="tbl_details_td">ZIP CODE</td>
			<td>
				@if($company->zip_code)
					{{ $company->zip_code }}
				@else
					<b>N/A</b>
				@endif	
			</td>
		</tr>
		@if($company->street2)
		<tr>
			<td id="tbl_details_td">2ND COMPANY ADDRESS</td>
			<td>
				@if($company->street2)
					{{ strtoupper($company->street2) . ' ' . strtoupper($company->city2) . ',' . ' ' .  ' ' . strtoupper($company->region2) . ' ' . strtoupper($company->country2 . '.') }}
				@else
					<b>N/A</b>
				@endif	
			</td>
		</tr>
		@endif
		@if($company->province2 != '' && $company->province2 != 0)
		<tr>
			<td id="tbl_details_td">2ND PROVINCE</td>
			<td>
				@if($company->province2 != '' && $company->province2 != 0)
					{{ $company->province2 }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		@endif
		@if($company->zip_code2)
		<tr>
			<td id="tbl_details_td">2ND ZIP CODE</td>
			<td>
				@if($company->zip_code2)
					{{ $company->zip_code2 }}
				@else
					<b>N/A</b>
				@endif	
			</td>
		</tr>
		@endif
		@if($company->street3)
		<tr>
			<td id="tbl_details_td">3RD COMPANY ADDRESS</td>
			<td>
				@if($company->street3)
					{{ strtoupper($company->street3) . ' ' . strtoupper($company->city3) . ',' . ' ' .  ' ' . strtoupper($company->region3) . ' ' . strtoupper($company->country3 . '.') }}
				@else
					<b>N/A</b>
				@endif	
			</td>
		</tr>
		@endif
		@if($company->province3 != '' && $company->province3 != 0)
		<tr>
			<td id="tbl_details_td">3RD PROVINCE</td>
			<td>
				@if($company->province3 != '' && $company->province3 != 0)
					{{ $company->province3 }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		@endif
		@if($company->zip_code3)
		<tr>
			<td id="tbl_details_td">3RD ZIP CODE</td>
			<td>
				@if($company->zip_code3)
					{{ $company->zip_code3 }}
				@else
					<b>N/A</b>
				@endif	
			</td>
		</tr>
		@endif
		<tr>
			<td id="tbl_details_td">TELEPHONE NUMBER</td>
			<td>
				@if($company->telephone_number != '')
					{{ $company->telephone_number }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		<tr>
			<td id="tbl_details_td">MOBILE NUMBER</td>
			<td>
				@if($company->mobile_number != '')
					{{ $company->mobile_number }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		<tr>
			<td id="tbl_details_td">E-MAIL ADDRESS</td>
			<td>
				@if($company->email != '')
					{{ strtoupper($company->email) }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		<tr>
			<td id="tbl_details_td">FAX NUMBER</td>
			<td>
				@if($company->fax_number != '')
					{{ strtoupper($company->fax_number) }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		@if($company->telephone_number2 != '')
		<tr>
			<td id="tbl_details_td">2ND TELEPHONE NUMBER</td>
			<td>
				@if($company->telephone_number2 != '')
					{{ $company->telephone_number2 }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		@endif
		@if($company->mobile_number2 != '')
		<tr>
			<td id="tbl_details_td">2ND MOBILE NUMBER</td>
			<td>
				@if($company->mobile_number2 != '')
					{{ $company->mobile_number2 }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		@endif
		@if($company->email2 != '')
		<tr>
			<td id="tbl_details_td">2ND E-MAIL ADDRESS</td>
			<td>
				@if($company->email2 != '')
					{{ strtoupper($company->email2) }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		@endif
		@if($company->fax_number2 != '')
		<tr>
			<td id="tbl_details_td">2ND FAX NUMBER</td>
			<td>
				@if($company->fax_number2 != '')
					{{ $company->fax_number2 }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		@endif
		@if($company->telephone_number3 != '')
		<tr>
			<td id="tbl_details_td">3RD TELEPHONE NUMBER</td>
			<td>
				@if($company->telephone_number3 != '')
					{{ $company->telephone_number3 }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		@endif
		@if($company->mobile_number3 != '')
		<tr>
			<td id="tbl_details_td">3RD MOBILE NUMBER</td>
			<td>
				@if($company->mobile_number3 != '')
					{{ $company->mobile_number3 }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		@endif
		@if($company->email3 != '')
		<tr>
			<td id="tbl_details_td">3RD E-MAIL ADDRESS</td>
			<td>
				@if($company->email3 != '')
					{{ strtoupper($company->email3) }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>
		@endif
		@if($company->fax_number3 != '')
		<tr>
			<td id="tbl_details_td">3RD FAX NUMBER</td>
			<td>
				@if($company->fax_number3 != '')
					{{ $company->fax_number3 }}
				@else
					<b>N/A</b>
				@endif		
			</td>
		</tr>	
		@endif
		<tr>
			<td id="tbl_details_td">PREPARED BY</td><td>{{ $company->first_name . ' ' . $company->last_name }}</td>
		</tr>
		<tr>
			<td id="tbl_details_td">DATE & TIME CREATED</td>
			<td>
				<?php $datetime = explode(" ", $company->created_at); ?>
				{{ date("m/d/Y", strtotime($datetime[0])) . ' ' . date("H:i:s", strtotime($datetime[1])) }}
			</td>
		</tr>	
		</table> 

		@if($company->status == 1)
		<table>
			<tr>
				<td>
					{{ Form::label('remarks_desc', '*Remarks', array('class' => 'control-label')) }} <em style="color:#F00;font-size: 11px;">(Note : Need to write remarks if denying the company request.)</em><br/>
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
			@if($company->status == 1)	
				<td>
					{{ Form::open(array('method' => 'PUT', 'route' => array('company.a', $company->id))) }}                       
						{{ Form::submit('Approve', array('id' => 'btn_design', 'class'=> 'btn btn-info btn-xs','onclick' => "if(!confirm('Are you sure to approve this record?')){return false;};")) }}
					{{ Form::close() }}
				</td>
			<td>&nbsp;</td>
				<td>
					{{ Form::open(array('method' => 'PUT', 'route' => array('company.d', $company->id))) }}  
						{{ Form::hidden('remarks_hid', '', array('class' => 'remarks_hid', 'id' => 'remarks_hid')) }}                  
						{{ Form::submit('Denied', array('id' => 'btn_design', 'class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to deny this record?')){return false;};")) }}
					{{ Form::close() }}
				</td>
			@endif	
			</tr>
		</table>
	</div>

 	<div class="col-xs-6 col-md-5">

 	@if($company->status == 1)	

		<div>
			<span id="related_title">Related Result.</span>
		</div>

		<hr/>

		@if(count($almost_samecomp)==0)
			<b>No Record found.</b>
		
		@else
		<table id="tbl_details_design" style="font-size:11px;" class="table table-striped">
			<thead>
				<tr>
					<td><b>COMPANY</b></td>
					<td><b>PREPARED BY</b></td>
				</tr>
			</thead>

			<tbody>
				@foreach($almost_samecomp as $row)
					<tr>
						<td>{{ strtoupper($row->company_name) }}</td>
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