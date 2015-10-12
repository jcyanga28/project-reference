@extends('layout.backendnoloading')

@section('content')

<div class="row">

	<div class="col-lg-12">
	{{ Form::open(array('route' => 'contact.store', 'class' => 'bs-component', 'id' => 'contact_form')) }}
		
		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					{{ Form::label('profession_desc', 'Profession', array('class' => 'control-label')) }}
					<br/>
					{{ Form::select('profession', array('0' => 'SELECT PROFESSION HERE') + $position, null, array('class' => 'form-control des_position_input', 'id' => 'profession')) }}
					@if ($errors->has('profession')) <p class="help-block">{{ $errors->first('profession') }}</p> @endif			
				</div>
				<!--  -->
			</div>

		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					{{ Form::label('fullname_desc', 'Fullname', array('class' => 'control-label')) }} <b style="font-size: 11px;">(Lastname, Firstname Middlename.)</b>
					<br/>
					{{ Form::text('fullname','',array('class' => 'typeahead-devs form-control', 'placeholder' => 'Enter Fullname here')) }}
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
			 		<input type="radio" name="gender" value="Male" {{ Helper::oldRadio('gender', 'Male', true) }}> Male &nbsp;&nbsp;&nbsp;
					</label>
					<label class="radio-inline">	
			 		<input type="radio" name="gender" value="Female" {{ Helper::oldRadio('gender', 'Female') }}> Female &nbsp;&nbsp;&nbsp;
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
								array('0' => 'SELECT CATEGORY HERE') + [
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
					{{ Form::select('company', array('0' => 'SELECT COMPANY HERE') + $companies, null, array('class' => 'form-control company_input', 'id' => 'company_name')) }}
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
					{{ Form::select('position', array('0' => 'SELECT POSITION HERE') + $position, null, array('class' => 'form-control des_position_input2', 'id' => 'designated_position')) }}
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
						{{ Form::text('street','',array('class' => 'form-control address_input', 'placeholder' => 'Street here', 'id' => 'street')) }}
						{{ Form::hidden('street_hid','',array('class' => 'form-control address_input', 'placeholder' => 'Street here', 'id' => 'street_hid')) }}
						@if ($errors->has('street')) <p class="help-block">{{ $errors->first('street') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('city_desc', 'City', array('class' => 'control-label')) }}
						{{ Form::text('city','',array('class' => 'form-control address_input', 'placeholder' => 'City here', 'id' => 'city')) }}
						{{ Form::hidden('city_hid','',array('class' => 'form-control address_input', 'placeholder' => 'City here', 'id' => 'city_hid')) }}
						@if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('province_desc', 'Province', array('class' => 'control-label')) }}
						{{ Form::text('province','',array('class' => 'form-control address_input', 'placeholder' => 'Province here', 'id' => 'province')) }}
						{{ Form::hidden('province_hid','',array('class' => 'form-control address_input', 'placeholder' => 'Province here', 'id' => 'province_hid')) }}
						@if ($errors->has('province')) <p class="help-block">{{ $errors->first('province') }}</p> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('country_desc', 'Country', array('class' => 'control-label')) }}
						{{ Form::text('country','',array('class' => 'form-control address_input', 'placeholder' => 'Country here', 'id' => 'country')) }}
						{{ Form::hidden('country_hid','',array('class' => 'form-control address_input', 'placeholder' => 'Country here', 'id' => 'country_hid')) }}
						@if ($errors->has('country')) <p class="help-block">{{ $errors->first('country') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('zipcode_desc', 'Zip code', array('class' => 'control-label')) }}
						{{ Form::text('zip_code','',array('class' => 'form-control address_input', 'placeholder' => 'Zip code here', 'id' => 'zip_code')) }}
						{{ Form::hidden('zip_code_hid','',array('class' => 'form-control address_input', 'placeholder' => 'Zip code here', 'id' => 'zip_code_hid')) }}
						@if ($errors->has('zip_code')) <p class="help-block">{{ $errors->first('zip_code') }}</p> @endif
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
						{{ Form::text('i_street','',array('class' => 'form-control address_input', 'placeholder' => 'Street here', 'id' => 'i_street')) }}
						@if ($errors->has('i_street')) <p class="help-block">{{ $errors->first('i_street') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('city_desc', 'City', array('class' => 'control-label')) }}
						{{ Form::text('i_city','',array('class' => 'form-control address_input', 'placeholder' => 'City here', 'id' => 'i_city')) }}
						@if ($errors->has('i_city')) <p class="help-block">{{ $errors->first('i_city') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('province_desc', 'Province', array('class' => 'control-label')) }}
						{{ Form::text('i_province','',array('class' => 'form-control address_input', 'placeholder' => 'Province here', 'id' => 'i_province')) }}
						@if ($errors->has('province')) <p class="help-block">{{ $errors->first('province') }}</p> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('country_desc', 'Country', array('class' => 'control-label')) }}
						{{ Form::text('i_country','',array('class' => 'form-control address_input', 'placeholder' => 'Country here', 'id' => 'i_country')) }}
						@if ($errors->has('i_country')) <p class="help-block">{{ $errors->first('i_country') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('zip_code_desc', 'Zip Code', array('class' => 'control-label')) }}
						{{ Form::text('i_zip_code','',array('class' => 'form-control address_input', 'placeholder' => 'Zip code here', 'id' => 'i_zip_code')) }}
						@if ($errors->has('i_zip_code')) <p class="help-block">{{ $errors->first('i_zip_code') }}</p> @endif
					</div>
				</div>
			</div>	
			
		</div>

		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					{{ Form::label('contact_num_desc', 'Contact Number(Phone or Mobile number)', array('class' => 'control-label')) }}
					{{ Form::text('contact_number','',array('class' => 'form-control contacts_input', 'placeholder' => 'Contact Number here')) }}
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
					{{ Form::text('2nd_contact_number','',array('class' => 'form-control contacts_input', 'placeholder' => 'Contact Number here')) }}
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
					{{ Form::text('3rd_contact_number','',array('class' => 'form-control contacts_input', 'placeholder' => 'Contact Number here')) }}
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

	$('#for_company').hide();
	$('#for_individual').hide();

	$('#2nd_contact').hide();
	$('#3rd_contact').hide();

	$('input.typeahead-devs').typeahead({
	  name: 'fullname',
	  remote: 'lists/%QUERY',
	  // local : ['Sunday', 'Monday', 'Tuesday','Wednesday','Thursday','Friday','Saturday'],
	});
})
</script>

