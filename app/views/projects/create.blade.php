@extends('layout.backendnoloading')

@section('content')

<div id="project_form_container">
<br/><br/>

<div class="row">

	<div class="col-lg-12">
	{{ Form::open(array('route' => 'project.store', 'class' => 'bs-component', 'id' => 'project_form', 'files' => true)) }}
		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('project_no', 'Project Number', array('class' => 'control-label')) }}
						<span id="project_template_inhead_pn">{{ str_pad($project_id,10,'0',STR_PAD_LEFT) }}</span>
						{{ Form::hidden('project_number', str_pad($project_id,10,'0',STR_PAD_LEFT)) }}
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('date_reported', 'Date Reported', array('class' => 'control-label')) }}
						<span>{{ Form::text('date_reported', '', array('class' => 'datereported_input', 'id' => 'date_reported', 'data-date-format' => 'mm/dd/yyyy', 'placeholder' => 'mm/dd/yyyy')) }}</span>
						{{ Form::hidden('date_reported', date('Y-m-d')) }}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('project_photo_desc', 'Project Photos', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::select('project_photos', 
										array('' => 'SELECT HERE',
											'1' => '- FROM RIDER',
											'2' => '- FROM BDO'), null, array('class' => 'form-control bdo_input', 'id' => 'project_photos')) }}</span>
						@if ($errors->has('project_photos')) <p class="help-block">{{ $errors->first('project_photos') }}</p> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('bdo_desc', 'ASSIGN BDO', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::select('bdo', array('' => 'SELECT BDO') + $bdo, null, array('class' => 'form-control bdo_input', 'id' => 'bdo_name')) }}</span>
						@if ($errors->has('bdo')) <p class="help-block">{{ $errors->first('bdo') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('area_region_desc', 'Area/ Region', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::select('area_region', array('' => ''), null, array('class' => 'form-control ar_input', 'id' => 'area_region')) }}</span>
						@if ($errors->has('area_region')) <p class="help-block">{{ $errors->first('area_region') }}</p> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('project_name_desc', 'Project Name', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('project_name', '', array('class' => 'form-control typeahead-devs proj_input', 'id' => 'project_name', 'placeholder' => 'Write Project Name here')) }}</span>
						@if ($errors->has('project_name')) <p class="help-block">{{ $errors->first('project_name') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('project_owner_desc', 'Project Owner', array('class' => 'control-label')) }}
						<span>{{ Form::text('project_owner', '', array('class' => 'form-control proj_owner_input', 'id' => 'project_owner', 'placeholder' => 'Write Project Owner here')) }}</span>
						@if ($errors->has('project_owner')) <p class="help-block">{{ $errors->first('project_owner') }}</p> @endif
					</div>
				</div>
			</div>
		</div>	
		<hr/>

		<div class="form-group">
			{{ Form::label('address_desc', 'project Address', array('class' => 'control-label')) }}
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('street_desc', 'Street', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('street', null, array('class' => 'form-control project_address', 'id' => 'street', 'placeholder' => 'Write Street here.')) }}</span>
						@if ($errors->has('street')) <p class="help-block">{{ $errors->first('street') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						{{ Form::label('city_desc', 'City', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::select('city', array('' => 'SELECT CITY HERE') + $cities, null, array('class' => 'form-control project_address', 'id' => 'city')) }}</span>
						@if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('province_desc', 'Province', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::select('province', array('' => 'SELECT PROVINCE HERE') + $provinces, null, array('class' => 'form-control project_address', 'id' => 'province')) }}</span>
						@if ($errors->has('province')) <p class="help-block">{{ $errors->first('province') }}</p> @endif
					</div>
				</div>
			</div>	
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('country_desc', 'Country', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('country', null, array('class' => 'form-control project_address', 'id' => 'country', 'placeholder' => 'Write Country here.')) }}</span>
						@if ($errors->has('country')) <p class="help-block">{{ $errors->first('country') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-3">
					<div class="form-group">
						{{ Form::label('zip_code_desc', 'Zip Code', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('zip_code', null, array('class' => 'form-control project_address', 'id' => 'zip_code', 'placeholder' => 'Write Zip code here.')) }}</span>
						@if ($errors->has('zip_code')) <p class="help-block">{{ $errors->first('zip_code') }}</p> @endif
					</div>
				</div>
			</div>	
		</div>
		<hr/>

		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('developer_desc', 'Developer', array('class' => 'control-label')) }} <span id="in_style">(In-Company)</span><br/>
						<span>{{ Form::select('developer[]', $developer, null, array('class' => 'form-control selbox_input', 'id' => 'developer', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('developer')) <p class="help-block">{{ $errors->first('developer') }}</p> @endif
						<!-- <div id="createdby_developer">
							<span class="prepared_bdo" id="prepared_ofdeveloper"></span>
							{{ Form::hidden('created_to_developer', '', array('id' => 'created_to_developer')) }}
							{{ Form::hidden('created_to_developer_name', '', array('id' => 'created_to_developer_name')) }}
						</div> -->
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('general_contractor_desc', 'General Contractor', array('class' => 'control-label')) }} <span id="in_style">(In-Company)</span><br/>
						<span>{{ Form::select('general_contractor[]', $gencon, null, array('class' => 'form-control selbox_input', 'id' => 'general_contractor', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('general_contractor')) <p class="help-block">{{ $errors->first('general_contractor') }}</p> @endif
						<!-- <div id="createdby_gencon">
							<span class="prepared_bdo" id="prepared_ofgencon"></span>
							{{ Form::hidden('created_to_gencon', '', array('id' => 'created_to_gencon')) }}
							{{ Form::hidden('created_to_gencon_name', '', array('id' => 'created_to_gencon_name')) }}
						</div> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('sub_developer_desc', 'Developer', array('class' => 'control-label')) }} <span id="in_style">(Individual)</span><br/>
						<span>{{ Form::select('sub_developer[]', $sub_developer, null, array('class' => 'form-control selbox_input', 'id' => 'sub_developer', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('sub_developer')) <p class="help-block">{{ $errors->first('sub_developer') }}</p> @endif
						<!-- <div id="createdby_developer">
							<span class="prepared_bdo" id="prepared_ofdeveloper"></span>
							{{ Form::hidden('created_to_developer', '', array('id' => 'created_to_developer')) }}
							{{ Form::hidden('created_to_developer_name', '', array('id' => 'created_to_developer_name')) }}
						</div> -->
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('sub_general_contractor_desc', 'General Contractor', array('class' => 'control-label')) }} <span id="in_style">(Individual)</span><br/>
						<span>{{ Form::select('sub_general_contractor[]', $sub_gencon, null, array('class' => 'form-control selbox_input', 'id' => 'sub_general_contractor', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('sub_general_contractor')) <p class="help-block">{{ $errors->first('sub_general_contractor') }}</p> @endif
						<!-- <div id="createdby_gencon">
							<span class="prepared_bdo" id="prepared_ofgencon"></span>
							{{ Form::hidden('created_to_gencon', '', array('id' => 'created_to_gencon')) }}
							{{ Form::hidden('created_to_gencon_name', '', array('id' => 'created_to_gencon_name')) }}
						</div> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('project_mgr_designer_desc', 'Project Mgr/ Designer', array('class' => 'control-label')) }} <span id="in_style">(In-Company)</span><br/>
						<span>{{ Form::select('project_mgr_designer[]', $proj_mngrdesigner, null, array('class' => 'form-control selbox_input', 'id' => 'project_mgr_designer', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('project_mgr_designer')) <p class="help-block">{{ $errors->first('project_mgr_designer') }}</p> @endif
						<!-- <div id="createdby_projmgrdesigner">
							<span class="prepared_bdo" id="prepared_ofprojmgrdesigner"></span>
							{{ Form::hidden('created_to_projmgrdesigner', '', array('id' => 'created_to_projmgrdesigner')) }}
							{{ Form::hidden('created_to_projmgrdesigner_name', '', array('id' => 'created_to_projmgrdesigner_name')) }}
						</div> -->
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('architect_desc', 'Architect', array('class' => 'control-label')) }} <span id="in_style">(In-Company)</span><br/>
						<span>{{ Form::select('architect[]', $architect, null, array('class' => 'form-control selbox_input', 'id' => 'architect', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('architect')) <p class="help-block">{{ $errors->first('architect') }}</p> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('sub_project_mgr_designer_desc', 'Project Mgr/ Designer', array('class' => 'control-label')) }} <span id="in_style">(Individual)</span><br/>
						<span>{{ Form::select('sub_project_mgr_designer[]', $sub_proj_mngrdesigner, null, array('class' => 'form-control selbox_input', 'id' => 'sub_project_mgr_designer', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('sub_project_mgr_designer')) <p class="help-block">{{ $errors->first('sub_project_mgr_designer') }}</p> @endif
						<!-- <div id="createdby_projmgrdesigner">
							<span class="prepared_bdo" id="prepared_ofprojmgrdesigner"></span>
							{{ Form::hidden('created_to_projmgrdesigner', '', array('id' => 'created_to_projmgrdesigner')) }}
							{{ Form::hidden('created_to_projmgrdesigner_name', '', array('id' => 'created_to_projmgrdesigner_name')) }}
						</div> -->
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('sub_architect_desc', 'Architect', array('class' => 'control-label')) }} <span id="in_style">(Individual)</span><br/>
						<span>{{ Form::select('sub_architect[]', $sub_architect, null, array('class' => 'form-control selbox_input', 'id' => 'sub_architect', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('sub_architect')) <p class="help-block">{{ $errors->first('sub_architect') }}</p> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('applicator_desc', 'Applicator', array('class' => 'control-label')) }} <span id="in_style">(In-Company & Individual)</span><br/>
						<span>{{ Form::select('applicator[]', $applicator, null, array('class' => 'form-control selbox_input', 'id' => 'applicator', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('applicator')) <p class="help-block">{{ $errors->first('applicator') }}</p> @endif
						<!-- <div id="createdby_applicator">
							<span class="prepared_bdo" id="prepared_ofapplicator"></span>
							{{ Form::hidden('created_to_applicator', '', array('id' => 'created_to_applicator')) }}
							{{ Form::hidden('created_to_applicator_name', '', array('id' => 'created_to_applicator_name')) }}
						</div> -->
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('dealer_supplier_desc', 'DEALER/ SUPPLIER', array('class' => 'control-label')) }} <span id="in_style">(In-Company & Individual)</span><br/>
						<span>{{ Form::select('dealer_supplier[]', $dealersupplier, null, array('class' => 'form-control selbox_input', 'id' => 'dealer_supplier', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('dealer_supplier')) <p class="help-block">{{ $errors->first('dealer_supplier') }}</p> @endif
						<!-- <div id="createdby_dealersupplier">
							<span class="prepared_bdo" id="prepared_ofdealersupplier"></span>
							{{ Form::hidden('created_to_dealersupplier', '', array('id' => 'created_to_dealersupplier')) }}
							{{ Form::hidden('created_to_dealersupplier_name', '', array('id' => 'created_to_dealersupplier_name')) }}
						</div> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('sub_applicator_desc', 'Sub - Applicator', array('class' => 'control-label')) }} <span id="in_style">(In-Company & Individual)</span><br/>
						<span>{{ Form::select('sub_applicator[]', $sub_applicator, null, array('class' => 'form-control selbox_input', 'id' => 'sub_applicator', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('sub_applicator')) <p class="help-block">{{ $errors->first('sub_applicator') }}</p> @endif
						<!-- <div id="createdby_applicator">
							<span class="prepared_bdo" id="prepared_ofapplicator"></span>
							{{ Form::hidden('created_to_applicator', '', array('id' => 'created_to_applicator')) }}
							{{ Form::hidden('created_to_applicator_name', '', array('id' => 'created_to_applicator_name')) }}
						</div> -->
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('sub_dealer_supplier_desc', 'Sub - DEALER/ SUPPLIER', array('class' => 'control-label')) }} <span id="in_style">(In-Company & Individual)</span><br/>
						<span>{{ Form::select('sub_dealer_supplier[]', $sub_dealersupplier, null, array('class' => 'form-control selbox_input', 'id' => 'sub_dealer_supplier', 'multiple' => 'multiple')) }}</span>
						@if ($errors->has('sub_dealer_supplier')) <p class="help-block">{{ $errors->first('sub_dealer_supplier') }}</p> @endif
						<!-- <div id="createdby_dealersupplier">
							<span class="prepared_bdo" id="prepared_ofdealersupplier"></span>
							{{ Form::hidden('created_to_dealersupplier', '', array('id' => 'created_to_dealersupplier')) }}
							{{ Form::hidden('created_to_dealersupplier_name', '', array('id' => 'created_to_dealersupplier_name')) }}
						</div> -->
					</div>
				</div>
			</div>
		</div>	
		<hr/>

		<div class="form-group">
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('project_classification_desc', 'Project Classification', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::select('project_classification', array('' => 'SELECT PROJECT CLASSIFICATION') + $classification, null, array('class' => 'form-control selbox_input2', 'id' => 'project_classification')) }}</span>
						@if ($errors->has('project_classification')) <p class="help-block">{{ $errors->first('project_classification') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('project_category_desc', 'Project Category', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::select('project_category', array('' => 'SELECT PROJECT CATEGORY') + $category, null, array('class' => 'form-control selbox_input1', 'id' => 'project_category')) }}</span>
						@if ($errors->has('project_category')) <p class="help-block">{{ $errors->first('project_category') }}</p> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('project_stage_desc', 'Project Stage', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::select('project_stage', array('' => 'SELECT PROJECT STAGE') + $stage, null, array('class' => 'form-control selbox_input2', 'id' => 'project_stage')) }}</span>
						@if ($errors->has('project_stage')) <p class="help-block">{{ $errors->first('project_stage') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-6">
					<div class="form-group">
						{{ Form::label('project_status_desc', 'Project Status', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::select('project_status', array('' => 'SELECT PROJECT STATUS') + $status, null, array('class' => 'form-control selbox_input2', 'id' => 'project_status')) }}</span>
						@if ($errors->has('project_status')) <p class="help-block">{{ $errors->first('project_status') }}</p> @endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					{{ Form::label('project_details_desc', 'Project Details', array('class' => 'control-label')) }}<br/>
					{{ Form::textarea('project_details', 'Write Details here.', array('size' => '100x4', 'id' => 'txtarea_input')) }}
					@if ($errors->has('project_details')) <p class="help-block">{{ $errors->first('project_details') }}</p> @endif
				</div>
			</div>
		</div>		
		<hr/>

		<div class="form-group">
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						{{ Form::label('painting_date_desc', 'Painting Date-Start', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('painting_dtstart', '', array('class' => 'form-control date_input', 'id' => 'daterange_start', 'data-date-format' => 'mm/dd/yyyy', 'placeholder' => 'mm/dd/yyyy')) }}</span>
						@if ($errors->has('painting_dtstart')) <p class="help-block">{{ $errors->first('painting_dtstart') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						{{ Form::label('painting_date_desc', 'Painting Date-End', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('painting_dtend', '', array('class' => 'form-control date_input', 'id' => 'daterange_end', 'data-date-format' => 'mm/dd/yyyy', 'placeholder' => 'mm/dd/yyyy')) }}</span>
						@if ($errors->has('painting_dtend')) <p class="help-block">{{ $errors->first('painting_dtend') }}</p> @endif
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="form-group">
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<span>{{ Form::checkbox('painting_specification1', 'Exterior') }} {{ Form::label('painting_spec_exterior', 'Not Factor', array('class' => 'control-label')) }}</span>&nbsp;
						&nbsp;<span>{{ Form::checkbox('painting_specification1', 'Exterior') }} {{ Form::label('painting_spec_exterior', 'Factor', array('class' => 'control-label')) }}</span>
					</div>
				</div>
			</div>
		</div> -->

		<div class="form-group">
			{{ Form::label('painting_specification_desc', 'Painting Specification (Coating System)', array('class' => 'control-label')) }}<br/>
			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<span>{{ Form::checkbox('painting_specification1', 'Exterior') }} {{ Form::label('painting_spec_exterior', 'Exterior', array('class' => 'control-label')) }}</span>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						{{ Form::label('paints_desc', 'Paint/ s', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('paint', null, array('class' => 'form-control paints_input', 'id' => 'paints', 'placeholder' => 'Write Paint/ s here.')) }}</span>
						@if ($errors->has('paint')) <p class="help-block">{{ $errors->first('paint') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('area_sqm_desc', 'Area(SqM.)', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('area_sqm', null, array('class' => 'form-control painting_input', 'id' => 'area_sqm', 'placeholder' => 'Write Area here.')) }}</span>
						@if ($errors->has('area_sqm')) <p class="help-block">{{ $errors->first('area_sqm') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('painting_req_desc', 'Painting Requirements(Ltrs.)', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('painting_req', null, array('class' => 'form-control painting_input', 'id' => 'painting_req', 'placeholder' => 'Write Painting requirements here.')) }}</span>
						@if ($errors->has('painting_req')) <p class="help-block">{{ $errors->first('painting_req') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('paiting_cost', 'Painting Cost(Php)', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('painting_cost', null, array('class' => 'form-control painting_input', 'id' => 'painting_cost', 'placeholder' => 'Write Painting cost here.')) }}</span>
						@if ($errors->has('painting_cost')) <p class="help-block">{{ $errors->first('painting_cost') }}</p> @endif
					</div>
				</div>
			</div>
			<hr/>

			<div class="row">	
				<div class="col-lg-12">
					<div class="form-group">
						<span>{{ Form::checkbox('painting_specification2', 'Interior') }} {{ Form::label('painting_spec_interior', 'Interior', array('class' => 'control-label')) }}</span>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						{{ Form::label('paints_desc', 'Paint/ s', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('2nd_paint', null, array('class' => 'form-control paints_input', 'id' => '2nd_paints', 'placeholder' => 'Write Paint/ s here.')) }}</span>
						@if ($errors->has('2nd_paint')) <p class="help-block">{{ $errors->first('2nd_paint') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('area_sqm_desc', 'Area(SqM.)', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('2nd_area_sqm', null, array('class' => 'form-control painting_input', 'id' => '2nd_area_sqm', 'placeholder' => 'Write Area here.')) }}</span>
						@if ($errors->has('2nd_area_sqm')) <p class="help-block">{{ $errors->first('2nd_area_sqm') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('painting_req_desc', 'Painting Requirements(Ltrs.)', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('2nd_painting_req', null, array('class' => 'form-control painting_input', 'id' => '2nd_painting_req', 'placeholder' => 'Write Painting requirements here.')) }}</span>
						@if ($errors->has('2nd_painting_req')) <p class="help-block">{{ $errors->first('2nd_painting_req') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('paiting_cost', 'Painting Cost(Php)', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('2nd_painting_cost', null, array('class' => 'form-control painting_input', 'id' => '2nd_painting_cost', 'placeholder' => 'Write Painting cost here.')) }}</span>
						@if ($errors->has('2nd_painting_cost')) <p class="help-block">{{ $errors->first('2nd_painting_cost') }}</p> @endif
					</div>
				</div>
			</div>
			<hr/>

			<div class="row">
				<div class="col-lg-12">
					<div class="form-group">
						<span>{{ Form::checkbox('painting_specification3', 'Others') }} {{ Form::label('painting_spec_others', 'Others', array('class' => 'control-label')) }}</span>	
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						{{ Form::label('paints_desc', 'Paint/ s', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('3rd_paint', null, array('class' => 'form-control paints_input', 'id' => '3rd_paints', 'placeholder' => 'Write Paint/ s here.')) }}</span>
						@if ($errors->has('3rd_paint')) <p class="help-block">{{ $errors->first('3rd_paint') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('area_sqm_desc', 'Area(SqM.)', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('3rd_area_sqm', null, array('class' => 'form-control painting_input', 'id' => '3rd_area_sqm', 'placeholder' => 'Write Area here.')) }}</span>
						@if ($errors->has('3rd_area_sqm')) <p class="help-block">{{ $errors->first('3rd_area_sqm') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('painting_req_desc', 'Painting Requirements(Ltrs.)', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('3rd_painting_req', null, array('class' => 'form-control painting_input', 'id' => '3rd_painting_req', 'placeholder' => 'Write Painting requirements here.')) }}</span>
						@if ($errors->has('3rd_painting_req')) <p class="help-block">{{ $errors->first('3rd_painting_req') }}</p> @endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group">
						{{ Form::label('paiting_cost', 'Painting Cost(Php)', array('class' => 'control-label')) }}<br/>
						<span>{{ Form::text('3rd_painting_cost', null, array('class' => 'form-control painting_input', 'id' => '3rd_painting_cost', 'placeholder' => 'Write Painting cost here.')) }}</span>
						@if ($errors->has('3rd_painting_cost')) <p class="help-block">{{ $errors->first('3rd_painting_cost') }}</p> @endif
					</div>
				</div>
			</div>
			<hr/>
				
			<div class="row">	
				<div class="col-lg-12">
					<div class="form-group">
						{{ Form::label('photo_files_desc', 'Project Attachment', array('class' => 'control-label')) }} <span style="color:#F00; font-size: 10px;">(Allowed file types pdf|gif|jpg|png|txt|xls|xlsx|doc|docx|jpeg|bmp|csv.)</span><br/>
						<span>{{ Form::radio('photo_files_type', '1') }} {{ Form::label('before_painting', 'Before Painting', array('class' => 'control-label')) }}</span>
						<span style="margin-left: 10px;">{{ Form::radio('photo_files_type', '2') }} {{ Form::label('during_painting', 'During Painting', array('class' => 'control-label')) }}</span>
						<span style="margin-left: 10px;">{{ Form::radio('photo_files_type', '3') }} {{ Form::label('after_painting', 'After Painting', array('class' => 'control-label')) }}</span>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="form-group">
						<span>{{ Form::file('image[]', array('id' => 'photo_files', 'class' => 'photo_files', 'accept' => 'pdf|gif|jpg|png|xls|xlsx|doc|docx|jpeg|bmp', 'multiple'=>true)) }}</span>
						@if ($errors->has('image')) <p class="help-block">{{ $errors->first('image') }}</p> @endif
					</div>
				</div>
			</div>
		</div>
		<hr/>

	<div class="form-group">
		<a href="javascript:history.back()"><button type="button" id="button_design" class="btn btn-default"><i class="fa fa-arrow-left"></i> Back </button></a>
		{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
	</div>
	{{ Form::close() }}

	</div>

	</div>

</div>
<br/><br/>

<!-- css -->
<style>

	.typeahead-devs, .tt-hint {
	    font-size: 13px;
	    color: #666;
	    height: 40px;
	    line-height: 30px;
	    outline: medium none;
	    padding: 8px 12px;
	    width: 325px;
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

	$('input.typeahead-devs').typeahead({
	  name: 'project_name',
	  remote: 'lists/%QUERY',
	  // local : ['Sunday', 'Monday', 'Tuesday','Wednesday','Thursday','Friday','Saturday'],
	});
})
</script>

<script type="text/javascript">
	$(document).ready(function() {
	var domain ="http://"+document.domain;
	
	$('#createdby_developer').hide();		
	// $("#bdo_name").chosen({allow_single_deselect: true});
	$("#area_region").empty();
	$("#area_region").prop('disabled', true);
	
	// $("#developer").chosen({allow_single_deselect: true});
	// $("#general_contractor").chosen({allow_single_deselect: true});
	// $("#project_mgr_designer").chosen({allow_single_deselect: true});
	// $("#architect").chosen({allow_single_deselect: true});
	// $("#applicator").chosen({allow_single_deselect: true});
	// $("#dealer_supplier").chosen({allow_single_deselect: true});

	$('#developer').multiselect({
            maxHeight: 200
    });
    $('#sub_developer').multiselect({
            maxHeight: 200
    });
    $('#general_contractor').multiselect({
            maxHeight: 200
    });
    $('#sub_general_contractor').multiselect({
            maxHeight: 200
    });
    $('#project_mgr_designer').multiselect({
            maxHeight: 200
    });
    $('#sub_project_mgr_designer').multiselect({
            maxHeight: 200
    });
	$('#architect').multiselect({
            maxHeight: 200
    });
    $('#sub_architect').multiselect({
            maxHeight: 200
    });
	$('#applicator').multiselect({
            maxHeight: 200
    });
    $('#sub_applicator').multiselect({
            maxHeight: 200
    });
    $('#dealer_supplier').multiselect({
            maxHeight: 200
    });
    $('#sub_dealer_supplier').multiselect({
            maxHeight: 200
    });

	$("#project_classification").chosen({allow_single_deselect: true});
	$("#project_category").chosen({allow_single_deselect: true});
	$("#project_stage").chosen({allow_single_deselect: true});
	$("#project_status").chosen({allow_single_deselect: true});
	// $('#my-date-start-input').datepicker();
	// $('#my-date-end-input').datepicker();

	$('#bdo_name').each(function(){
		$(this).change(function(){

			var bdo_id = $(this).val();

			if(bdo_id == '')
			{
				$("#area_region").empty();
				$("#area_region").prop('disabled', true);
				return false;

			}else{
				
				$("#area_region").prop('disabled', false);

				// 8000/projects/getarea

				$.ajax({			
				type: "POST",
				url: domain+':8000/projects/getarea',
				data:  {bdo_id: bdo_id},
				dataType: "json",
				success: function(content) {
					
               var select = $("#area_region"), options = '';
		       select.empty();      

		       for(var i=0;i<content.length; i++)
		       {
		        options += "<option style='font-size: 12px; color: #666;' class='form-control' value='"+content[i].id+"'>"+ content[i].name +"</option>";              
		       }

		       select.append(options);

				}
				});

				return false;

			}

		});
	});

	// $('#developer').each(function(){
	// 	$(this).change(function(){

	// 		if($(this).val() == 0)
	// 		{
	// 			$('#createdby_developer').hide(1000);
				
	// 			$("#prepared_ofdeveloper").html("");	
	//            	$('#createdby_developer').find('input:hidden[name=created_to_developer]').val('');
	//            	$('#createdby_developer').find('input:hidden[name=created_to_developer_name]').val('');

	// 		}else{
	// 			$('#createdby_developer').show(1000);

	// 			$.ajax({			
	// 			type: "POST",
	// 			url: domain+':8000/projects/getdeveloper',
	// 			data:  {bdo_id: $(this).val()},
	// 			dataType: "json",
	// 			success: function(content) {
				
	// 			$("#prepared_ofdeveloper").html("<b> PREPARED BY : </b>" + content.fullname);	
	//            	$('#createdby_developer').find('input:hidden[name=created_to_developer]').val(content.id);
	//            	$('#createdby_developer').find('input:hidden[name=created_to_developer_name]').val(content.fullname);

	// 			}
	// 			});

	// 			return false;

	// 		}


	// 	});
	// });

	// $('#general_contractor').each(function(){
	// 	$(this).change(function(){

	// 		if($(this).val() == 0)
	// 		{
	// 			$('#createdby_gencon').hide(1000);
				
	// 			$("#prepared_ofgencon").html("");	
	//            	$('#createdby_gencon').find('input:hidden[name=created_to_gencon]').val('');
	//            	$('#createdby_gencon').find('input:hidden[name=created_to_gencon_name]').val('');

	// 		}else{
	// 			$('#createdby_gencon').show(1000);

	// 			$.ajax({			
	// 			type: "POST",
	// 			url: domain+':8000/projects/getgencon',
	// 			data:  {bdo_id: $(this).val()},
	// 			dataType: "json",
	// 			success: function(content) {
				
	// 			$("#prepared_ofgencon").html("<b> PREPARED BY : </b>" + content.fullname);	
	//            	$('#createdby_gencon').find('input:hidden[name=created_to_gencon]').val(content.id);
	//            	$('#createdby_gencon').find('input:hidden[name=created_to_gencon_name]').val(content.fullname);

	// 			}
	// 			});

	// 			return false;

	// 		}


	// 	});
	// });

	// $('#project_mgr_designer').each(function(){
	// 	$(this).change(function(){

	// 		if($(this).val() == 0)
	// 		{
	// 			$('#createdby_projmgrdesigner').hide(1000);
				
	// 			$("#prepared_ofprojmgrdesigner").html("");	
	//            	$('#createdby_projmgrdesigner').find('input:hidden[name=created_to_projmgrdesigner]').val('');
	//            	$('#createdby_projmgrdesigner').find('input:hidden[name=created_to_projmgrdesigner_name]').val('');

	// 		}else{
	// 			$('#createdby_projmgrdesigner').show(1000);

	// 			$.ajax({			
	// 			type: "POST",
	// 			url: domain+':8000/projects/getprojmgrdesigner',
	// 			data:  {bdo_id: $(this).val()},
	// 			dataType: "json",
	// 			success: function(content) {
				
	// 			$("#prepared_ofprojmgrdesigner").html("<b> PREPARED BY : </b>" + content.fullname);	
	//            	$('#createdby_projmgrdesigner').find('input:hidden[name=created_to_projmgrdesigner]').val(content.id);
	//            	$('#createdby_projmgrdesigner').find('input:hidden[name=created_to_projmgrdesigner_name]').val(content.fullname);

	// 			}
	// 			});

	// 			return false;

	// 		}


	// 	});
	// });

	// $('#architect').each(function(){
	// 	$(this).change(function(){

	// 		if($(this).val() == 0)
	// 		{
	// 			$('#createdby_architect').hide(1000);
				
	// 			$("#prepared_ofarchitect").html("");	
	//            	$('#createdby_architect').find('input:hidden[name=created_to_architect]').val('');
	//            	$('#createdby_architect').find('input:hidden[name=created_to_architect_name]').val('');

	// 		}else{
	// 			$('#createdby_architect').show(1000);

	// 			$.ajax({			
	// 			type: "POST",
	// 			url: domain+':8000/projects/getarchitect',
	// 			data:  {bdo_id: $(this).val()},
	// 			dataType: "json",
	// 			success: function(content) {
				
	// 			$("#prepared_ofarchitect").html("<b> PREPARED BY : </b>" + content.fullname);	
	//            	$('#createdby_architect').find('input:hidden[name=created_to_architect]').val(content.id);
	//            	$('#createdby_architect').find('input:hidden[name=created_to_architect_name]').val(content.fullname);

	// 			}
	// 			});

	// 			return false;

	// 		}


	// 	});
	// });

	// $('#applicator').each(function(){
	// 	$(this).change(function(){

	// 		if($(this).val() == 0)
	// 		{
	// 			$('#createdby_applicator').hide(1000);
				
	// 			$("#prepared_ofapplicator").html("");	
	//            	$('#createdby_applicator').find('input:hidden[name=created_to_applicator]').val('');
	//            	$('#createdby_applicator').find('input:hidden[name=created_to_applicator_name]').val('');

	// 		}else{
	// 			$('#createdby_applicator').show(1000);

	// 			$.ajax({			
	// 			type: "POST",
	// 			url: domain+':8000/projects/getapplicator',
	// 			data:  {bdo_id: $(this).val()},
	// 			dataType: "json",
	// 			success: function(content) {
				
	// 			$("#prepared_ofapplicator").html("<b> PREPARED BY : </b>" + content.fullname);	
	//            	$('#createdby_applicator').find('input:hidden[name=created_to_applicator]').val(content.id);
	//            	$('#createdby_applicator').find('input:hidden[name=created_to_applicator_name]').val(content.fullname);

	// 			}
	// 			});

	// 			return false;

	// 		}


	// 	});
	// });

	// $('#dealer_supplier').each(function(){
	// 	$(this).change(function(){

	// 		if($(this).val() == 0)
	// 		{
	// 			$('#createdby_dealersupplier').hide(1000);
				
	// 			$("#prepared_ofdealersupplier").html("");	
	//            	$('#createdby_dealersupplier').find('input:hidden[name=created_to_dealersupplier]').val('');
	//            	$('#createdby_dealersupplier').find('input:hidden[name=created_to_dealersupplier_name]').val('');

	// 		}else{
	// 			$('#createdby_dealersupplier').show(1000);

	// 			$.ajax({			
	// 			type: "POST",
	// 			url: domain+':8000/projects/getdealersupplier',
	// 			data:  {bdo_id: $(this).val()},
	// 			dataType: "json",
	// 			success: function(content) {
				
	// 			$("#prepared_ofdealersupplier").html("<b> PREPARED BY : </b>" + content.fullname);	
	//            	$('#createdby_dealersupplier').find('input:hidden[name=created_to_dealersupplier]').val(content.id);
	//            	$('#createdby_dealersupplier').find('input:hidden[name=created_to_dealersupplier_name]').val(content.fullname);

	// 			}
	// 			});

	// 			return false;

	// 		}


	// 	});
	// });

	$('#photo_files').MultiFile({ 
	  STRING: {
	   remove: '<img src="<?php echo URL::asset('asset/img/delete.png') ?>" height="16" width="15" alt="x"/>'
	  }
	 }); 

	$("#date_reported").datepicker({
		dateFormat: "mm-dd-yy",
		
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