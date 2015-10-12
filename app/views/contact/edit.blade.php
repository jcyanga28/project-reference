@extends('layout.backendnoloading')

@section('content')

<div class="row">

	<div class="col-lg-12">
	{{ Form::open(array('route' => array('contact.update', $contact->id), 'method' => 'put', 'class' => 'bs-component', 'id' => 'update_contact_form')) }}
		
		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					{{ Form::label('profession_desc', 'Profession', array('class' => 'control-label')) }}
					<br/>
					{{ Form::select('profession', array($myprofession->id => $myprofession->position) + $professions, null, array('class' => 'form-control des_position_input', 'id' => 'profession')) }}
					@if ($errors->has('profession')) <p class="help-block">{{ $errors->first('profession') }}</p> @endif
				</div>
				<!--  -->
			</div>

		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					{{ Form::label('fullname_desc', 'Fullname', array('class' => 'control-label')) }}
					<br/>
					{{ Form::text('fullname', strtoupper($contact->fullname), array('class' => 'typeahead-devs form-control', 'placeholder' => 'Enter Fullname here')) }}
					@if ($errors->has('fullname')) <p class="help-block">{{ $errors->first('fullname') }}</p> @endif
				</div>
				<!--  -->
			</div>
	
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					{{ Form::label('gender_desc', 'Gender', array('class' => 'control-label')) }}
					<br/>
					<label class="radio-inline">	
			 		<input type="radio" name="gender" value="MALE" {{ Helper::oldRadio('gender', 'MALE', $contact->gender == 'MALE' ) }} > Male &nbsp;&nbsp;&nbsp;
					</label>
					<label class="radio-inline">	
			 		<input type="radio" name="gender" value="FEMALE" {{ Helper::oldRadio('gender', 'FEMALE', $contact->gender == 'FEMALE' ) }}> Female &nbsp;&nbsp;&nbsp;
				</div>
				<!--  -->
			</div>
			
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					{{ Form::label('category_desc', 'Category', array('class' => 'control-label')) }}
					<br/>
					{{ Form::select('category', 
								array($category_id => $category) + [
									  '1' => 'IN-COMPANY',
									  '2' => 'INDIVIDUAL',
									  ], null, 
								['class' => 'form-control position_input', 'id' => 'category']) }}					
					@if ($errors->has('category')) <p class="help-block">{{ $errors->first('category') }}</p> @endif
				</div>
				<!--  -->
			</div>

		</div>
		
		<div id="for_company">

		<div class="form-group">
			<div class="row">
				<div class="col-lg-12">
					{{ Form::label('company_desc', 'Company', array('class' => 'control-label')) }}
					<br/>
					@if(count($mycompany) == 1)
						{{ Form::select('company', array($mycompany->id => $mycompany->company_name) + $companies, null, array('class' => 'form-control company_input', 'id' => 'company_name')) }}
					@else
						{{ Form::select('company', array('0' => 'SELECT COMPANY HERE') + $companies, null, array('class' => 'form-control company_input', 'id' => 'company_name')) }}
					@endif
					@if ($errors->has('company')) <p class="help-block">{{ $errors->first('company') }}</p> @endif
					
				</div>
				<!--  -->
			</div>

		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					{{ Form::label('designated_position_desc', 'Designated Position', array('class' => 'control-label')) }}
					<br/>
					@if(count($myposition) == 1)
						{{ Form::select('position', array($myposition->id => $myposition->position) + $positions, null, array('class' => 'form-control des_position_input2', 'id' => 'designated_position')) }}
					@else
						{{ Form::select('position', array('0' => 'SELECT POSITION HERE') + $positions, null, array('class' => 'form-control des_position_input2', 'id' => 'designated_position')) }}
					@endif
					@if ($errors->has('position')) <p class="help-block">{{ $errors->first('position') }}</p> @endif
				</div>
				<!--  -->
			</div>

		</div>
		<div class="form-group">
			{{ Form::label('contact_address', 'Company Address', array('class' => 'control-label')) }}
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('street_desc', 'Street', array('class' => 'control-label')) }}
						{{ Form::text('street', strtoupper($contact->street), array('class' => 'form-control address_input', 'placeholder' => 'Street here', 'id' => 'street')) }}
						{{ Form::hidden('street_hid', strtoupper($contact->street), array('class' => 'form-control address_input', 'placeholder' => 'Street here', 'id' => 'street_hid')) }}
						@if ($errors->has('street')) <p class="help-block">{{ $errors->first('street') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('city_desc', 'City', array('class' => 'control-label')) }}
						{{ Form::text('city', strtoupper($contact->city), array('class' => 'form-control address_input', 'placeholder' => 'City here', 'id' => 'city')) }}
						{{ Form::hidden('city_hid', strtoupper($contact->city), array('class' => 'form-control address_input', 'placeholder' => 'City here', 'id' => 'city_hid')) }}
						@if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('province_desc', 'Province', array('class' => 'control-label')) }}
						@if($contact->province == 0)
							<?php $my_province = 'N/A'; ?>
						@else
							<?php $my_province = $contact->province; ?>
						@endif	
						{{ Form::text('province', strtoupper($my_province),array('class' => 'form-control address_input', 'placeholder' => 'Province here', 'id' => 'province')) }}
						{{ Form::hidden('province_hid', strtoupper($contact->province),array('class' => 'form-control address_input', 'placeholder' => 'Province here', 'id' => 'province_hid')) }}
						@if ($errors->has('province')) <p class="help-block">{{ $errors->first('province') }}</p> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('country_desc', 'Country', array('class' => 'control-label')) }}
						{{ Form::text('country', strtoupper($contact->country), array('class' => 'form-control address_input', 'placeholder' => 'Country here', 'id' => 'country')) }}
						{{ Form::hidden('country_hid', strtoupper($contact->country), array('class' => 'form-control address_input', 'placeholder' => 'Country here', 'id' => 'country_hid')) }}
						@if ($errors->has('country')) <p class="help-block">{{ $errors->first('country') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('zipcode_desc', 'Zip code', array('class' => 'control-label')) }}
						{{ Form::text('zip_code', strtoupper($contact->zip_code),array('class' => 'form-control address_input', 'placeholder' => 'Zip code here', 'id' => 'zip_code')) }}
						{{ Form::hidden('zip_code_hid', strtoupper($contact->zip_code),array('class' => 'form-control address_input', 'placeholder' => 'Zip code here', 'id' => 'zip_code_hid')) }}
						@if ($errors->has('zip_code')) <p class="help-block">{{ $errors->first('zip_code') }}</p> @endif
					</div>
				</div>
			</div>
			<br/>

			<div id="personal_address_1">
			{{ Form::label('contact_address', 'Personal Address', array('class' => 'control-label')) }}
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('street_desc', 'Street', array('class' => 'control-label')) }}
						{{ Form::text('street_2', strtoupper($contact->street_2), array('class' => 'form-control address_input', 'placeholder' => 'Street here', 'id' => 'street_2')) }}
						@if ($errors->has('street_2')) <p class="help-block">{{ $errors->first('street_2') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('city_desc', 'City', array('class' => 'control-label')) }}
						{{ Form::text('city_2', strtoupper($contact->city_2), array('class' => 'form-control address_input', 'placeholder' => 'City here', 'id' => 'city_2')) }}
						@if ($errors->has('city_2')) <p class="help-block">{{ $errors->first('city_2') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('province_desc', 'Province', array('class' => 'control-label')) }}
						{{ Form::text('province_2', strtoupper($contact->province_2),array('class' => 'form-control address_input', 'placeholder' => 'Province here', 'id' => 'province_2')) }}
						@if ($errors->has('province_2')) <p class="help-block">{{ $errors->first('province_2') }}</p> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('country_desc', 'Country', array('class' => 'control-label')) }}
						{{ Form::text('country_2', strtoupper($contact->country_2), array('class' => 'form-control address_input', 'placeholder' => 'Country here', 'id' => 'country_2')) }}
						@if ($errors->has('country_2')) <p class="help-block">{{ $errors->first('country_2') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('zipcode_desc', 'Zip code', array('class' => 'control-label')) }}
						{{ Form::text('zip_code_2', strtoupper($contact->zip_code_2),array('class' => 'form-control address_input', 'placeholder' => 'Zip code here', 'id' => 'zip_code_2')) }}
						@if ($errors->has('zip_code_2')) <p class="help-block">{{ $errors->first('zip_code_2') }}</p> @endif
					</div>
				</div>
			</div>
		</div>

		</div>

		</div>

		<div id="for_individual">

		<div class="form-group">
			{{ Form::label('contact_address', 'Personal Address', array('class' => 'control-label')) }}
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('street_desc', 'Street', array('class' => 'control-label')) }}
						{{ Form::text('i_street', strtoupper($contact->street), array('class' => 'form-control address_input', 'placeholder' => 'Street here', 'id' => 'i_street')) }}
						@if ($errors->has('i_street')) <p class="help-block">{{ $errors->first('i_street') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('city_desc', 'City', array('class' => 'control-label')) }}
						{{ Form::text('i_city', strtoupper($contact->city), array('class' => 'form-control address_input', 'placeholder' => 'City here', 'id' => 'i_city')) }}
						@if ($errors->has('i_city')) <p class="help-block">{{ $errors->first('i_city') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('province_desc', 'Province', array('class' => 'control-label')) }}
						{{ Form::text('i_province', strtoupper($contact->province),array('class' => 'form-control address_input', 'placeholder' => 'Province here', 'id' => 'i_province')) }}
						@if ($errors->has('i_province')) <p class="help-block">{{ $errors->first('i_province') }}</p> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('country_desc', 'Country', array('class' => 'control-label')) }}
						{{ Form::text('i_country', strtoupper($contact->country), array('class' => 'form-control address_input', 'placeholder' => 'Country here', 'id' => 'i_country')) }}
						@if ($errors->has('i_country')) <p class="help-block">{{ $errors->first('i_country') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('zipcode_desc', 'Zip code', array('class' => 'control-label')) }}
						{{ Form::text('i_zip_code', strtoupper($contact->zip_code),array('class' => 'form-control address_input', 'placeholder' => 'Zip code here', 'id' => 'i_zip_code')) }}
						@if ($errors->has('i_zip_code')) <p class="help-block">{{ $errors->first('i_zip_code') }}</p> @endif
					</div>
				</div>
			</div>	
		</div>

		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					{{ Form::label('contact_num_desc', 'Contact Number(Phone or Mobile number)') }}
					{{ Form::text('contact_number', $contact->contact_number, array('class' => 'form-control contacts_input', 'placeholder' => 'Contact Number here')) }}
					@if ($errors->has('contact_number')) <p class="help-block">{{ $errors->first('contact_number') }}</p> @endif
				</div>
				<!--  -->
			</div>
		</div>

		{{ Form::button('NEW CONTACT', array('class' => 'new_contact_btn 2nd_contact')) }}

		<div id="2nd_contact" class="form-group added_contact_div">
			<div class="row">
				<div class="col-lg-6">
					{{ Form::label('contact_num_desc', 'Contact Number(Phone or Mobile number)', array('class' => 'control-label')) }}
					{{ Form::text('2nd_contact_number', $contact->contact_number2, array('class' => 'form-control contacts_input contact2', 'placeholder' => 'Contact Number here')) }}
				</div>
				<!--  -->
			</div>	
		<br/>

		{{ Form::button('NEW CONTACT', array('class' => 'new_contact_btn 3rd_contact')) }}
		{{ Form::button('CANCEL', array('class' => 'cancel_contact_btn 2nd_cancel_contact')) }}	
		</div>

		<div id="3rd_contact" class="form-group added_contact_div">
			<div class="row">
				<div class="col-lg-6">
					{{ Form::label('contact_num_desc', 'Contact Number(Phone or Mobile number)', array('class' => 'control-label')) }}
					{{ Form::text('3rd_contact_number', $contact->contact_number3, array('class' => 'form-control contacts_input contact3', 'placeholder' => 'Contact Number here')) }}
				</div>
				<!--  -->
			</div>	
		<br/>
		
		{{ Form::button('CANCEL', array('class' => 'cancel_contact_btn 3rd_cancel_contact')) }}	
		</div>

		<div style="margin-top: 20px;" class="form-group">
			<a href="javascript:history.back()"><button type="button" id="button_design" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </button></a>
			{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
		</div>

	{{ Form::close() }}
	</div>
</div>

<!-- css -->
<style>

	.typeahead-devs, .tt-hint {
	    font-size: 14px;
	    height: 40px;
	    line-height: 30px;
	    outline: medium none;
	    padding: 8px 12px;
	    width: 300px;
	}

	.tt-dropdown-menu {
	  width: 300px;
	  margin-top: 5px;
	  padding: 8px 12px;
	  border: 3px solid #666;
	  border-radius: 8px 8px 8px 8px;
	  box-shadow: 3px 3px 2px #888888;
	  font-size: 14px;
	  color: #333;
	  background-color: #fff;
	}

</style>

<!-- script -->
<script>
$(document).ready(function() {
	
	var domain ="http://"+document.domain;

	if($('#category').val() == "1")
	{	
		$('#for_company').show();
		$('#personal_address_1').show();

		if($('#street_2').val() == "")
		{
			$('#personal_address_1').hide();
		}else{
			$('#personal_address_1').show();
		}

		if($('#street_2').val() == "")
		{
			$('#for_company').find('input:text[name=street_2]').val('');
		}
		if($('#city_2').val() == "")
		{
			$('#for_company').find('input:text[name=city_2]').val('');
		}
		if($('#province_2').val() == "")
		{
			$('#for_company').find('input:text[name=province_2]').val('');
		}
		if($('#country_2').val() == "")
		{
			$('#for_company').find('input:text[name=country_2]').val('');
		}
		if($('#zip_code_2').val() == "")
		{
			$('#for_company').find('input:text[name=zip_code_2]').val('');
		}
			
		$('#for_individual').find('input:text[name=i_street]').val('');
		$('#for_individual').find('input:text[name=i_city]').val('');
		$('#for_individual').find('input:text[name=i_province]').val('');
		$('#for_individual').find('input:text[name=i_country]').val('');
		$('#for_individual').find('input:text[name=i_zip_code]').val('');

		$('#for_individual').hide();
	}else{

		$('#for_individual').show();
		
		$('#for_company').find('input:text[name=street]').val('');
		$('#for_company').find('input:text[name=city]').val('');
		$('#for_company').find('input:text[name=province]').val('');
		$('#for_company').find('input:text[name=country]').val('');
		$('#for_company').find('input:text[name=zip_code]').val('');

		// $('#for_company').find('input:text[name=street_2]').val('');
		// $('#for_company').find('input:text[name=city_2]').val('');
		// $('#for_company').find('input:text[name=province_2]').val('');
		// $('#for_company').find('input:text[name=country_2]').val('');
		// $('#for_company').find('input:text[name=zip_code_2]').val('');

		$('#for_company').find('input:text[name=street_hid]').val('');
		$('#for_company').find('input:text[name=city_hid]').val('');
		$('#for_company').find('input:text[name=province_hid]').val('');
		$('#for_company').find('input:text[name=country_hid]').val('');
		$('#for_company').find('input:text[name=zip_code_hid]').val('');

		$('#for_company').hide();
	}

	if($('.contact2').val() == "")
	{
		$('#2nd_contact').hide();
	}else{
		$('#2nd_contact').show();
	}
	
	if($('.contact3').val() == "")
	{
		$('#3rd_contact').hide();
	}else{
		$('#3rd_contact').show();
	}

	$('input.typeahead-devs').typeahead({
	  name: 'fullname',
	  remote: 'information/%QUERY',
	  // local : ['Sunday', 'Monday', 'Tuesday','Wednesday','Thursday','Friday','Saturday'],
	});
})
</script>

<script type="text/javascript">
	$(document).ready(function() {
	var domain ="http://"+document.domain;
			
	// $("#company_name").chosen({allow_single_deselect: true});
	$("#profession").chosen({allow_single_deselect: true});
	$("#category").chosen({allow_single_deselect: true});

	$('#street').prop('disabled', true);
	$('#city').prop('disabled', true);
	$('#province').prop('disabled', true);
	$('#country').prop('disabled', true);
	$('#zip_code').prop('disabled', true);

	$('#category').each(function(){
		$(this).change(function(){

			if($(this).val() == "1"){
				$('#for_individual').hide(1000);
				$('#for_company').show(1000);

				if($('#street_2').val() == "")
				{
					$('#personal_address_1').hide(1000);
				}else{
					$('#personal_address_1').show(1000);
				}

				// $('#update_contact_form').find('input:text[name=i_street]').val('');
				// $('#update_contact_form').find('input:text[name=i_city]').val('');
				// $('#update_contact_form').find('input:text[name=i_province]').val('');
				// $('#update_contact_form').find('input:text[name=i_country]').val('');
				// $('#update_contact_form').find('input:text[name=i_zip_code]').val('');


			}else if($(this).val() == "2"){
				$('#for_company').hide(1000);
				$('#for_individual').show(1000);
				$('#personal_address_1').hide(1000);

				// $('#update_contact_form').find('select[name=company]').val('0');

				// $('#update_contact_form').find('input:text[name=street]').val('');
				// $('#update_contact_form').find('input:text[name=city]').val('');
				// $('#update_contact_form').find('input:text[name=province]').val('');
				// $('#update_contact_form').find('input:text[name=country]').val('');
				// $('#update_contact_form').find('input:text[name=zip_code]').val('');

				// $('#update_contact_form').find('input:text[name=street_2]').val('');
				// $('#update_contact_form').find('input:text[name=city_2]').val('');
				// $('#update_contact_form').find('input:text[name=province_2]').val('');
				// $('#update_contact_form').find('input:text[name=country_2]').val('');
				// $('#update_contact_form').find('input:text[name=zip_code_2]').val('');

				// $('#update_contact_form').find('input:text[name=street_hid]').val('');
				// $('#update_contact_form').find('input:text[name=city_hid]').val('');
				// $('#update_contact_form').find('input:text[name=province_hid]').val('');
				// $('#update_contact_form').find('input:text[name=country_hid]').val('');
				// $('#update_contact_form').find('input:text[name=zip_code_hid]').val('');

			}

		});
	});

	$('#company_name').each(function(){
		$(this).change(function(){

			var comp_name = $(this).val();

			// :8000/contact/getcompanyinfo

			if(comp_name > 0)
			{	
				$('#street').prop('disabled', true);
				$('#city').prop('disabled', true);
				$('#province').prop('disabled', true);
				$('#country').prop('disabled', true);
				$('#zip_code').prop('disabled', true);

				$.ajax({			
				type: "POST",
				url: domain+'/contact/getcompanyinfo',
				data:  {comp_name: comp_name},
				dataType: "json",
				success: function(content) {
					
					$('#street').prop('disabled', true);
					$('#city').prop('disabled', true);
					$('#province').prop('disabled', true);
					$('#country').prop('disabled', true);
					$('#zip_code').prop('disabled', true);

					$('#update_contact_form').find('input:text[name=street]').val(content.street);
					$('#update_contact_form').find('input:text[name=city]').val(content.city.toUpperCase());
					if(content.province == 0)
					{
						$('#update_contact_form').find('input:text[name=province]').val('N/A');
					}else{
						$('#update_contact_form').find('input:text[name=province]').val(content.province.toUpperCase());
					}

					$('#update_contact_form').find('input:text[name=country]').val(content.country);
					$('#update_contact_form').find('input:text[name=zip_code]').val(content.zip_code);

					$('#update_contact_form').find('input:hidden[name=street_hid]').val(content.street);
					$('#update_contact_form').find('input:hidden[name=city_hid]').val(content.city.toUpperCase());
					$('#update_contact_form').find('input:hidden[name=province_hid]').val(content.province.toUpperCase());
					$('#update_contact_form').find('input:hidden[name=country_hid]').val(content.country);
					$('#update_contact_form').find('input:hidden[name=zip_code_hid]').val(content.zip_code);
					
				}
				});

				return false;

			}
			
		});
	});

	$('.2nd_contact').each(function(){
		$(this).click(function(){

			$('#2nd_contact').show(1000);
			// $('#2nd_contact').find('input:text[name=2nd_contact_number]').val('');

		});	
	});

	$('.2nd_cancel_contact').each(function(){
		$(this).click(function(){

			$('#3rd_contact').hide(1000);
			$('#3rd_contact').find('input:text[name=3rd_contact_number]').val('');

			$('#2nd_contact').hide(1000);
			$('#2nd_contact').find('input:text[name=2nd_contact_number]').val('');

		});	
	});

	$('.3rd_contact').each(function(){
		$(this).click(function(){

			$('#3rd_contact').show(1000);
			// $('#3rd_contact').find('input:text[name=3rd_contact_number]').val('');

		});	
	});

	$('.3rd_cancel_contact').each(function(){
		$(this).click(function(){

			$('#3rd_contact').hide(1000);
			$('#3rd_contact').find('input:text[name=3rd_contact_number]').val('');

		});	
	});


	});
</script>

@stop