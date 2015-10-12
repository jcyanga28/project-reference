@extends('layout.backend')

@section('content')



<div class="row">

	<div class="col-lg-12">
	{{ Form::open(array('route' => array('company.update', $companies->id), 'method' => 'put', 'class' => 'bs-component', 'id' => 'update_company_form')) }}

		<table>

			<tr>
				<td>{{ Form::label('Company Name', 'Company Name', array('class' => 'control-label')) }}&nbsp;</td>
				<td>
					{{ Form::text('company_name', strtoupper($companies->company_name), array('class' => 'typeahead-devs', 'id' => 'forms_style_company', 'placeholder' => ' Enter Company here.')) }}
					@if ($errors->has('company_name')) <p class="help-block">{{ $errors->first('company_name') }}</p> @endif
				</td>	
			</tr>
				<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Client Type', 'Client Type', array('class' => 'control-label')) }}</td>
				<td>
					{{ Form::select('client_type', array($mytype->id => $mytype->client_type) + $type, null, array('id' => 'forms_style')) }}
					@if ($errors->has('client_type')) <p class="help-block">{{ $errors->first('client_type') }}</p> @endif
				</td>	
			</tr>


			<tr><td><br/></td><td><br/></td></tr>
			<tr><td><b>Company Address</b><br/></td><td><br/></td></tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('street', 'Street', array('class' => 'control-label')) }}</td>
				<td>
					{{ Form::text('street', strtoupper($companies->street), array('id' => 'forms_style', 'placeholder' => ' Enter Street/Company Place here.')) }}
					@if ($errors->has('street')) <p class="help-block">{{ $errors->first('street') }}</p> @endif
				</td>	
			</tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('City', 'City', array('class' => 'control-label')) }}</td>
				<td>
					{{ Form::select('city', array($mycity->id => $mycity->city) + $cities, null, array('id' => 'forms_style')) }}
					@if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
				</td>	
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Province', 'Province', array('class' => 'control-label')) }}&nbsp;</td>
				@if($companies->province_id == 0)
					<td>{{ Form::select('province', array($myprovince->id => $myprovince->province) + $provinces, null, array('id' => 'forms_style')) }}</td>	
				@else
					<td>{{ Form::select('province', array($myprovince->id => $myprovince->province) + $provinces, null, array('id' => 'forms_style')) }}</td>	
				@endif
			</tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Region', 'Region', array('class' => 'control-label')) }}</td>
				<td>
					{{ Form::text('region', strtoupper($companies->region), array('id' => 'forms_style', 'placeholder' => ' Enter Company Region here.')) }}
					@if ($errors->has('region')) <p class="help-block">{{ $errors->first('region') }}</p> @endif
				</td>	
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Country', 'Country', array('class' => 'control-label')) }}&nbsp;</td>
				<td>
					{{ Form::text('country', strtoupper($companies->country), array('id' => 'forms_style', 'placeholder' => ' Enter Company Country here.')) }}
					@if ($errors->has('country')) <p class="help-block">{{ $errors->first('country') }}</p> @endif
				</td>	
			</tr>

			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Zip Code', 'Zip Code', array('class' => 'control-label')) }}</td>
				<td>
					{{ Form::text('zip_code', strtoupper($companies->zip_code), array('id' => 'forms_style', 'placeholder' => ' Enter Company Zip Code here.')) }}
					@if ($errors->has('zip_code')) <p class="help-block">{{ $errors->first('zip_code') }}</p> @endif
				</td>	
			</tr>
			<tr><td><br/></td><td><br/></td></tr>

			<tr>
				<td>{{ Form::button('ADD ADDRESS', array('class' => 'new_address_btn 2nd_address')) }}</td>
			</tr>

		</table>

			<div id="2nd_address">

		<table>

			<tr><td><br/></td><td><br/></td></tr>
			<tr><td><b>2nd Company Address</b><br/></td><td><br/></td></tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('street', 'Street', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('2nd_street', strtoupper($companies->street2), array('id' => 'forms_style', 'placeholder' => ' Enter Street/Company Place here.', 'class' => 'street2')) }}</td>	
			</tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('City', 'City', array('class' => 'control-label')) }}</td>
				<td>{{ Form::select('2nd_city', array($mycity2->id => $mycity2->city) + $cities2, null, array('id' => 'forms_style')) }}</td>	
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Province', 'Province', array('class' => 'control-label')) }}&nbsp;</td>
				<td>{{ Form::select('2nd_province', array($myprovince2->id => $myprovince2->province) + $provinces2, null, array('id' => 'forms_style')) }}</td>	
			</tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Region', 'Region', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('2nd_region', strtoupper($companies->region2), array('id' => 'forms_style', 'placeholder' => ' Enter Company Region here.')) }}</td>	
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Country', 'Country', array('class' => 'control-label')) }}&nbsp;</td>
				<td>{{ Form::text('2nd_country', strtoupper($companies->country2), array('id' => 'forms_style', 'placeholder' => ' Enter Company Country here.')) }}</td>	
			</tr>

			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Zip Code', 'Zip Code', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('2nd_zip_code', strtoupper($companies->zip_code2), array('id' => 'forms_style', 'placeholder' => ' Enter Company Zip Code here.')) }}</td>	
			</tr>
			<tr><td><br/></td><td><br/></td></tr>

			<tr>
				<td>
					{{ Form::button('ADD ADDRESS', array('class' => 'new_address_btn 3rd_address')) }}
					{{ Form::button('CANCEL', array('class' => 'cancel_address_btn cancel_2nd_address',)) }}
				</td>
			</tr>

		</table>

			</div>

			<div id="3rd_address">

		<table>

			<tr><td><br/></td><td><br/></td></tr>
			<tr><td><b>3rd Company Address</b><br/></td><td><br/></td></tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('street', 'Street', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('3rd_street', strtoupper($companies->street3), array('id' => 'forms_style', 'placeholder' => ' Enter Street/Company Place here.', 'class' => 'street3')) }}</td>	
			</tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('City', 'City', array('class' => 'control-label')) }}</td>
				<td>{{ Form::select('3rd_city', array($mycity3->id => $mycity3->city) + $cities3, null, array('id' => 'forms_style')) }}</td>	
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Province', 'Province', array('class' => 'control-label')) }}&nbsp;</td>
				<td>{{ Form::select('3rd_province', array($myprovince3->id => $myprovince3->province) + $provinces3, null, array('id' => 'forms_style')) }}</td>	
			</tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Region', 'Region', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('3rd_region', strtoupper($companies->region3), array('id' => 'forms_style', 'placeholder' => ' Enter Company Region here.')) }}</td>	
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Country', 'Country', array('class' => 'control-label')) }}&nbsp;</td>
				<td>{{ Form::text('3rd_country', strtoupper($companies->country3), array('id' => 'forms_style', 'placeholder' => ' Enter Company Country here.')) }}</td>	
			</tr>

			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Zip Code', 'Zip Code', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('3rd_zip_code', strtoupper($companies->zip_code3), array('id' => 'forms_style', 'placeholder' => ' Enter Company Zip Code here.')) }}</td>	
			</tr>
			<tr><td><br/></td><td><br/></td></tr>

			<tr>
				<td>
					{{ Form::button('CANCEL', array('class' => 'cancel_address_btn cancel_3rd_address',)) }}
				</td>
			</tr>

		</table>

			</div>

		<table>

			<tr><td><br/></td><td><br/></td></tr>
			<tr><td><b>Company Contact Information</b><br/></td><td><br/></td></tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Telephone Num', 'Telephone Number', array('class' => 'control-label')) }}</td>
				<td>
					{{ Form::text('telephone_number', strtoupper($companies->telephone_number), array('id' => 'forms_style', 'placeholder' => ' Enter Company Telephone number here.')) }}
					@if ($errors->has('telephone_number')) <p class="help-block">{{ $errors->first('telephone_number') }}</p> @endif
				</td>		
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Fax Num', 'Fax Number', array('class' => 'control-label')) }}&nbsp;</td>
				<td>
					{{ Form::text('fax_number', strtoupper($companies->fax_number), array('id' => 'forms_style', 'placeholder' => ' Enter Company Fax number here.')) }}
					@if ($errors->has('fax_number')) <p class="help-block">{{ $errors->first('fax_number') }}</p> @endif
				</td>
			</tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Mobile Num', 'Mobile Number', array('class' => 'control-label')) }}</td>
				<td>
					{{ Form::text('mobile_number', strtoupper($companies->mobile_number), array('id' => 'forms_style', 'placeholder' => ' Enter Company Mobile number here.')) }}
					@if ($errors->has('mobile_number')) <p class="help-block">{{ $errors->first('mobile_number') }}</p> @endif
				</td>	
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Email', 'E-mail', array('class' => 'control-label')) }}</td>
				<td>
					{{ Form::text('email', strtoupper($companies->email), array('id' => 'forms_style', 'placeholder' => ' Enter Company email here.')) }}
					@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
				</td>	
			</tr>
			<tr><td><br/></td><td><br/></td></tr>

			<tr>
				<td>
					{{ Form::button('NEW CONTACT', array('class' => 'new_contact_btn 2nd_contact')) }}
				</td>
			</tr>

		</table>

			<div id="2nd_contact">

		<table>

			<tr><td><br/></td><td><br/></td></tr>
			<tr><td><b>2nd Company Contact Information</b><br/></td><td><br/></td></tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Telephone Num', 'Telephone Number', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('2nd_telephone_number', strtoupper($companies->telephone_number2), array('id' => 'forms_style', 'placeholder' => ' Enter Company Telephone number here.', 'class' => 'telephone2')) }}</td>		
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Fax Num', 'Fax Number', array('class' => 'control-label')) }}&nbsp;</td>
				<td>{{ Form::text('2nd_fax_number', strtoupper($companies->fax_number2), array('id' => 'forms_style', 'placeholder' => ' Enter Company Fax number here.', 'class' => 'fax2')) }}</td>
			</tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Mobile Num', 'Mobile Number', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('2nd_mobile_number', strtoupper($companies->mobile_number2), array('id' => 'forms_style', 'placeholder' => ' Enter Company Mobile number here.', 'class' => 'mobile2')) }}</td>	
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Email', 'E-mail', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('2nd_email', strtoupper($companies->email2), array('id' => 'forms_style', 'placeholder' => ' Enter Company email here.', 'class' => 'email2')) }}</td>	
			</tr>
			<tr><td><br/></td><td><br/></td></tr>

			<tr>
				<td>
					{{ Form::button('NEW CONTACT', array('class' => 'new_contact_btn 3rd_contact')) }}
					{{ Form::button('CANCEL', array('class' => 'cancel_contact_btn cancel_2nd_contact',)) }}
				</td>

			</tr>

		</table>

			</div>

			<div id="3rd_contact">

		<table>

			<tr><td><br/></td><td><br/></td></tr>
			<tr><td><b>3rd Company Contact Information</b><br/></td><td><br/></td></tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Telephone Num', 'Telephone Number', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('3rd_telephone_number', strtoupper($companies->telephone_number3), array('id' => 'forms_style', 'placeholder' => ' Enter Company Telephone number here.', 'class' => 'telephone3')) }}</td>		
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Fax Num', 'Fax Number', array('class' => 'control-label')) }}&nbsp;</td>
				<td>{{ Form::text('3rd_fax_number', strtoupper($companies->fax_number3), array('id' => 'forms_style', 'placeholder' => ' Enter Company Fax number here.', 'class' => 'fax3')) }}</td>
			</tr>
			<tr><td><br/></td><td><br/></td></tr>
			<tr>
				<td>{{ Form::label('Mobile Num', 'Mobile Number', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('3rd_mobile_number', strtoupper($companies->mobile_number3), array('id' => 'forms_style', 'placeholder' => ' Enter Company Mobile number here.', 'class' => 'mobile3')) }}</td>	
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
			<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
				<td>{{ Form::label('Email', 'E-mail', array('class' => 'control-label')) }}</td>
				<td>{{ Form::text('3rd_email', strtoupper($companies->email3), array('id' => 'forms_style', 'placeholder' => ' Enter Company email here.', 'class' => 'email3')) }}</td>	
			</tr>
			<tr><td><br/></td><td><br/></td></tr>

			<tr>
				<td>
					{{ Form::button('CANCEL', array('class' => 'cancel_contact_btn cancel_3rd_contact',)) }}
				</td>

			</tr>

		</table>
		
			</div>	
			<br/>

		<div class="form-group">
			<a href="javascript:history.back()"><button type="button" id="button_design" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </button></a>
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
		</div>

	{{ Form::close() }}
	</div>
</div>

<!-- css -->
<style>

	.typeahead-devs, .tt-hint {
	    font-size: 12px;
	    height: 45px;
	    line-height: 30px;
	    outline: medium none;
	    padding: 8px 12px;
	    width: 400px;
	}

	.tt-dropdown-menu {
	  width: 400px;
	  margin-top: 5px;
	  padding: 8px 12px;
	  border: 3px solid #666;
	  border-radius: 8px 8px 8px 8px;
	  box-shadow: 3px 3px 2px #888888;
	  font-size: 16px;
	  color: #333;
	  background-color: #fff;
	}

</style>

<!-- script -->
<script>
$(document).ready(function() {
	
	var domain ="http://"+document.domain;

	if($('.street2').val() == "")
	{
		$('#2nd_address').hide();
	}else{
		$('2nd_address').show();
	
	}
	
	if($('.street3').val() == "")
	{
		$('#3rd_address').hide();
	}else{
		$('#3rd_address').show();
	
	}
	
	if($('.telephone2').val() == "" && $('.fax2').val() == "" && $('.mobile2').val() == "" && $('.email2').val() == "")
	{
		$('#2nd_contact').hide();
	}else{
		$('#2nd_contact').show();
	}

	if($('.telephone3').val() == "" && $('.fax3').val() == "" && $('.mobile3').val() == "" && $('.email3').val() == "")
	{
		$('#3rd_contact').hide();
	}else{
		$('#3rd_contact').show();
	}

	$('input.typeahead-devs').typeahead({
	  name: 'company_name',
	  remote: 'Information/%QUERY',
	  // local : ['Sunday', 'Monday', 'Tuesday','Wednesday','Thursday','Friday','Saturday'],
	});

	$('.2nd_address').each(function(){
		$(this).click(function(){

			$('#2nd_address').show(1000);

			// $('#2nd_address').find('input:text[name=2nd_street]').val('');
			// $('#2nd_address').find('select[name=2nd_city]').val('0');
			// $('#2nd_address').find('select[name=2nd_province]').val('0');
			// $('#2nd_address').find('input:text[name=2nd_region]').val('');
			// $('#2nd_address').find('input:text[name=2nd_country]').val('');
			// $('#2nd_address').find('input:text[name=2nd_zip_code]').val('');

		});
	});

	$('.cancel_2nd_address').each(function(){
		$(this).click(function(){

			$('#3rd_address').hide(1000);

			// $('#3rd_address').find('input:text[name=3rd_street]').val('');
			// $('#3rd_address').find('select[name=3rd_city]').val('0');
			// $('#3rd_address').find('select[name=3rd_province]').val('0');
			// $('#3rd_address').find('input:text[name=3rd_region]').val('');
			// $('#3rd_address').find('input:text[name=3rd_country]').val('');
			// $('#3rd_address').find('input:text[name=3rd_zip_code]').val('');

			$('#2nd_address').hide(1000);

			// $('#2nd_address').find('input:text[name=2nd_street]').val('');
			// $('#2nd_address').find('select[name=2nd_city]').val('0');
			// $('#2nd_address').find('select[name=2nd_province]').val('0');
			// $('#2nd_address').find('input:text[name=2nd_region]').val('');
			// $('#2nd_address').find('input:text[name=2nd_country]').val('');
			// $('#2nd_address').find('input:text[name=2nd_zip_code]').val('');

		});
	});

	$('.3rd_address').each(function(){
		$(this).click(function(){

			$('#3rd_address').show(1000);

			// $('#3rd_address').find('input:text[name=3rd_street]').val('');
			// $('#3rd_address').find('select[name=3rd_city]').val('0');
			// $('#3rd_address').find('select[name=3rd_province]').val('0');
			// $('#3rd_address').find('input:text[name=3rd_region]').val('');
			// $('#3rd_address').find('input:text[name=3rd_country]').val('');
			// $('#3rd_address').find('input:text[name=3rd_zip_code]').val('');

		});
	});

	$('.cancel_3rd_address').each(function(){
		$(this).click(function(){

			$('#3rd_address').hide(1000);

			$('#3rd_address').find('input:text[name=3rd_street]').val('');
			$('#3rd_address').find('select[name=3rd_city]').val('0');
			$('#3rd_address').find('select[name=3rd_province]').val('0');
			$('#3rd_address').find('input:text[name=3rd_region]').val('');
			$('#3rd_address').find('input:text[name=3rd_country]').val('');
			$('#3rd_address').find('input:text[name=3rd_zip_code]').val('');

		});
	});

	$('.2nd_contact').each(function(){
		$(this).click(function(){

			$('#2nd_contact').show(1000);

			// $('#2nd_contact').find('input:text[name=2nd_telephone_number]').val('');
			// $('#2nd_contact').find('input:text[name=2nd_mobile_number]').val('');
			// $('#2nd_contact').find('input:text[name=2nd_fax_number]').val('');
			// $('#2nd_contact').find('input:text[name=2nd_email]').val('');

		});
	});

	$('.cancel_2nd_contact').each(function(){
		$(this).click(function(){

			$('#3rd_contact').hide(1000);

			$('#3rd_contact').find('input:text[name=3rd_telephone_number]').val('');
			$('#3rd_contact').find('input:text[name=3rd_mobile_number]').val('');
			$('#3rd_contact').find('input:text[name=3rd_fax_number]').val('');
			$('#3rd_contact').find('input:text[name=3rd_email]').val('');

			$('#2nd_contact').hide(1000);

			$('#2nd_contact').find('input:text[name=2nd_telephone_number]').val('');
			$('#2nd_contact').find('input:text[name=2nd_mobile_number]').val('');
			$('#2nd_contact').find('input:text[name=2nd_fax_number]').val('');
			$('#2nd_contact').find('input:text[name=2nd_email]').val('');

		});
	});

	$('.3rd_contact').each(function(){
		$(this).click(function(){

			$('#3rd_contact').show(1000);

			// $('#3rd_contact').find('input:text[name=3rd_telephone_number]').val('');
			// $('#3rd_contact').find('input:text[name=3rd_mobile_number]').val('');
			// $('#3rd_contact').find('input:text[name=3rd_fax_number]').val('');
			// $('#3rd_contact').find('input:text[name=3rd_email]').val('');

		});
	});

	$('.cancel_3rd_contact').each(function(){
		$(this).click(function(){

			$('#3rd_contact').hide(1000);

			$('#3rd_contact').find('input:text[name=3rd_telephone_number]').val('');
			$('#3rd_contact').find('input:text[name=3rd_mobile_number]').val('');
			$('#3rd_contact').find('input:text[name=3rd_fax_number]').val('');
			$('#3rd_contact').find('input:text[name=3rd_email]').val('');

		});
	});
})
</script>

@stop