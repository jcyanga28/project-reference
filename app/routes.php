<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'FrontendController@index');

Route::group(array('before' => 'auth'), function()
{
	Route::resource('dashboard', 'DashboardController');
	Route::get('edit-profile/{id}', array('as' => 'edit.profile' ,'uses' => 'DashboardController@edit_profile'));
	Route::put('update-profile/{id}', array('as' => 'profile.update', 'uses' => 'DashboardController@updateprofile'));

	Route::get('contact/notification', array('as' => 'contact.notif', 'uses' => 'NotificationController@contact_notification'));
	Route::get('company/notification', array('as' => 'company.notif', 'uses' => 'NotificationController@company_notification'));
	Route::get('project/notification', array('as' => 'project.notif', 'uses' => 'NotificationController@project_notification'));

//User/Admin Maintenance	
	
	//-area list-//
	Route::resource('area', 'AreaController');
	//-assigning of area-//
	Route::resource('assign/area', 'AssignedAreaController');
	//-client type-//
	Route::resource('client', 'ClientTypeController');
	//-department-//
	Route::resource('department', 'DepartmentController');
	
	//-project maintenance-//
		//-project classification-//
		Route::resource('project/classification', 'ProjectClassificationController');
		//-project category-//
		Route::resource('project/category', 'ProjectCategoriesController');
		//-project stage-//
		Route::resource('project/stage', 'ProjectStagesController');
		//-project status-//
		Route::resource('project/status', 'ProjectStatusController');

	//-designated position-//
	Route::resource('designated-position', 'PositionController');	
	//-role-//
	Route::resource('role', 'RoleController');
	//-user-//
	Route::resource('user', 'UsersController');
	Route::get('role/{id}/manageprivilleges', array('as' => 'role.manageprivilleges', 'uses' => 'RoleController@manageprivilleges'))->where('id', '[1-9][0-9]*');
	Route::put('role/{id}/updatepriveleges', array('as' => 'role.updateprivilleges', 'uses' => 'RoleController@updateprivilleges'));
	Route::resource('task', 'TaskController');
	Route::get('create/mytask/contact', array('as' => 'create.mytask', 'uses' => 'TaskController@create_mytask_forcontact'));
	Route::get('create/mytask/company', array('as' => 'create.mytask.company', 'uses' => 'TaskController@create_mytask_forcompany'));
	Route::get('create/mytask/project', array('as' => 'create.mytask.project', 'uses' => 'TaskController@create_mytask_forproject'));
	Route::get('create/mytask/others', array('as' => 'create.mytask.others', 'uses' => 'TaskController@create_mytask_forothers'));
	
	//------task for contact-------//
	Route::get('new/task/contact', array('as' => 'newtask.forcontact', 'uses' => 'TaskController@newtask_forcontact'));
	Route::post('task/contact/store', array('as' => 'task.forcontact.store', 'uses' => 'TaskController@newtask_forcontact_store'));
	Route::get('edit/task/contact/{id}', array('as' => 'task.forcontact.edit', 'uses' => 'TaskController@edittask_forcontact'));
	Route::put('task/contact/update/{id}', array('as' => 'task.forcontact.update', 'uses' => 'TaskController@newtask_forcontact_update'));
	Route::delete('task/forcontact/destroy/{id}', array('as' => 'task.forcontact.destroy', 'uses' => 'TaskController@newtask_forcontact_destroy'));
	Route::get('task/contact/details/{id}', array('as' => 'task.forcontact.details', 'uses' => 'TaskController@forcontact_details'));
	
	//------task for company-------//
	Route::get('new/task/company', array('as' => 'newtask.forcompany', 'uses' => 'TaskController@newtask_forcompany'));
	Route::post('task/company/store', array('as' => 'task.forcompany.store', 'uses' => 'TaskController@newtask_forcompany_store'));
	Route::get('edit/task/company/{id}', array('as' => 'task.forcompany.edit', 'uses' => 'TaskController@edittask_forcompany'));
	Route::put('task/company/update/{id}', array('as' => 'task.forcompany.update', 'uses' => 'TaskController@newtask_forcompany_update'));
	Route::delete('task/forcompany/destroy/{id}', array('as' => 'task.forcompany.destroy', 'uses' => 'TaskController@newtask_forcompany_destroy'));
	Route::get('task/company/details/{id}', array('as' =>'task.forcompany.details', 'uses' => 'TaskController@forcompany_details'));

	//------task for project-------//
	Route::get('new/task/project', array('as' => 'newtask.forproject', 'uses' => 'TaskController@newtask_forproject'));
	Route::post('task/project/store', array('as' => 'task.forproject.store', 'uses' => 'TaskController@newtask_forproject_store'));
	Route::get('edit/task/project/{id}', array('as' => 'task.forproject.edit', 'uses' => 'TaskController@edittask_forproject'));
	Route::put('task/project/update/{id}', array('as' => 'task.forproject.update', 'uses' => 'TaskController@newtask_forproject_update'));
	Route::delete('task/forproject/destroy/{id}', array('as' => 'task.forproject.destroy', 'uses' => 'TaskController@newtask_forproject_destroy'));
	Route::get('task/project/details/{id}', array('as' =>'task.forproject.details', 'uses' => 'TaskController@forproject_details'));
	
	//------task for others-------//
	Route::get('new/task/others', array('as' => 'newtask.forothers', 'uses' => 'TaskController@newtask_forothers'));
	Route::post('task/others/store', array('as' => 'task.forothers.store', 'uses' => 'TaskController@newtask_forothers_store'));
	Route::get('edit/task/others/{id}', array('as' => 'task.forothers.edit', 'uses' => 'TaskController@edittask_forothers'));
	Route::put('task/others/update/{id}', array('as' => 'task.forothers.update', 'uses' => 'TaskController@newtask_forothers_update'));
	Route::delete('task/forothers/destroy/{id}', array('as' => 'task.forothers.destroy', 'uses' => 'TaskController@newtask_forothers_destroy'));
	Route::get('task/others/details/{id}', array('as' =>'task.forothers.details', 'uses' => 'TaskController@forothers_details'));
	
	//--task request receiver contact--//
	Route::get('task/request-receiver/contact', array('as' =>'task.request.receiver.forcontact', 'uses' => 'TaskController@newtask_request_receiver_forcontact'));
	Route::get('task/request-receiver/contact/details/{id}', array('as' =>'task.request.forcontact.details', 'uses' => 'TaskController@newtask_request_receiver_forcontact_details'));
	Route::post('task/forcontact/approve', array('as' =>'task.forcontact.approve', 'uses' => 'TaskController@newtask_forcontact_approve'));
	Route::put('task/forcontact/decline/{id}', array('as' =>'task.forcontact.decline', 'uses' => 'TaskController@newtask_forcontact_decline'));
	Route::post('task/forcontact/approve/remarks', array('as' =>'task.forcontact.approve.tagremarks', 'uses' => 'TaskController@newtask_forcontact_approve_saveremarks'));
			
	//--task request receiver company--//
	Route::get('task/request-receiver/company', array('as' =>'task.request.receiver.forcompany', 'uses' => 'TaskController@newtask_request_receiver_forcompany'));
	Route::get('task/request-receiver/company/details/{id}', array('as' =>'task.request.forcompany.details', 'uses' => 'TaskController@newtask_request_receiver_forcompany_details'));
	Route::post('task/forcompany/approve', array('as' =>'task.forcompany.approve', 'uses' => 'TaskController@newtask_forcompany_approve'));
	Route::put('task/forcompany/decline/{id}', array('as' =>'task.forcompany.decline', 'uses' => 'TaskController@newtask_forcompany_decline'));
	Route::post('task/forcompany/approve/remarks', array('as' =>'task.forcompany.approve.tagremarks', 'uses' => 'TaskController@newtask_forcompany_approve_saveremarks'));
	
	//--task request receiver project--//
	Route::get('task/request-receiver/project', array('as' =>'task.request.receiver.forproject', 'uses' => 'TaskController@newtask_request_receiver_forproject'));
	Route::get('task/request-receiver/project/details/{id}', array('as' =>'task.request.forproject.details', 'uses' => 'TaskController@newtask_request_receiver_forproject_details'));
	Route::post('task/forproject/approve', array('as' =>'task.forproject.approve', 'uses' => 'TaskController@newtask_forproject_approve'));
	Route::put('task/forproject/decline/{id}', array('as' =>'task.forproject.decline', 'uses' => 'TaskController@newtask_forproject_decline'));
	Route::post('task/forproject/approve/remarks', array('as' =>'task.forproject.approve.tagremarks', 'uses' => 'TaskController@newtask_forproject_approve_saveremarks'));
	
	//--task request receiver other--//
	Route::get('task/request-receiver/others', array('as' =>'task.request.receiver.forothers', 'uses' => 'TaskController@newtask_request_receiver_forothers'));
	Route::get('task/request-receiver/others/details/{id}', array('as' =>'task.request.forothers.details', 'uses' => 'TaskController@newtask_request_receiver_forothers_details'));
	Route::post('task/forothers/approve', array('as' =>'task.forothers.approve', 'uses' => 'TaskController@newtask_forothers_approve'));
	Route::put('task/forothers/decline/{id}', array('as' =>'task.forothers.decline', 'uses' => 'TaskController@newtask_forothers_decline'));
	Route::post('task/forothers/approve/remarks', array('as' =>'task.forothers.approve.tagremarks', 'uses' => 'TaskController@newtask_forothers_approve_saveremarks'));
	
	//--task request approver contact--//
	Route::get('task/request-approver/contact', array('as' =>'task.request.approver.forcontact', 'uses' => 'TaskController@newtask_request_approver_forcontact'));
	Route::get('task/request-approver/contact/details/{id}', array('as' =>'task.approver.forcontact.details', 'uses' => 'TaskController@newtask_request_approver_forcontact_details'));
	Route::post('task/forcontact/approver/remarks', array('as' =>'task.forcontact.approver.tagremarks', 'uses' => 'TaskController@newtask_forcontact_approver_saveremarks'));
	
	//--task request approver company--//
	Route::get('task/request-approver/company', array('as' =>'task.request.approver.forcompany', 'uses' => 'TaskController@newtask_request_approver_forcompany'));
	Route::get('task/request-approver/company/details/{id}', array('as' =>'task.approver.forcompany.details', 'uses' => 'TaskController@newtask_request_approver_forcompany_details'));
	Route::post('task/forcompany/approver/remarks', array('as' =>'task.forcompany.approver.tagremarks', 'uses' => 'TaskController@newtask_forcompany_approver_saveremarks'));
	
	//--task request approver project--//
	Route::get('task/request-approver/project', array('as' =>'task.request.approver.forproject', 'uses' => 'TaskController@newtask_request_approver_forproject'));
	Route::get('task/request-approver/project/details/{id}', array('as' =>'task.approver.forproject.details', 'uses' => 'TaskController@newtask_request_approver_forproject_details'));
	Route::post('task/forproject/approver/remarks', array('as' =>'task.forproject.approver.tagremarks', 'uses' => 'TaskController@newtask_forproject_approver_saveremarks'));
	
	//--task request approver others--//
	Route::get('task/request-approver/others', array('as' =>'task.request.approver.forothers', 'uses' => 'TaskController@newtask_request_approver_forothers'));
	Route::get('task/request-approver/others/details/{id}', array('as' =>'task.approver.forothers.details', 'uses' => 'TaskController@newtask_request_approver_forothers_details'));
	Route::post('task/forothers/approver/remarks', array('as' =>'task.forothers.approver.tagremarks', 'uses' => 'TaskController@newtask_forothers_approver_saveremarks'));
	

	//-role-//
	Route::resource('role', 'RoleController');
//-------//

//User/Admin Maintenance	
	
	//-item-//
	Route::resource('item', 'ItemController');
	
//-------//	
	
	//-contact-//
	Route::resource('contact', 'ContactController');
	Route::get('contact/lists/{query}', function($query){

		// $data = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	 //    return Response::json($data);
	   $data = array();
	   $results = Contact::select('fullname')->where('status' , '=' , '2')->where('fullname', 'LIKE', '%'.$query.'%')->get();
	   
	   if(count($results)>0)
	   {
	   		foreach($results as $row)
	   		{
	   			$data[] = strtolower($row->fullname)."";
	   		}

	   }else{
	   		$data[] = 'No record found.';

	   }
	   

	   return Response::json($data);

	});
	Route::post('contact/getcompanyinfo', 'ContactController@getcompanyinfo');
	Route::post('contact/getcompanyinfo/update', 'ContactController@getcompanyinfo');

	Route::get('contact/{id}/information/{query}', function($id,$query){

		// $data = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	 //    return Response::json($data);
	   $data = array();
	   $results = Contact::select('fullname')->where('status' , '=' , '2')->where('fullname', 'LIKE', '%'.$query.'%')->get();
	   
	   if(count($results)>0)
	   {
	   		foreach($results as $row)
	   		{
	   			$data[] = strtolower($row->fullname)."";
	   		}

	   }else{
	   		$data[] = 'No record found.';

	   }
	   
	   return Response::json($data);

	});

	Route::post('contact/process', 'ContactController@process');
	Route::get('ra-contacts', array('as' => 'contact.ra', 'uses' => 'ContactController@ra'));
	Route::put('contacts/approve/{id}', array('as' => 'contact.a', 'uses' => 'ContactController@a'));
	Route::put('contacts/denied/{id}', array('as' => 'contact.d', 'uses' => 'ContactController@d'));
	Route::get('ra-contacts/details/{id}', array('as' => 'contact.dt', 'uses' => 'ContactController@details'));

	Route::resource('company', 'CompanyController');
	Route::get('company/lists/{query}', function($query){

		// $data = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	 //    return Response::json($data);
	   $data = array();	
	   $results = Company::select('company_name')->where('status' , '=' , '2')->where('company_name', 'LIKE', '%'.$query.'%')->get();
	   
	   if(count($results)>0)
	   {
	   		foreach($results as $row)
	   		{
	   			$data[] = strtolower($row->company_name)."";
	   		}

	   }else{
	   		$data[] = 'No record found.';

	   }
	   

	   return Response::json($data);

	});

	Route::get('company/{id}/information/{query}', function($id,$query){

		// $data = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	 //    return Response::json($data);
	   $data = array();
	   $results = Company::select('company_name')->where('status' , '=' , '2')->where('company_name', 'LIKE', '%'.$query.'%')->get();
	   
	   if(count($results)>0)
	   {
	   		foreach($results as $row)
	   		{
	   			$data[] = strtolower($row->company_name)."";
	   		}

	   }else{
	   		$data[] = 'No record found.';

	   }
	   
	   return Response::json($data);

	});

	Route::get('company/details/{id}', array('as' => 'company.dt', 'uses' => 'CompanyController@details'));
	Route::get('ra-company', array('as' => 'company.ra', 'uses' => 'CompanyController@ra'));
	Route::put('company/approve/{id}', array('as' => 'company.a', 'uses' => 'CompanyController@a'));
	Route::put('company/denied/{id}', array('as' => 'company.d', 'uses' => 'CompanyController@d'));
	Route::get('ra-company/details/{id}', array('as' => 'ra.company.dt', 'uses' => 'CompanyController@ra_details'));
	
	Route::resource('project', 'ProjectController');
	Route::get('project/lists/{query}', function($query){

		// $data = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	 //    return Response::json($data);
	   $data = array();	
	   $results = Project::select('project_name')->where('status' , '=' , '2')->where('project_name', 'LIKE', '%'.$query.'%')->get();
	   
	   if(count($results)>0)
	   {
	   		foreach($results as $row)
	   		{
	   			$data[] = strtolower($row->project_name)."";
	   		}

	   }else{
	   		$data[] = 'No record found.';

	   }
	   

	   return Response::json($data);

	});

	Route::get('project/details/{id}', array('as' => 'project.dt', 'uses' => 'ProjectController@details'));
	Route::get('ra-projects', array('as' => 'project.ra', 'uses' => 'ProjectController@ra'));
	Route::put('project/approve/{id}', array('as' => 'project.a', 'uses' => 'ProjectController@a'));
	Route::put('project/denied/{id}', array('as' => 'project.d', 'uses' => 'ProjectController@d'));
	Route::get('ra-project/details/{id}', array('as' => 'ra.project.dt', 'uses' => 'ProjectController@ra_details'));
	Route::post('projects/getarea', 'ProjectController@getarea');
	Route::post('projects/getdeveloper', function(){

		$id = Input::get('bdo_id');
		
		$data = DB::table('contacts')
						->select(DB::raw('concat(users.first_name, " " , users.last_name) as fullname, users.id'))
						->join('users', 'users.id', '=', 'contacts.created_by')
						->where('contacts.id', $id)
						->first();

		return Response::json($data);				
	});
	Route::post('projects/getgencon', function(){

		$id = Input::get('bdo_id');
		
		$data = DB::table('contacts')
						->select(DB::raw('concat(users.first_name, " " , users.last_name) as fullname, users.id'))
						->join('users', 'users.id', '=', 'contacts.created_by')
						->where('contacts.id', $id)
						->first();

		return Response::json($data);				
	});
	Route::post('projects/getprojmgrdesigner', function(){

		$id = Input::get('bdo_id');
		
		$data = DB::table('contacts')
						->select(DB::raw('concat(users.first_name, " " , users.last_name) as fullname, users.id'))
						->join('users', 'users.id', '=', 'contacts.created_by')
						->where('contacts.id', $id)
						->first();

		return Response::json($data);				
	});
	Route::post('projects/getarchitect', function(){

		$id = Input::get('bdo_id');
		
		$data = DB::table('contacts')
						->select(DB::raw('concat(users.first_name, " " , users.last_name) as fullname, users.id'))
						->join('users', 'users.id', '=', 'contacts.created_by')
						->where('contacts.id', $id)
						->first();

		return Response::json($data);				
	});
	Route::post('projects/getapplicator', function(){

		$id = Input::get('bdo_id');
		
		$data = DB::table('contacts')
						->select(DB::raw('concat(users.first_name, " " , users.last_name) as fullname, users.id'))
						->join('users', 'users.id', '=', 'contacts.created_by')
						->where('contacts.id', $id)
						->first();

		return Response::json($data);				
	});
	Route::post('projects/getdealersupplier', function(){

		$id = Input::get('bdo_id');
		
		$data = DB::table('contacts')
						->select(DB::raw('concat(users.first_name, " " , users.last_name) as fullname, users.id'))
						->join('users', 'users.id', '=', 'contacts.created_by')
						->where('contacts.id', $id)
						->first();

		return Response::json($data);				
	});

	Route::get('projects/edit/bdo/{id}', array('as' => 'project.editbdo', 'uses' => 'ProjectController@editbdo'));
	Route::put('projects/update/bdo/{id}', array('as' => 'project.updatebdo', 'uses' => 'ProjectController@updatebdo'));
	Route::get('myprojects', array('as' => 'project.list', 'uses' => 'ProjectController@myprojectlist'));

	Route::get('myprojects/{id}/details', array('uses' => 'ProjectController@myproject_details'));
	Route::get('myprojects/{id}/status', array('as' => 'myproject.status', 'uses' => 'ProjectController@myproject_status'));
	Route::post('myprojects/{id}/addremarks', array('as' => 'project.remarks', 'uses' => 'ProjectController@myproject_addremarks'));
	Route::get('closed-project/{id}/information', array('as' => 'closed.project.information', 'uses' => 'ProjectController@closedproject_information'));
	Route::put('activate-project/{id}', array('as' => 'activate.project', 'uses' => 'ProjectController@activate_project'));

	Route::get('/download/{filename}', array(function($filename){

		$split = explode(".", $filename);
		$mime = end($split);
		// public_path() . '/asset/img/project/' . $filename; <-- localhost
		if($mime == "gif" || $mime == "jpg" || $mime == "png" || $mime == "bmp" || $mime == "jpeg")
		{
			$file = './public/asset/img/project/' . $filename;	
			// $destinationPath = './public/asset/img/project'; // upload path
		}else{
			$file = './public/asset/files/project/' . $filename;
			// $destinationPath = './public/asset/files/project'; // upload path	        			
		}
       
        return Response::download($file);

	}));

	Route::get('/download-thread/{filename}', array(function($filename){

		$split = explode(".", $filename);
		$mime = end($split);
		// $public_path
		if($mime == "gif" || $mime == "jpg" || $mime == "png" || $mime == "bmp" || $mime == "jpeg")
		{
			$file = './public/asset/img/project-thread/' . $filename;	
			// $destinationPath = './public/asset/img/project'; // upload path
		}else{
			$file = './public/asset/files/project-thread/' . $filename;
			// $destinationPath = './public/asset/files/project'; // upload path	        			
		}
       
        return Response::download($file);

	}));

	//---task for contact--//
	Route::get('/contact/download/{filename}', array(function($filename){

		$split = explode(".", $filename);
		$mime = end($split);
		// public_path() . '/asset/img/project/' . $filename; <-- localhost
		$file = './public/asset/files/task_forcontact/' . $filename;
			// $destinationPath = './public/asset/files/project'; // upload path
       
        return Response::download($file);

	}));

	Route::get('/download-request/contact-thread/{filename}', array(function($filename){

		$split = explode(".", $filename);
		$mime = end($split);
		// $public_path
		if($mime == "gif" || $mime == "jpg" || $mime == "png" || $mime == "bmp" || $mime == "jpeg")
		{
			$file = './public/asset/img/forcontact-thread/' . $filename;	
			// $destinationPath = './public/asset/img/project'; // upload path
		}else{
			$file = './public/asset/files/forcontact-thread/' . $filename;
			// $destinationPath = './public/asset/files/project'; // upload path	        			
		}
       
        return Response::download($file);

	}));

	//---task for company--//
	Route::get('/company/download/{filename}', array(function($filename){

		$split = explode(".", $filename);
		$mime = end($split);
		// public_path() . '/asset/img/project/' . $filename; <-- localhost
		$file = './public/asset/files/task_forcompany/' . $filename;
			// $destinationPath = './public/asset/files/project'; // upload path
       
        return Response::download($file);

	}));

	Route::get('/download-request/company-thread/{filename}', array(function($filename){

		$split = explode(".", $filename);
		$mime = end($split);
		// $public_path
		if($mime == "gif" || $mime == "jpg" || $mime == "png" || $mime == "bmp" || $mime == "jpeg")
		{
			$file = './public/asset/img/forcompany-thread/' . $filename;	
			// $destinationPath = './public/asset/img/project'; // upload path
		}else{
			$file = './public/asset/files/forcompany-thread/' . $filename;
			// $destinationPath = './public/asset/files/project'; // upload path	        			
		}
       
        return Response::download($file);

	}));

	//---task for project--//
	Route::get('/project/download/{filename}', array(function($filename){

		$split = explode(".", $filename);
		$mime = end($split);
		// public_path() . '/asset/img/project/' . $filename; <-- localhost
		$file = './public/asset/files/task_forproject/' . $filename;
			// $destinationPath = './public/asset/files/project'; // upload path
       
        return Response::download($file);

	}));

	Route::get('/download-request/project-thread/{filename}', array(function($filename){

		$split = explode(".", $filename);
		$mime = end($split);
		// $public_path
		if($mime == "gif" || $mime == "jpg" || $mime == "png" || $mime == "bmp" || $mime == "jpeg")
		{
			$file = './public/asset/img/forproject-thread/' . $filename;	
			// $destinationPath = './public/asset/img/project'; // upload path
		}else{
			$file = './public/asset/files/forproject-thread/' . $filename;
			// $destinationPath = './public/asset/files/project'; // upload path	        			
		}
       
        return Response::download($file);

	}));

	//---task for others--//
	Route::get('/others/download/{filename}', array(function($filename){

		$split = explode(".", $filename);
		$mime = end($split);
		// public_path() . '/asset/img/project/' . $filename; <-- localhost
		$file = './public/asset/files/task_forothers/' . $filename;
			// $destinationPath = './public/asset/files/project'; // upload path
       
        return Response::download($file);

	}));

	Route::get('/download-request/others-thread/{filename}', array(function($filename){

		$split = explode(".", $filename);
		$mime = end($split);
		// $public_path
		if($mime == "gif" || $mime == "jpg" || $mime == "png" || $mime == "bmp" || $mime == "jpeg")
		{
			$file = './public/asset/img/forothers-thread/' . $filename;	
			// $destinationPath = './public/asset/img/project'; // upload path
		}else{
			$file = './public/asset/files/forothers-thread/' . $filename;
			// $destinationPath = './public/asset/files/project'; // upload path	        			
		}
       
        return Response::download($file);

	}));

//----reports----//

	Route::get('company-reports-list', array('as' => 'company.reports.list', 'uses' => 'ReportsController@company_reports_list')); 
	
	Route::get('project-report/categories', array('as' => 'project.via.categories', 'uses' => 'ReportsController@project_via_categories'));
	Route::post('project-via-categories-print', array('as' => 'generate.projectsviacategories.report', 'uses' => 'ReportsController@project_via_categories_print')); 
	
	Route::get('project-report/developer/in-company', array('as' => 'project.via.developer', 'uses' => 'ReportsController@project_via_developer'));
	Route::post('project-via-developer-print', array('as' => 'generate.projectsviadevelopers.report', 'uses' => 'ReportsController@project_via_developers_print'));

	Route::get('project-report/developer/individual', array('as' => 'project.via.sub.developer', 'uses' => 'ReportsController@project_via_sub_developer'));
	Route::post('project-via-sub-developer-print', array('as' => 'generate.projectsviasubdevelopers.report', 'uses' => 'ReportsController@project_via_sub_developers_print')); 
	
	Route::get('project-report/gencon/in-company', array('as' => 'project.via.gencon', 'uses' => 'ReportsController@project_via_gencon'));
	Route::post('project-via-gencon-print', array('as' => 'generate.projectsviagencons.report', 'uses' => 'ReportsController@project_via_gencons_print'));

	Route::get('project-report/gencon/individual', array('as' => 'project.via.sub.gencon', 'uses' => 'ReportsController@project_via_sub_gencon'));
	Route::post('project-via-sub-gencon-print', array('as' => 'generate.projectsviasubgencons.report', 'uses' => 'ReportsController@project_via_sub_gencons_print')); 
	
	Route::get('project-report/mngr-or-designer/in-company', array('as' => 'project.via.mngr.designer', 'uses' => 'ReportsController@project_via_mngrdesigner'));
	Route::post('project-via-mngrdesigners-print', array('as' => 'generate.projectsviamngrdesigners.report', 'uses' => 'ReportsController@project_via_mgrdesigners_print'));

	Route::get('project-report/mngr-or-designer/individual', array('as' => 'project.via.sub.mngr.designer', 'uses' => 'ReportsController@project_via_sub_mngrdesigner'));
	Route::post('project-via-sub-mngrdesigners-print', array('as' => 'generate.projectsviasubmngrdesigners.report', 'uses' => 'ReportsController@project_via_sub_mgrdesigners_print')); 
	
	Route::get('project-report/architect/in-company', array('as' => 'project.via.architect', 'uses' => 'ReportsController@project_via_architect'));
	Route::post('project-via-architects-print', array('as' => 'generate.projectsviaarchitects.report', 'uses' => 'ReportsController@project_via_architects_print')); 
	
	Route::get('project-report/architect/individual', array('as' => 'project.via.sub.architect', 'uses' => 'ReportsController@project_via_sub_architect'));
	Route::post('project-via-sub-architects-print', array('as' => 'generate.projectsviasubarchitects.report', 'uses' => 'ReportsController@project_via_sub_architect_print'));

	Route::get('project-report/applicator', array('as' => 'project.via.applicator', 'uses' => 'ReportsController@project_via_applicator'));
	Route::post('project-via-applicators-print', array('as' => 'generate.projectsviaapplicators.report', 'uses' => 'ReportsController@project_via_applicators_print'));

	Route::get('project-report/sub-applicator', array('as' => 'project.via.sub.applicator', 'uses' => 'ReportsController@project_via_sub_applicator'));
	Route::post('project-via-sub-applicators-print', array('as' => 'generate.projectsviasubapplicators.report', 'uses' => 'ReportsController@project_via_sub_applicators_print')); 

	Route::get('project-report/dealer-supplier', array('as' => 'project.via.dealer.supplier', 'uses' => 'ReportsController@project_via_dealersupplier'));
	Route::post('project-via-dealersuppliers-print', array('as' => 'generate.projectsviadealersuppliers.report', 'uses' => 'ReportsController@project_via_dealersuppliers_print'));

	Route::get('project-report/sub-dealer-supplier', array('as' => 'project.via.sub.dealer.supplier', 'uses' => 'ReportsController@project_via_sub_dealersupplier'));
	Route::post('project-via-sub-dealersuppliers-print', array('as' => 'generate.projectsviasubdealersuppliers.report', 'uses' => 'ReportsController@project_via_sub_dealersuppliers_print')); 
	

});

Route::get('login', 'SessionController@login');
Route::post('login', 'SessionController@doLogin');

Route::get('logout', 'SessionController@logout');