<script type="text/javascript">
	$(document).ready(function() {
	var domain ="http://"+document.domain;
			
	$("#profession").chosen({allow_single_deselect: true});
	$("#category").chosen({allow_single_deselect: true});

	$('#category').each(function(){
		$(this).change(function(){

			if($(this).val() == "0")
			{
				$('#for_company').hide(1000);
				$('#for_individual').hide(1000);
				
				$('#contact_form').find('select[name=position]').val('0');
				$('#contact_form').find('select[name=company]').val('0');
				$('#contact_form').find('input:text[name=street]').val('');
				$('#contact_form').find('input:text[name=city]').val('');
				$('#contact_form').find('input:text[name=country]').val('');
				$('#contact_form').find('input:text[name=province]').val('');
				$('#contact_form').find('input:text[name=zip_code]').val('');

				$('#contact_form').find('input:hidden[name=street_hid]').val('');
				$('#contact_form').find('input:hidden[name=city_hid]').val('');
				$('#contact_form').find('input:hidden[name=country_hid]').val('');
				$('#contact_form').find('input:hidden[name=province_hid]').val('');
				$('#contact_form').find('input:hidden[name=zip_code_hid]').val('');

				$('#contact_form').find('input:text[name=i_street]').val('');
				$('#contact_form').find('input:text[name=i_city]').val('');
				$('#contact_form').find('input:text[name=i_province]').val('');
				$('#contact_form').find('input:text[name=i_country]').val('');
				$('#contact_form').find('input:text[name=i_zip_code]').val('');

			}else if($(this).val() == "1"){
				$('#for_individual').hide(1000);
				$('#for_company').show(1000);

				$('#contact_form').find('input:text[name=i_street]').val('');
				$('#contact_form').find('input:text[name=i_city]').val('');
				$('#contact_form').find('input:text[name=i_province]').val('');
				$('#contact_form').find('input:text[name=i_country]').val('');
				$('#contact_form').find('input:text[name=i_zip_code]').val('');

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

							$('#contact_form').find('input:text[name=street]').val(content.street);
							$('#contact_form').find('input:text[name=city]').val(content.city.toUpperCase());
							if(content.province == 0)
							{
								$('#contact_form').find('input:text[name=province]').val('N/A');
							}else{
								$('#contact_form').find('input:text[name=province]').val(content.province.toUpperCase());
							}

							$('#contact_form').find('input:text[name=country]').val(content.country);
							$('#contact_form').find('input:text[name=zip_code]').val(content.zip_code);

							$('#contact_form').find('input:hidden[name=street_hid]').val(content.street);
							$('#contact_form').find('input:hidden[name=city_hid]').val(content.city.toUpperCase());
							$('#contact_form').find('input:hidden[name=province_hid]').val(content.province.toUpperCase());
							$('#contact_form').find('input:hidden[name=country_hid]').val(content.country);
							$('#contact_form').find('input:hidden[name=zip_code_hid]').val(content.zip_code);		

						}
						});

						return false;

					}else if($(this).val() == 0){
						$('#street').prop('disabled', true);
						$('#city').prop('disabled', true);
						$('#province').prop('disabled', true);
						$('#country').prop('disabled', true);
						$('#zip_code').prop('disabled', true);

						$('#contact_form').find('input:text[name=street]').val('');
						$('#contact_form').find('input:text[name=city]').val('');
						$('#contact_form').find('input:text[name=province]').val('');
						$('#contact_form').find('input:text[name=country]').val('');
						$('#contact_form').find('input:text[name=zip_code]').val('');

						$('#contact_form').find('input:hidden[name=street_hid]').val('');
						$('#contact_form').find('input:hidden[name=city_hid]').val('');
						$('#contact_form').find('input:hidden[name=province_hid]').val('');
						$('#contact_form').find('input:hidden[name=country_hid]').val('');
						$('#contact_form').find('input:hidden[name=zip_code_hid]').val('');

					}
					
				});
			});

			}else if($(this).val() == "2"){
				$('#for_company').hide(1000);
				$('#for_individual').show(1000);

				$('#contact_form').find('select[name=position]').val('0');
				$('#contact_form').find('select[name=company]').val('0');
				
				$('#contact_form').find('input:text[name=street]').val('');
				$('#contact_form').find('input:text[name=city]').val('');
				$('#contact_form').find('input:text[name=province]').val('');
				$('#contact_form').find('input:text[name=country]').val('');
				$('#contact_form').find('input:text[name=zip_code]').val('');

				$('#contact_form').find('input:text[name=street_hid]').val('');
				$('#contact_form').find('input:text[name=city_hid]').val('');
				$('#contact_form').find('input:text[name=province_hid]').val('');
				$('#contact_form').find('input:text[name=country_hid]').val('');
				$('#contact_form').find('input:text[name=zip_code_hid]').val('');

			}

		});
	});

	$('.2nd_contact').each(function(){
		$(this).click(function(){

			$('#2nd_contact').show(1000);

			$('#2nd_contact').find('input:text[name=2nd_contact_number]').val('');

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
			$('#3rd_contact').find('input:text[name=3rd_contact_number]').val('');

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