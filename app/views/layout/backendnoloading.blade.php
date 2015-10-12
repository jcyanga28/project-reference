
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Project Reference System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="shortcut icon" href="{{ URL::asset('asset/img/favicon.ico') }}" type="image/x-icon"/>
		<link rel="icon" href="{{ URL::asset('asset/img/favicon.ico') }}" type="image/x-icon"/>
		
		<!-- css -->
		{{ HTML::style('asset/css/bootstrap/css/bootstrap.css') }}
		{{ HTML::style('asset/css/css/bootswatch.min.css') }}
		{{ HTML::style('asset/css/frontend-style.css') }}
		{{ HTML::style('asset/css/font-awesome-4.2.0/css/font-awesome.min.css') }}
		{{ HTML::style('asset/css/colorbox/css/colorbox.css') }}
		<link rel="stylesheet" href="http://openlayers.org/en/v3.0.0/css/ol.css" type="text/css">
		{{ HTML::style('asset/css/style.css') }}
		{{ HTML::style('asset/css/alert/alert.css') }}
		{{ HTML::style('asset/css/notification/notif.css') }}
		{{ HTML::style('asset/css/chosen.css') }}
		{{ HTML::style('asset/css/datepicker/datepicker.css') }}
		{{ HTML::style('asset/css/bootstrap-multiselect.css') }}

		<!-- script -->
		{{ HTML::script('asset/js/bootstrap/jquery-1.11.1.min.js') }}
		{{ HTML::script('asset/js/bootstrap/js/bootstrap.js') }}
		{{ HTML::script('asset/js/colorbox/js/jquery.colorbox-min.js') }}
		<!-- {{ HTML::script('assets/plugins/twitter-bootstrap/js/bootswatch.js') }} -->
		<script src="http://openlayers.org/en/v3.0.0/build/ol.js" type="text/javascript"></script>
		{{ HTML::script('asset/js/highlight.js') }}
		{{ HTML::script('asset/js/map.js') }}
		{{ HTML::script('asset/js/app.js') }}
		{{ HTML::script('asset/js/typeahead.js') }}
		{{ HTML::script('asset/js/typeahead.min.js') }}
		{{ HTML::script('asset/js/notification/notif.js') }}
		{{ HTML::script('asset/js/chosen.jquery.js') }}
		{{ HTML::script('asset/js/datepicker/datepicker-ui.js') }}
		<!-- {{ HTML::script('asset/js/multifile/jquery.blockUI.js') }} -->
		{{ HTML::script('asset/js/multifile/jquery.form.js') }}
		{{ HTML::script('asset/js/multifile/jquery.MetaData.js') }}
		{{ HTML::script('asset/js/multifile/jquery.MultiFile.js') }}

		{{ HTML::script('asset/js/bootstrap-multiselect.js') }}
		{{ HTML::script('asset/js/bootstrap-multiselect-collapsible-groups.js') }}

		<script type="text/javascript">
		$(document).ready(function() {
		@section('page-script')

        @show
        });
        </script>

		<style type="text/css">
		body {
			  padding-top: 50px;
			}
		.page-header{
			border-bottom: 1px solid #eeeeee;
		    margin: 0 0 20px;
		    padding-bottom: 9px;
		}
		.main{
			padding-top: 30px;
		}
		#appsname-font
		{
			font-size: 16px;
		}
		#menu-font
		{
			font-size: 12px;
		}

		.submenu-font
		{
			font-size: 12px;
			font-family: Tahoma;
			color: #333;
			margin-left: -5px;
		}
		.submenu-font:hover
		{
			font-size: 12px;
			font-family: Tahoma;
			color: #333;
			margin-left: -5px;
		}
		#count_result
		{
			float: right;
			color: #666;
			font-weight: bold;
		}
		#forms_style
		{
			width: 275px;
			height: 30px;
			font-size: 12px;
			border: 2px solid #eee;
			border-radius: 3px;
		}
		#forms_style_company
		{
			width: 275px;
			height: 45px;
			font-size: 12px;
			border: 2px solid #eee;
			border-radius: 3px;
		}
		#tbl_details_td
		{
			background-color: #eee; 
			width: 30%; 
			color: #666; 
			font-weight: bold;
			border:solid 1px #fff;
			text-align: center;
		}
		#btn_design
		{
			height: 45px;
		}
		#dashboard_container
		{
			/*border: solid 2px #eee; */
			margin: 0 auto;
		}
		#dashboard_request_content
		{
			/*border:1px #eee solid;
			border-radius: 5px;
			box-shadow:0px 0px 2px rgb(136,136,136); */
			width: 95%; 
			margin: 0 auto; 
		}
		#count_request
		{
			color:red; 
			font-weight: bold;
		}
		#bdo_border_notif
		{
			border: solid 0.5px;
		}
		#bdo_font_notif
		{
			font-size: 14px; 
			font-weight: bold; 
			font-style: italic;
		}
		#notifbox_font
		{
			font-style: italic;
			text-align:right;
			font-size: 10px;
		}
		#notif_phar 
		{ 
			font-size:10px; 
			color:#000; 
			margin:5px 5px 5px 80px; 
		}
		#related_title
		{
			font-size: 18px; 
			font-weight: bold;
		}
		.company_input
		{
			width: 27%;
			height: 37px;
			font-size: 12px;
			color: #666;
		}
		.position_input
		{
			width: 50%;
		}
		.des_position_input
		{
			width: 55%;
		}
		.des_position_input2
		{
			width: 55%;
			font-size: 12px;
			color: #666;
		}
		.contacts_input
		{
			width: 55%;
			height: 40px;
			font-size: 12px;
		}
		.address_input
		{
			width: 85%;
			height: 40px;
			font-size: 12px;
		}
		#project_form_container
		{
			border: solid 1px #eee;
			box-shadow:0px 0px 10px rgb(136,136,136); 
			border-radius: 5px;
		}
		#project_form
		{
			margin-left: 30px;
			font-size: 12px;
			font-family: Segoe UI Semibol;
			text-transform: uppercase;
		}
		#project_template_inhead_pn
		{
			margin-left: 10px;
			color: blue;
			text-decoration: underline;
			font-weight: bold;
			font-size: 16px;
		}
		#project_template_inhead
		{
			margin-left: 10px;
			color: blue;
			text-decoration: underline;
			font-weight: bold;
			font-size: 16px;
		}
		.datereported_input
		{
			width: 30%;
			font-size: 12px;
			height: 30px;
			border: solid 1px blue;
			border-radius: 3px;
			text-align: center;
			margin-left: 10px;
		}
		.bdo_input
		{
			width: 39%;
			height: 38px;
			font-size: 12px;
			color: #666;
		}
		.bdo_inputs
		{
			width: 70%;
		}
		.ar_input
		{
			width: 52%;
			font-size: 12px;
			height: 38px;
		}
		.proj_input
		{
			/*width: 85%;*/
			height: 40px;
			font-size: 13px;
		}
		.proj_address_input
		{
			color: #666;
			width: 75%;
			height: 40px;
			font-size: 13px;
		}
		.proj_owner_input
		{
			color: #666;
			width: 75%;
			height: 40px;
			font-size: 13px;
		}
		.prepared_bdo
		{
			font-size: 12px; 
			color: #666; 
			font-style: italic; 
			color: blue;
		}
		.selbox_input
		{
			width: 75%;
		}
		.selbox_input1
		{
			width: 75%;
		}
		.selbox_input2
		{
			width: 75%;
		}
		#txtarea_input
		{
			font-size: 13.5px;
		}
		.painting_input
		{
			width: 85%;
			font-size: 12px;
			height: 40px;
		}
		.paints_input
		{
			width: 26.5%;
			font-size: 12px;
			height: 40px;
		}
		.project_address
		{
			width: 88%;
			font-size: 12px;
			height: 40px;
			color: #666;	
		}
		.date_input
		{
			width: 20%;
			font-size: 12px;
			height: 40px;
			text-align: center;
		}
		.r_date_input_f
		{
			width: 90%;
			font-size: 11px;
			height: 35px;
			text-align: center;
		}
		.r_date_input_t
		{
			width: 90%;
			font-size: 11px;
			height: 35px;
			text-align: center;
		}
		.new_contact_btn
		{
			font-size: 11px;
			height: 30px;
			border: solid 1px #666;
			background-color: #333;
			color: #fff;
			border-radius: 3px;
			font-weight: bold;
			font-style: italic;
			font-family: ARIAL;
		}
		.cancel_contact_btn
		{
			font-size: 11px;
			height: 30px;
			border: solid 1px #666;
			background-color: #fff;
			color: #333;
			border-radius: 3px;
			font-weight: bold;
			font-style: italic;
			font-family: ARIAL;
		}
		.added_contact_div
		{
			margin-top: 20px;
		}
		.help-block
		{
			color: red;
			font-size: 11px;
		}
		#menu-header
		{
			background-color: #2C3E50; 
			color: #fff; 
			font-family: tahoma; 
			font-size: 13px; 
			text-align: center;
		}
		#menu-header
		{
			/*#2C3E50;*/
			background-color: #333;
			height: 25px;
			border: solid 0.5px #333;
			width: 195px;
			margin-left: -16px;
			color: #fff; 
			font-family: tahoma; 
			font-size: 13px; 
			text-align: center;
		}
		#menu-header1
		{
			/*#2C3E50;*/
			background-color: #fff;
			height: 25px;
			border: solid 0.5px #333;
			width: 195px;
			margin-left: -16px;
			color: #333; 
			font-family: tahoma; 
			font-size: 13px; 
			text-align: center;
		}
		#profile-img
		{
			height: 125px; 
			width: 135px; 
			margin-left: 15px; 
			/*border: solid 1px #666;*/
			/*border-radius: 3px;*/
		}
		#content-container
		{
			margin-top:10px; 
			border: solid 1px #333; 
			border-radius: 3px;
			box-shadow:1px 2px 3px rgb(136,136,136);
		}
		.right-side-divider
		{
			border-right: solid 1px #333;
			border-left: solid 1px #333;
		}
		.left-side-divider
		{
			border-left: solid 1px #333;
		}
		.project_categories_report
		{
			width: 75%;
		}
		.area_report
		{
			width: 50%;
		}
		.project_developer_report
		{
			width: 75%;
		}
		.general_contractor_report
		{
			width: 75%;
		}
		.project_mgr_designer_report
		{
			width: 75%;
		}
		.architect_report
		{
			width: 75%;
		}
		.applicator_report
		{
			width: 75%;
		}
		.dealer_supplier_report
		{
			width: 75%;
		}
		#tbl_form_design
		{	
			border: solid 1px #eee;
			font-size: 13px; 
			margin-top: 5px;
		}
		#btn-print
		{
			font-size: 11px;
		}
		#in_style
		{
			font-weight:bold;
			font-size:9px;
			color:red;
		}
		</style>
 
	</head>
	<body>
		<div id="menu-font" class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a href="{{ URL::route('dashboard.index') }}" id="appsname-font" class="navbar-brand">Project Reference System</a>
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download"> <b>WELCOME | </b> {{ strtoupper(Session::get('name')) }} &nbsp; <span class="caret"></span></a>
						<ul class="dropdown-menu" aria-labelledby="download">
							<li><a href="{{ URL::to('/edit-profile' . '/' . Auth::id()) }}">Edit Profile</a></li>
							<li>{{ HTML::link('/logout', 'Logout') }}</li>
						</ul>
					</li>
				</ul>
				
			</div>
		</div>
		<br/>

		<!-- <div style="margin-top:40px;" id="divLoading">
			<div class="loading" align="center" id="divImageLoader">
			    <img src="{{ URL::asset('asset/img/spinner-blue.gif') }}" style="height: 5%; width: 5%;"></img><br/>
			    <b style="font-size:12px;color: #333;font-weight:bold;"> Please wait </b> 
			</div>
			<br/>
	    </div> -->

		<div id="content-container" class="container">
			<div class="row">

				<div class="col-xs-12 col-sm-6 col-md-2 right-side-divider">
					
					<br/>
					<div class="form-group">
						<img src="{{ URL::asset('asset/img/user-img' . '/' . Session::get('myimage')) }}" alt="default" class="img-circle" id="profile-img">
					</div>
					
					<ul style="list-style-type:none;margin-left: -40px;">
					@if(Session::get('role') == 1)		
						<li id="menu-header"><b>SETTINGS</b></li>
						<li>{{ HTML::linkRoute('area.index', 'Area List', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('assign.area.index', 'Assign BDO-Area', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('client.index', 'Client Type Maintenance', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('department.index' , 'Department Maintenance', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.classification.index', 'Project Classification', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.category.index', 'Project Categories', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.stage.index', 'Project Stages', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.status.index', 'Project Status', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('designated-position.index', 'Position Maintenance', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('role.index', 'Role Maintenance', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('user.index', 'User Maintenance', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('task.index', 'Task Maintenance', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					</ul>

					<ul style="list-style-type:none;margin-left: -40px;">
					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3)
						<li id="menu-header"><b>FILE MAINTENANCE</b></li>
						<li>{{ HTML::linkRoute('item.index', 'Marketing Materials', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					</ul>

					<ul style="list-style-type:none;margin-left: -40px;">
						<li id="menu-header"><b>ACCOUNT DIRECTORY</b></li>
					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3)		
						<li>{{ HTML::linkRoute('company.index', 'My Company List', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('contact.index', 'My Contact Person List', array(), array('class' => 'submenu-font')) }}</li>
					@endif
						
					@if(Session::get('role') == 1)
						<li class="divider"></li>
					@endif

					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 4)		
						<li>{{ HTML::linkRoute('company.ra', 'Company Approval List', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('contact.ra', 'Contact Person Approval List', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.ra', 'Project Approval List', array(), array('class' => 'submenu-font')) }}</li>
						<!-- <li>Process Project</li> -->
					@endif
					</ul>	

					<ul style="list-style-type:none;margin-left: -40px;">
						<li id="menu-header"><b>PROJECT DIRECTORY</b></li>
					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3)
						<li>{{ HTML::linkRoute('project.index', 'My Project List', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3 || Session::get('role') == 4)
						<li>{{ HTML::linkRoute('project.list', 'My Assigned-Project List', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					</ul>

					<ul style="list-style-type:none;margin-left: -40px;">
						<li id="menu-header"><b>TASK DIRECTORY</b></li>
					@if(Session::get('role') == 1 || Session::get('role') == 2 || Session::get('role') == 3)
						<li>{{ HTML::linkRoute('create.mytask', 'My Task', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					@if(Session::get('role') == 1 || Session::get('task_receiver_access') > 0)
						<li>{{ HTML::linkRoute('task.request.receiver.forcontact', 'Task Receiver List', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					@if(Session::get('role') == 1 || Session::get('task_approver_access') > 0)
						<li>{{ HTML::linkRoute('task.request.approver.forcontact', 'Task Approver List', array(), array('class' => 'submenu-font')) }}</li>
					@endif
					</ul>		

					<ul style="list-style-type:none;margin-left: -40px;">
						<li id="menu-header"><b>REPORTS</b></li>
						<li></li>
						<li id="menu-header1"><b>PROJECT LIST</b></li>
						<li>{{ HTML::linkRoute('project.via.categories', 'Search by Categories', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.developer', 'Developer(In-Company)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.developer', 'Developer(Individual)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.gencon', 'Gen-Con(In-Company)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.gencon', 'Gen-Con(Individual)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.mngr.designer', 'Mngr/Designer(In-Company)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.mngr.designer', 'Mngr/Designer(Individual)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.architect', 'Architect(In-Company)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.architect', 'Architect(Individual)', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.applicator', 'Applicator', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.applicator', 'Sub-Applicator', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.dealer.supplier', 'Dealer/Supplier', array(), array('class' => 'submenu-font')) }}</li>
						<li>{{ HTML::linkRoute('project.via.sub.dealer.supplier', 'Sub-Dealer/Supplier', array(), array('class' => 'submenu-font')) }}</li>
					</ul>

					@if(Session::get('role') == 1)
						<ul style="list-style-type:none;margin-left: -40px;">
						<li id="menu-header"><b>UTILITIES</b></li>
						<li>{{ HTML::linkRoute('project.list', 'Logs', array(), array('class' => 'submenu-font')) }}</li>
						</ul>
					@endif
					
				<br/>
				</div>

				<div class="col-xs-12 col-sm-6 col-md-10 left-side-divider">
					<!-- <div class="container">	 -->

						<div id="body-content">

							@if(isset($pagetitle))
					        <div style="margin-top: 10px;" class="page-header" id="banner">
								<div class="row">
									<div class="col-lg-12">
										<h3>{{ $pagetitle }}</h3>

									</div>

								</div>
							</div>
							@endif

							@if (Session::has('message'))
				    		<div class="alert-box {{ Session::get('class') }}" style="font-size:14px;font-family: Segoe UI Semibold;">
				    			<span style="margin-left: 20px;"><b>{{ strtoupper(Session::get('class')) . '!' }}</b> {{ Session::get('message') }}</span>
				    		</div>
							@endif

				            <!-- @if ($errors->any())
							    <ul>
							        {{ implode('', $errors->all('<li style="font-size: 13px; font-style: italic;">:message</li>')) }}
							    </ul>
							@endif -->

							<div style="margin-top: 30px;">
								@yield('content')
							</div>
							<br/>
						<!-- </div> -->

					</div>
				</div>

			</div>	
		</div>
		<br/>

	</body>
</html>
