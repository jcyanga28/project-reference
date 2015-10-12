@extends('layout.backend')

@section('content')

	<table id="detail_tbl_design" class="table table-hover">
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
	</table> 

<table>
	<tr>
		<td>
			<a href="javascript:history.back()"><button type="button" id="button_design" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </button></a>
		</td>
		<td>&nbsp;</td>
	@if($company->status < 3)	
		<td class="action">
			<a href="../<?php echo $company->id; ?>/edit"><button id="btn_design" class="btn btn-info btn-xs">Update</button></a>
		</td>
	@endif
		<td>&nbsp;</td>
	@if($company->status < 2)
		<td class="action">
			{{ Form::open(array('method' => 'DELETE', 'route' => array('company.destroy', $company->id))) }}                       
			{{ Form::submit('Delete', array('id' => 'btn_design', 'class'=> 'btn btn-danger btn-xs','onclick' => "if(!confirm('Are you sure to delete this record?')){return false;};")) }}
			{{ Form::close() }}
		</td>
	@endif	
	</tr>
</table>

@stop