<?php

class TaskController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /task
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'Task/s List';

		$task = DB::table('tasks')->orderBy('id', 'desc')->paginate(5);

		return View::make('task.index', compact('pagetitle','task'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /task/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = "Create Task";

		$get_user = User::where('dept_id', '>', 1)->orderBy('id','asc')->get();
		return View::make('task.create', compact('pagetitle','get_user'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /task
	 *
	 * @return Response
	 */
	public function store()
	{

		// Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Task::$rules);

		if($validation->passes()){
			
			$task = new Task();

			$task->task = strtoupper(Input::get('task'));
			$task->description = strtoupper(Input::get('description'));
			$task->save();
			$id = $task->id;
		
		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);
    		
		$task_approver = Input::get('task_approver');
		$task_receiver = Input::get('task_receiver');
		
		foreach($task_approver as $row_approver)
		{
			DB::table('task_approver')->insert(array([
                  'task_id' => $id,
                  'user_id' => $row_approver,
                  'datetime_created' => date('Y-m-d') . $datetime_now,
            ]));
		}

		foreach($task_receiver as $row_receiver)
		{
			DB::table('task_receiver')->insert(array([
                  'task_id' => $id,
                  'user_id' => $row_receiver,
                  'datetime_created' => date('Y-m-d') . $datetime_now,
            ]));
		}		
			
			return Redirect::route('task.index')
								->with('class', 'success')
								->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('task.create')
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');
		}
	}

	/**
	 * Display the specified resource.
	 * GET /task/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /task/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = "Update Task";

		$task = Task::find($id);
		$task_approver = DB::table('task_approver')->where('task_id', $id)->get(); 
		$task_receiver = DB::table('task_receiver')->where('task_id', $id)->get(); 
		$get_user = User::where('dept_id', '>', 1)->orderBy('id','asc')->get();

		return View::make('task.edit', compact('pagetitle','task','get_user','task_approver','task_receiver'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /task/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Task::$update_rules);

		if($validation->passes()){

			$task = Task::find($id);

			if(is_null($task)){
				return Redirect::route('task.index')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Task information does not exist.');
			}

			$task->task = strtoupper(Input::get('task'));
			$task->description = strtoupper(Input::get('description'));
			$task->save();
			$id = $task->id;
			
			DB::table('task_approver')->where('task_id', $id)->delete();
			DB::table('task_receiver')->where('task_id', $id)->delete();

			$gettime = time() - 14400;
	    	$datetime_now = date("H:i:s", $gettime);
	    		
			$task_approver = Input::get('task_approver');
			$task_receiver = Input::get('task_receiver');
			
			foreach($task_approver as $row_approver)
			{
				DB::table('task_approver')->insert(array([
	                  'task_id' => $id,
	                  'user_id' => $row_approver,
	                  'datetime_created' => date('Y-m-d') . $datetime_now,
	            ]));
			}

			foreach($task_receiver as $row_receiver)
			{
				DB::table('task_receiver')->insert(array([
	                  'task_id' => $id,
	                  'user_id' => $row_receiver,
	                  'datetime_created' => date('Y-m-d') . $datetime_now,
	            ]));
			}	

			return Redirect::route('task.index')
									->with('class', 'success')
									->with('message', 'Record successfully updated.');

		}else{

			return Redirect::route('task.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation error.');

		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /task/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$taskid = $id;

		$task = Task::find($id)->delete();

		if(is_null($task)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			DB::table('task_approver')->where('task_id', $taskid)->delete();
			DB::table('task_receiver')->where('task_id', $taskid)->delete();

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('task.index')
								->with('class', $class)
								->with('message', $message);
	}

	//-------------------create task-----------------------//
	public function create_mytask_forcontact()
	{	
		$pagetitle = 'My Task for Contact';

		if(Session::get('role') == 1)
		{
			 $mytask_forcontact = Task::select_allmytask_forcontact(Input::get('status',1),Input::get('s'));
		
		}else{
			
			 $mytask_forcontact = Task::select_mytask_forcontact(Input::get('status',1),Input::get('s'),Auth::id());

		} 

		return View::make('task.mytaskforcontact', compact('pagetitle','mytask_forcontact'));
	}

	public function newtask_forcontact()
	{
		$pagetitle = 'New Task for Contact';

		$get_contact = Contact::where('status', '=', 2)->orderBy('fullname','asc')->lists('fullname', 'id');
		$get_task = Task::orderBy('task','asc')->lists('task', 'id');

		return View::make('task.create_taskforcontact',compact('pagetitle','get_contact','get_task'));
	}

	public function newtask_forcontact_store()
	{
		$contact = Input::get('contact');
		$task = Input::get('task');
		$amount = Input::get('amount');
		$remarks = Input::get('remarks');

		if($contact == "" || $task == "" || $amount == "" || $remarks == "" || Input::get('date_start') == "" || Input::get('date_end') == "")
		{
			return Redirect::route('newtask.forcontact')
									->withInput()
									->with('class', 'error')
									->with('message', 'Fill-up *required fields.');
		}else{

		$date_start = explode("-", Input::get('date_start'));
		$startdate = $date_start[2] . '-' . $date_start[0] . '-' . $date_start[1];

		$date_end = explode("-", Input::get('date_end'));
		$enddate = $date_end[2] . '-' . $date_end[0] . '-' . $date_end[1];

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		$forcontact = DB::table('mytask_forcontact')->insertGetId(array(
              'contact_id' => $contact,
              'task_id' => $task,
              'amount' => $amount,
              'remarks' => $remarks,
              'date_start' => $startdate,
              'date_end' => $enddate,
              'status' => 1,
              'created_by' => Auth::id(),
              'date_created' => date('Y-m-d'),
              'time_created' => $datetime_now));

        $filename = Input::file('image');

	    if(Input::hasFile('image'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	// $imgname = $img->getClientOriginalName();
		   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('newtask.forcontact')
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
				$destinationPath = base_path() . '/public/asset/files/task_forcontact'; // upload path
				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $type = "1";
	            }else{
	              $type = "2";    
	            }

				DB::table('attached_forcontact')->insert(array([
	                  'type' => $type,
	                  'forcontact_id' => $forcontact,
	                  'user_id' => Auth::id(),
	                  'status' => 1,
	                  'file_img' => $imgname,
	                  'date_created' => date('Y-m-d'),
	                  'time_created' => $datetime_now,
	            ]));

		   	}

		   }

		}	   		
        return Redirect::route('create.mytask')
								->withInput()
								->with('class', 'success')
								->with('message', 'Your created request was successfully saved.');
		}
			
	}

	public function edittask_forcontact($id)
	{
		$pagetitle = 'Edit Task for Contact';

		$get_contact = Contact::where('status', '=', 2)->orderBy('fullname','asc')->lists('fullname', 'id');
		$get_task = Task::orderBy('task','asc')->lists('task', 'id');
		$get_taskforcontact = DB::table('mytask_forcontact')->where('id', $id)->first();

		$getattached = DB::table('attached_forcontact')->where('forcontact_id', $id)->get();

		$my_contact = Contact::where('id', $get_taskforcontact->contact_id)->first();
		$my_task = Task::where('id', $get_taskforcontact->task_id)->first();

		return View::make('task.edit_taskforcontact', compact('pagetitle', 'get_contact', 'get_task', 'get_taskforcontact', 'my_contact', 'my_task', 'getattached'));
	}

	public function newtask_forcontact_update($id)
	{
		$contact = Input::get('contact');
		$task = Input::get('task');
		$amount = Input::get('amount');
		$remarks = Input::get('remarks');

		if($contact == "" || $task == "" || $amount == "" || $remarks == "" || Input::get('date_start') == "" || Input::get('date_end') == "")
		{
			return Redirect::route('task.forcontact.edit', $id)
									->withInput()
									->with('class', 'error')
									->with('message', 'Fill-up *required fields.');
		}else{

		$date_start = explode("-", Input::get('date_start'));
		$startdate = $date_start[2] . '-' . $date_start[0] . '-' . $date_start[1];

		$date_end = explode("-", Input::get('date_end'));
		$enddate = $date_end[2] . '-' . $date_end[0] . '-' . $date_end[1];

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		DB::table('mytask_forcontact')->where('id', $id)->update(array(
              'contact_id' => $contact,
              'task_id' => $task,
              'amount' => $amount,
              'remarks' => $remarks,
              'date_start' => $startdate,
              'date_end' => $enddate,
              'created_by' => Auth::id(),
              'date_created' => date('Y-m-d'),
              'time_created' => $datetime_now));

		$delete_image = Input::get('delete_image');

		if(count($delete_image) > 0)
		{
			foreach($delete_image as $row)
			{
       			DB::table('attached_forcontact')->where('forcontact_id', $id)->where('file_img', $row)->delete();
				$destination_delPath = base_path() . '/public/asset/files/task_forcontact';
				File::delete($destination_delPath.'/'.$row);
			}
		}
			

		$filename = Input::file('image');

	    if(Input::hasFile('image'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('newtask.forcontact')
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
				$destinationPath = base_path() . '/public/asset/files/task_forcontact'; // upload path
				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $type = "1";
	            }else{
	              $type = "2";    
	            }

				DB::table('attached_forcontact')->insert(array([
	                  'type' => $type,
	                  'forcontact_id' => $id,
	                  'user_id' => Auth::id(),
	                  'status' => 1,
	                  'file_img' => $imgname,
	                  'date_created' => date('Y-m-d'),
	                  'time_created' => $datetime_now,
	            ]));

		   	}

		   }

		}
        return Redirect::route('create.mytask')
								->withInput()
								->with('class', 'success')
								->with('message', 'Your request was successfully updated.');
		}
			
	}

	public function newtask_forcontact_destroy($id)
	{
   	  DB::table('attached_forcontact')->where('forcontact_id', $id)->delete();	
      DB::table('mytask_forcontact')->where('id', $id)->delete();

	return Redirect::route('create.mytask')
					->with('class', 'success')
					->with('message', 'Your request was successfully removed.');
	}

	public function forcontact_details($id)
	{
		$pagetitle = 'Details of Task Request';

		$details = Task::select_forcontact_details($id);
		$getattached = DB::table('attached_forcontact')->where('forcontact_id', $id)->get();

		return View::make('task.mytaskforcontact_details', compact('pagetitle', 'details', 'getattached'));
	}
	//-------------------create task for company-----------------------//
	public function create_mytask_forcompany()
	{	
		$pagetitle = 'My Task for Company';

		if(Session::get('role') == 1)
		{
			 $mytask_forcompany = Task::select_allmytask_forcompany(Input::get('status',1),Input::get('s'));
		
		}else{
			
			 $mytask_forcompany = Task::select_mytask_forcompany(Input::get('status',1),Input::get('s'),Auth::id());

		} 

		return View::make('task.mytaskforcompany', compact('pagetitle','mytask_forcompany'));
	}

	public function newtask_forcompany()
	{
		$pagetitle = 'New Task for Company';

		$get_company = Company::where('status', '=', 2)->orderBy('company_name','asc')->lists('company_name', 'id');
		$get_task = Task::orderBy('task','asc')->lists('task', 'id');

		return View::make('task.create_taskforcompany',compact('pagetitle','get_company','get_task'));
	}

	public function newtask_forcompany_store()
	{
		$company = Input::get('company');
		$task = Input::get('task');
		$amount = Input::get('amount');
		$remarks = Input::get('remarks');

		if($company == "" || $task == "" || $amount == "" || $remarks == "" || Input::get('date_start') == "" || Input::get('date_end') == "")
		{
			return Redirect::route('newtask.forcompany')
									->withInput()
									->with('class', 'error')
									->with('message', 'Fill-up *required fields.');
		}else{

		$date_start = explode("-", Input::get('date_start'));
		$startdate = $date_start[2] . '-' . $date_start[0] . '-' . $date_start[1];

		$date_end = explode("-", Input::get('date_end'));
		$enddate = $date_end[2] . '-' . $date_end[0] . '-' . $date_end[1];

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		$forcompany = DB::table('mytask_forcompany')->insertGetId(array(
              'company_id' => $company,
              'task_id' => $task,
              'amount' => $amount,
              'remarks' => $remarks,
              'status' => 1,
              'date_start' => $startdate,
              'date_end' => $enddate,
              'created_by' => Auth::id(),
              'date_created' => date('Y-m-d'),
              'time_created' => $datetime_now));
	
        $filename = Input::file('image');

	    if(Input::hasFile('image'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('newtask.forcompany')
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
		
				$imgname = $img->getClientOriginalName();
				$destinationPath = base_path() . '/public/asset/files/task_forcompany'; // upload path
				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $type = "1";
	            }else{
	              $type = "2";    
	            }

				DB::table('attached_forcompany')->insert(array([
	                  'type' => $type,
	                  'forcompany_id' => $forcompany,
	                  'user_id' => Auth::id(),
	                  'status' => 1,
	                  'file_img' => $imgname,
	                  'date_created' => date('Y-m-d'),
	                  'time_created' => $datetime_now,
	            ]));
		   	}

		   }

		}

        return Redirect::route('create.mytask.company')
								->withInput()
								->with('class', 'success')
								->with('message', 'Your created request was successfully saved.');
		}
			
	}

	public function edittask_forcompany($id)
	{
		$pagetitle = 'Edit Task for Company';

		$get_company = Company::where('status', '=', 2)->orderBy('company_name','asc')->lists('company_name', 'id');
		$get_task = Task::orderBy('task','asc')->lists('task', 'id');
		$get_taskforcompany = DB::table('mytask_forcompany')->where('id', $id)->first();

		$getattached = DB::table('attached_forcompany')->where('forcompany_id', $id)->get();

		$my_company = Company::where('id', $get_taskforcompany->company_id)->first();
		$my_task = Task::where('id', $get_taskforcompany->task_id)->first();

		return View::make('task.edit_taskforcompany', compact('pagetitle', 'get_company', 'get_task', 'get_taskforcompany', 'my_company', 'my_task', 'getattached'));
	}

	public function newtask_forcompany_update($id)
	{
		$company = Input::get('company');
		$task = Input::get('task');
		$amount = Input::get('amount');
		$remarks = Input::get('remarks');

		if($company == "" || $task == "" || $amount == "" || $remarks == "" || Input::get('date_start') == "" || Input::get('date_end') == "")
		{
			return Redirect::route('task.forcompany.edit', $id)
									->withInput()
									->with('class', 'error')
									->with('message', 'Fill-up *required fields.');
		}else{

		$date_start = explode("-", Input::get('date_start'));
		$startdate = $date_start[2] . '-' . $date_start[0] . '-' . $date_start[1];

		$date_end = explode("-", Input::get('date_end'));
		$enddate = $date_end[2] . '-' . $date_end[0] . '-' . $date_end[1];

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		DB::table('mytask_forcompany')->where('id', $id)->update(array(
              'company_id' => $company,
              'task_id' => $task,
              'amount' => $amount,
              'remarks' => $remarks,
              'date_start' => $startdate,
              'date_end' => $enddate,
              'created_by' => Auth::id(),
              'date_created' => date('Y-m-d'),
              'time_created' => $datetime_now));

		$delete_image = Input::get('delete_image');

		if(count($delete_image) > 0)
		{
			foreach($delete_image as $row)
			{
       			DB::table('attached_forcompany')->where('forcompany_id', $id)->where('file_img', $row)->delete();
				$destination_delPath = base_path() . '/public/asset/files/task_forcompany';
				File::delete($destination_delPath.'/'.$row);
			}
		}
			

		$filename = Input::file('image');

	    if(Input::hasFile('image'))
	    {

	   $uploadcount = 0;

	   foreach($filename as $img)
	   {
    	
    	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

   	   	if(!in_array($img->getMimeType(), $mimeType)) 
	   	{
	   		return Redirect::route('newtask.forcompany')
						->withInput()
						->with('class', 'error')
						->with('message', 'Make sure that upload file is correct.');		
	   	}else{
			// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
    		$imgname = $img->getClientOriginalName();
			$destinationPath = base_path() . '/public/asset/files/task_forcompany'; // upload path
			$upload_success = $img->move($destinationPath, $imgname);

			if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
            {
              $type = "1";
            }else{
              $type = "2";    
            }

			DB::table('attached_forcompany')->insert(array([
                  'type' => $type,
                  'forcompany_id' => $id,
                  'user_id' => Auth::id(),
                  'status' => 1,
                  'file_img' => $imgname,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now,
            ]));

		   	}

		   }

		}
        return Redirect::route('create.mytask.company')
								->withInput()
								->with('class', 'success')
								->with('message', 'Your request was successfully updated.');
		}
			
	}

	public function newtask_forcompany_destroy($id)
	{
   	  DB::table('attached_forcompany')->where('forcompany_id', $id)->delete();	
      DB::table('mytask_forcompany')->where('id', $id)->delete();

	return Redirect::route('create.mytask.company')
					->with('class', 'success')
					->with('message', 'Your request was successfully removed.');
	}

	public function forcompany_details($id)
	{
		$pagetitle = 'Details of Task Request';

		$details = Task::select_forcompany_details($id);
		$getattached = DB::table('attached_forcompany')->where('forcompany_id', $id)->get();

		return View::make('task.mytaskforcompany_details', compact('pagetitle', 'details', 'getattached'));
	}
	//-------------------create task for project-----------------------//
	public function create_mytask_forproject()
	{	
		$pagetitle = 'My Task for Project';

		if(Session::get('role') == 1)
		{
			 $mytask_forproject = Task::select_allmytask_forproject(Input::get('status',1),Input::get('s'));
		
		}else{
			
			 $mytask_forproject = Task::select_mytask_forproject(Input::get('status',1),Input::get('s'),Auth::id());

		} 

		return View::make('task.mytaskforproject', compact('pagetitle','mytask_forproject'));
	}

	public function newtask_forproject()
	{
		$pagetitle = 'New Task for Project';

		$get_project = Project::where('status_forthread', '=', 1)->orderBy('project_name','asc')->lists('project_name', 'id');
		$get_task = Task::orderBy('task','asc')->lists('task', 'id');

		return View::make('task.create_taskforproject',compact('pagetitle','get_project','get_task'));
	}

	public function newtask_forproject_store()
	{
		$project = Input::get('project');
		$task = Input::get('task');
		$amount = Input::get('amount');
		$remarks = Input::get('remarks');

		if($project == "" || $task == "" || $amount == "" || $remarks == "" || Input::get('date_start') == "" || Input::get('date_end') == "")
		{
			return Redirect::route('newtask.forproject')
									->withInput()
									->with('class', 'error')
									->with('message', 'Fill-up *required fields.');
		}else{

		$date_start = explode("-", Input::get('date_start'));
		$startdate = $date_start[2] . '-' . $date_start[0] . '-' . $date_start[1];

		$date_end = explode("-", Input::get('date_end'));
		$enddate = $date_end[2] . '-' . $date_end[0] . '-' . $date_end[1];

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		$forproject = DB::table('mytask_forproject')->insertGetId(array(
              'project_id' => $project,
              'task_id' => $task,
              'amount' => $amount,
              'remarks' => $remarks,
              'status' => 1,
              'date_start' => $startdate,
              'date_end' => $enddate,
              'created_by' => Auth::id(),
              'date_created' => date('Y-m-d'),
              'time_created' => $datetime_now));

		$filename = Input::file('image');

	    if(Input::hasFile('image'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('newtask.forproject')
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
		
				$imgname = $img->getClientOriginalName();
				$destinationPath = base_path() . '/public/asset/files/task_forproject'; // upload path
				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $type = "1";
	            }else{
	              $type = "2";    
	            }

				DB::table('attached_forproject')->insert(array([
	                  'type' => $type,
	                  'forproject_id' => $forproject,
	                  'user_id' => Auth::id(),
	                  'status' => 1,
	                  'file_img' => $imgname,
	                  'date_created' => date('Y-m-d'),
	                  'time_created' => $datetime_now,
	            ]));
		   	}

		   }

		}

        return Redirect::route('create.mytask.project')
								->withInput()
								->with('class', 'success')
								->with('message', 'Your created request was successfully saved.');
		}
			
	}

	public function edittask_forproject($id)
	{
		$pagetitle = 'Edit Task for Project';

		$get_project = Project::where('status_forthread', '=', 1)->orderBy('project_name','asc')->lists('project_name', 'id');
		$get_task = Task::orderBy('task','asc')->lists('task', 'id');
		$get_taskforproject = DB::table('mytask_forproject')->where('id', $id)->first();

		$getattached = DB::table('attached_forproject')->where('forproject_id', $id)->get();

		$my_project = Project::where('id', $get_taskforproject->project_id)->first();
		$my_task = Task::where('id', $get_taskforproject->task_id)->first();

		return View::make('task.edit_taskforproject', compact('pagetitle', 'get_project', 'get_task', 'get_taskforproject', 'my_project', 'my_task', 'getattached'));
	}

	public function newtask_forproject_update($id)
	{
		$project = Input::get('project');
		$task = Input::get('task');
		$amount = Input::get('amount');
		$remarks = Input::get('remarks');

		if($project == "" || $task == "" || $amount == "" || $remarks == "" || Input::get('date_start') == "" || Input::get('date_end') == "")
		{
			return Redirect::route('task.forproject.edit', $id)
									->withInput()
									->with('class', 'error')
									->with('message', 'Fill-up *required fields.');
		}else{

		$date_start = explode("-", Input::get('date_start'));
		$startdate = $date_start[2] . '-' . $date_start[0] . '-' . $date_start[1];

		$date_end = explode("-", Input::get('date_end'));
		$enddate = $date_end[2] . '-' . $date_end[0] . '-' . $date_end[1];

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		DB::table('mytask_forproject')->where('id', $id)->update(array(
              'project_id' => $project,
              'task_id' => $task,
              'amount' => $amount,
              'remarks' => $remarks,
              'date_start' => $startdate,
              'date_end' => $enddate,
              'created_by' => Auth::id(),
              'date_created' => date('Y-m-d'),
              'time_created' => $datetime_now));

		$delete_image = Input::get('delete_image');

		if(count($delete_image) > 0)
		{
			foreach($delete_image as $row)
			{
       			DB::table('attached_forproject')->where('forproject_id', $id)->where('file_img', $row)->delete();
				$destination_delPath = base_path() . '/public/asset/files/task_forproject';
				File::delete($destination_delPath.'/'.$row);
			}
		}
			

		$filename = Input::file('image');

	    if(Input::hasFile('image'))
	    {

	   $uploadcount = 0;

	   foreach($filename as $img)
	   {
    	
    	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

   	   	if(!in_array($img->getMimeType(), $mimeType)) 
	   	{
	   		return Redirect::route('newtask.forproject')
						->withInput()
						->with('class', 'error')
						->with('message', 'Make sure that upload file is correct.');		
	   	}else{
			// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
    		$imgname = $img->getClientOriginalName();
			$destinationPath = base_path() . '/public/asset/files/task_forproject'; // upload path
			$upload_success = $img->move($destinationPath, $imgname);

			if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
            {
              $type = "1";
            }else{
              $type = "2";    
            }

			DB::table('attached_forproject')->insert(array([
                  'type' => $type,
                  'forproject_id' => $id,
                  'user_id' => Auth::id(),
                  'status' => 1,
                  'file_img' => $imgname,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now,
            ]));

	   		}

	   	  }

		}
        return Redirect::route('create.mytask.project')
								->withInput()
								->with('class', 'success')
								->with('message', 'Your request was successfully updated.');
		}
			
	}

	public function newtask_forproject_destroy($id)
	{
   	  DB::table('attached_forproject')->where('forproject_id', $id)->delete();	
      DB::table('mytask_forproject')->where('id', $id)->delete();

	return Redirect::route('create.mytask.project')
					->with('class', 'success')
					->with('message', 'Your request was successfully removed.');
	}

	public function forproject_details($id)
	{
		$pagetitle = 'Details of Task Request';

		$details = Task::select_forproject_details($id);
		$getattached = DB::table('attached_forproject')->where('forproject_id', $id)->get();

		return View::make('task.mytaskforproject_details', compact('pagetitle', 'details', 'getattached'));
	}
	//-------------------create task for ohers-----------------------//
	public function create_mytask_forothers()
	{	
		$pagetitle = 'My Task for Others';

		if(Session::get('role') == 1)
		{
			 $mytask_forothers = Task::select_allmytask_forothers(Input::get('status',1),Input::get('s'));
		
		}else{
			
			 $mytask_forothers = Task::select_mytask_forothers(Input::get('status',1),Input::get('s'),Auth::id());

		} 

		return View::make('task.mytaskforothers', compact('pagetitle','mytask_forothers'));
	}

	public function newtask_forothers()
	{
		$pagetitle = 'New Task for Others';

		$get_task = Task::orderBy('task','asc')->lists('task', 'id');

		return View::make('task.create_taskforothers',compact('pagetitle', 'get_task'));
	}

	public function newtask_forothers_store()
	{
		$task = Input::get('task');
		$amount = Input::get('amount');
		$remarks = Input::get('remarks');
		
		if($task == "" || $amount == "" || $remarks == "" || Input::get('date_start') == "" || Input::get('date_end') == "")
		{
			return Redirect::route('newtask.forothers')
									->withInput()
									->with('class', 'error')
									->with('message', 'Fill-up *required fields.');
		}else{

		$date_start = explode("-", Input::get('date_start'));
		$startdate = $date_start[2] . '-' . $date_start[0] . '-' . $date_start[1];

		$date_end = explode("-", Input::get('date_end'));
		$enddate = $date_end[2] . '-' . $date_end[0] . '-' . $date_end[1];

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		$forothers = DB::table('mytask_forothers')->insertGetId(array(
              'task_id' => $task,
              'amount' => $amount,
              'date_start' => $startdate,
              'date_end' => $enddate,
              'remarks' => $remarks,
              'status' => 1,
              'created_by' => Auth::id(),
              'date_created' => date('Y-m-d'),
              'time_created' => $datetime_now));

		$filename = Input::file('image');

	    if(Input::hasFile('image'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('newtask.forothers')
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
		
				$imgname = $img->getClientOriginalName();
				$destinationPath = base_path() . '/public/asset/files/task_forothers'; // upload path
				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $type = "1";
	            }else{
	              $type = "2";    
	            }

				DB::table('attached_forothers')->insert(array([
	                  'type' => $type,
	                  'forothers_id' => $forothers,
	                  'user_id' => Auth::id(),
	                  'status' => 1,
	                  'file_img' => $imgname,
	                  'date_created' => date('Y-m-d'),
	                  'time_created' => $datetime_now,
	            ]));
		   	}

		   }

		}
        return Redirect::route('create.mytask.others')
								->withInput()
								->with('class', 'success')
								->with('message', 'Your created request was successfully saved.');
		}
			
	}

	public function edittask_forothers($id)
	{
		$pagetitle = 'Edit Task for Others';

		$get_task = Task::orderBy('task','asc')->lists('task', 'id');
		$get_taskforothers = DB::table('mytask_forothers')->where('id', $id)->first();

		$getattached = DB::table('attached_forothers')->where('forothers_id', $id)->get();

		$my_task = Task::where('id', $get_taskforothers->task_id)->first();

		return View::make('task.edit_taskforothers', compact('pagetitle', 'get_task', 'get_taskforothers', 'my_task', 'getattached'));
	}

	public function newtask_forothers_update($id)
	{	
		$task = Input::get('task');
		$amount = Input::get('amount');
		$remarks = Input::get('remarks');

		if($task == "" || $amount == "" || $remarks == "" || Input::get('date_start') == "" || Input::get('date_end') == "")
		{
			return Redirect::route('task.forothers.edit', $id)
									->withInput()
									->with('class', 'error')
									->with('message', 'Fill-up *required fields.');
		}else{

		$date_start = explode("-", Input::get('date_start'));
		$startdate = $date_start[2] . '-' . $date_start[0] . '-' . $date_start[1];

		$date_end = explode("-", Input::get('date_end'));
		$enddate = $date_end[2] . '-' . $date_end[0] . '-' . $date_end[1];

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		DB::table('mytask_forothers')->where('id', $id)->update(array(
              'task_id' => $task,
              'amount' => $amount,
              'date_start' => $startdate,
              'date_end' => $enddate,
              'remarks' => $remarks,
              'created_by' => Auth::id(),
              'date_created' => date('Y-m-d'),
              'time_created' => $datetime_now));

		$delete_image = Input::get('delete_image');

		if(count($delete_image) > 0)
		{
			foreach($delete_image as $row)
			{
       			DB::table('attached_forothers')->where('forothers_id', $id)->where('file_img', $row)->delete();
				$destination_delPath = base_path() . '/public/asset/files/task_forothers';
				File::delete($destination_delPath.'/'.$row);
			}
		}
			

		$filename = Input::file('image');

	    if(Input::hasFile('image'))
	    {

	   $uploadcount = 0;

	   foreach($filename as $img)
	   {
    	
    	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

   	   	if(!in_array($img->getMimeType(), $mimeType)) 
	   	{
	   		return Redirect::route('newtask.forothers')
						->withInput()
						->with('class', 'error')
						->with('message', 'Make sure that upload file is correct.');		
	   	}else{
			// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
    		$imgname = $img->getClientOriginalName();
			$destinationPath = base_path() . '/public/asset/files/task_forothers'; // upload path
			$upload_success = $img->move($destinationPath, $imgname);

			if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
            {
              $type = "1";
            }else{
              $type = "2";    
            }

			DB::table('attached_forothers')->insert(array([
                  'type' => $type,
                  'forothers_id' => $id,
                  'user_id' => Auth::id(),
                  'status' => 1,
                  'file_img' => $imgname,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now,
            ]));

	   		}

	   	  }

		}
        return Redirect::route('create.mytask.others')
								->withInput()
								->with('class', 'success')
								->with('message', 'Your request was successfully updated.');
		}
			
	}

	public function newtask_forothers_destroy($id)
	{
   	  DB::table('attached_forothers')->where('forothers_id', $id)->delete();	
      DB::table('mytask_forothers')->where('id', $id)->delete();

		return Redirect::route('create.mytask.others')
						->with('class', 'success')
						->with('message', 'Your request was successfully removed.');
	}

	public function forothers_details($id)
	{
		$pagetitle = 'Details of Task Request';

		$details = Task::select_forothers_details($id);
		$getattached = DB::table('attached_forothers')->where('forothers_id', $id)->get();

		return View::make('task.mytaskforothers_details', compact('pagetitle', 'details', 'getattached'));
	}
	//--------------------- task request receiver contact----------------------..
	public function newtask_request_receiver_forcontact()
	{
		$pagetitle = 'Contact Task Request List/s';

		$task_request = Task::select_alltask_request_forcontact(Input::get('status',1),Input::get('s')); 
		$task_request_forcompany = Task::select_alltask_request_forcompany(Input::get('status',1),Input::get('s')); 

		return View::make('task.request_receiver_forcontact', compact('pagetitle','task_request','task_request_forcompany'));
	}

	public function newtask_request_receiver_forcontact_details($id)
	{
		$pagetitle = 'Details for Task Request';

		$details = Task::details_forcontact_request($id);
		$getattached = DB::table('attached_forcontact')->where('forcontact_id', $id)->get();

		$getthread = Task::getthread($id,2);

		return View::make('task.request_receiver_forcontact_details', compact('pagetitle', 'details', 'getattached', 'getthread'));
	}

	public function newtask_forcontact_approve()
	{

		$id = Input::get('task_hid');
		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

    	if(Input::get('a_remarks_hid') == "")
    	{
		return Redirect::route('task.request.forcontact.details', $id)
							->with('class', 'error')
							->with('message', 'Fill-up *required fields.');
    	}else{
    		DB::table('mytask_forcontact')->where('id', $id)->update(array('approved_request' => 1, 'approved_by' => Auth::id()));
		
			$threadid = DB::table('thread_forcontact')->insertGetId(array(
	                  'user_id' => Auth::id(),
	                  'forcontact_id' => $id,
	                  'thread' => strtoupper(Input::get('a_remarks_hid')),
	                  'status' => 2,
	                  'date_created' => date('Y-m-d'),
	                  'time_created' => $datetime_now));	
			
			$filename = Input::file('file_images');

		    if(Input::hasFile('file_images'))
		    {

			   $uploadcount = 0;

			   foreach($filename as $img)
			   {
	        	
	        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

		   	   	if(!in_array($img->getMimeType(), $mimeType)) 
			   	{
			   		return Redirect::route('newtask.forcontact')
								->withInput()
								->with('class', 'error')
								->with('message', 'Make sure that upload file is correct.');		
			   	}else{
					// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
	        		$imgname = $img->getClientOriginalName();
			
					if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
		            {
		              $destinationPath = base_path() . '/public/asset/img/forcontact-thread'; // upload path
		            }else{
		              $destinationPath = base_path() . '/public/asset/files/forcontact-thread'; // upload path    
		            }

					$upload_success = $img->move($destinationPath, $imgname);

					if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
		            {
			              DB::table('thread_forcontact_image')->insert(array([
			                  'user_id' => Auth::id(),
			                  'forcontact_id' => $id,
			                  'thread_id' => $threadid,
			                  'image' => $imgname,
			                  'datetime_created' => date('Y-m-d') . $datetime_now,
			            	]));

		            }else{
		              	 DB::table('thread_forcontact_file')->insert(array([
			                  'user_id' => Auth::id(),
			                  'forcontact_id' => $id,
			                  'thread_id' => $threadid,
			                  'filename' => $imgname,
			                  'datetime_created' => date('Y-m-d') . $datetime_now,
			            	]));	
		            }
			   	}

			   }

			}

			return Redirect::route('task.request.receiver.forcontact')
									->with('class', 'success')
									->with('message', 'Task requested was successfully approved.');
    	}
		
	
	}

	public function newtask_forcontact_approve_saveremarks()
	{
		$id = Input::get('task_hid');

		if(Input::get('remarks_thread') == "" || Input::get('remarks_thread') == "Write remarks here.")
    	{
		return Redirect::route('task.request.forcontact.details', $id)
								->with('class', 'error')
								->with('message', 'Fill-up *required fields.');
    	}else{

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		$threadid = DB::table('thread_forcontact')->insertGetId(array(
                  'user_id' => Auth::id(),
                  'forcontact_id' => $id,
                  'thread' => strtoupper(Input::get('remarks_thread')),
                  'status' => 2,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now));	
		
		$filename = Input::file('file_images');

	    if(Input::hasFile('file_images'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('task.request.forcontact.details', $id)
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
		
				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $destinationPath = base_path() . '/public/asset/img/forcontact-thread'; // upload path
	            }else{
	              $destinationPath = base_path() . '/public/asset/files/forcontact-thread'; // upload path    
	            }

				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
		              DB::table('thread_forcontact_image')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forcontact_id' => $id,
		                  'thread_id' => $threadid,
		                  'image' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));

	            }else{
	              	 DB::table('thread_forcontact_file')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forcontact_id' => $id,
		                  'thread_id' => $threadid,
		                  'filename' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));	
	            }
		   	}

		   }

		}

		if(Input::get('closed') == 1)
		{
			DB::table('mytask_forcontact')->where('id', $id)->update(array('status' => 2, 'approved_request' => 2));
			
			return Redirect::route('task.request.receiver.forcontact')
								->with('class', 'success')
								->with('message', 'Remarks successfully closed.');

		}else{			
			return Redirect::route('task.request.forcontact.details', $id)
								->with('class', 'success')
								->with('message', 'Remarks successfully posted.');

		}
	  }
	
	}

	public function newtask_forcontact_decline($id)
	{
		if(Input::get('remarks_hid') == "")
    	{
		return Redirect::route('task.request.forcontact.details', $id)
							->with('class', 'error')
							->with('message', 'Fill-up *required fields.');
    	}else{
			DB::table('mytask_forcontact')->where('id', $id)->update(array('status' => 3, 'approved_request' => 3, 'comments' => strtoupper(Input::get('remarks_hid')), 'approved_by' => Auth::id()));
			
			return Redirect::route('task.request.receiver.forcontact')
								->with('class', 'success')
								->with('message', 'Task requested was successfully denied.');
		}
	}

	//---------------------- task request receiver company----------------------
	public function newtask_request_receiver_forcompany()
	{
		$pagetitle = 'Company Task Request List/s';

		$task_request = Task::select_alltask_request_forcompany(Input::get('status',1),Input::get('s')); 
		$task_request_forcontact = Task::select_alltask_request_forcontact(Input::get('status',1),Input::get('s')); 

		return View::make('task.request_receiver_forcompany', compact('pagetitle','task_request', 'task_request_forcontact'));
	}

	public function newtask_request_receiver_forcompany_details($id)
	{
		$pagetitle = 'Details for Task Request';

		$details = Task::details_forcompany_request($id);
		$getattached = DB::table('attached_forcompany')->where('forcompany_id', $id)->get();

		$getthread = Task::getthread_forcompany($id,2);

		return View::make('task.request_receiver_forcompany_details', compact('pagetitle', 'details', 'getattached', 'getthread'));
	}

	public function newtask_forcompany_approve()
	{

		$id = Input::get('task_hid');
		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

    	if(Input::get('a_remarks_hid') == "")
    	{
		return Redirect::route('task.request.forcompany.details', $id)
							->with('class', 'error')
							->with('message', 'Fill-up *required fields.');
    	}else{

		DB::table('mytask_forcompany')->where('id', $id)->update(array('approved_request' => 1, 'approved_by' => Auth::id()));
		
		$threadid = DB::table('thread_forcompany')->insertGetId(array(
                  'user_id' => Auth::id(),
                  'forcompany_id' => $id,
                  'thread' => strtoupper(Input::get('a_remarks_hid')),
                  'status' => 2,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now));	
		
		$filename = Input::file('file_images');

	    if(Input::hasFile('file_images'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('newtask.forcompany')
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
		
				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $destinationPath = base_path() . '/public/asset/img/forcompany-thread'; // upload path
	            }else{
	              $destinationPath = base_path() . '/public/asset/files/forcompany-thread'; // upload path    
	            }

				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
		              DB::table('thread_forcompany_image')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forcompany_id' => $id,
		                  'thread_id' => $threadid,
		                  'image' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));

	            }else{
	              	 DB::table('thread_forcompany_file')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forcompany_id' => $id,
		                  'thread_id' => $threadid,
		                  'filename' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));	
	            }
		   	}

		   }

		}

		return Redirect::route('task.request.receiver.forcompany')
								->with('class', 'success')
								->with('message', 'Task requested was successfully approved.');

		}						
	
	}

	public function newtask_forcompany_approve_saveremarks()
	{

		$id = Input::get('task_hid');
		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

    	if(Input::get('remarks_thread') == "" || Input::get('remarks_thread') == "Write remarks here.")
    	{
		return Redirect::route('task.request.forcompany.details', $id)
							->with('class', 'error')
							->with('message', 'Fill-up *required fields.');
    	}else{

		$threadid = DB::table('thread_forcompany')->insertGetId(array(
                  'user_id' => Auth::id(),
                  'forcompany_id' => $id,
                  'thread' => strtoupper(Input::get('remarks_thread')),
                  'status' => 2,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now));	
		
		$filename = Input::file('file_images');

	    if(Input::hasFile('file_images'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('task.request.forcompany.details', $id)
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
		
				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $destinationPath = base_path() . '/public/asset/img/forcompany-thread'; // upload path
	            }else{
	              $destinationPath = base_path() . '/public/asset/files/forcompany-thread'; // upload path    
	            }

				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
		              DB::table('thread_forcompany_image')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forcompany_id' => $id,
		                  'thread_id' => $threadid,
		                  'image' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));

	            }else{
	              	 DB::table('thread_forcompany_file')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forcompany_id' => $id,
		                  'thread_id' => $threadid,
		                  'filename' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));	
	            }
		   	}

		   }

			}

			if(Input::get('closed') == 1)
			{
				DB::table('mytask_forcompany')->where('id', $id)->update(array('status' => 2, 'approved_request' => 2));
				
				return Redirect::route('task.request.receiver.forcompany')
									->with('class', 'success')
									->with('message', 'Remarks successfully closed.');

			}else{			
				return Redirect::route('task.request.forcompany.details', $id)
									->with('class', 'success')
									->with('message', 'Remarks successfully posted.');
			}

		}
	
	}

	public function newtask_forcompany_decline($id)
	{	
		if(Input::get('a_remarks_hid') == "")
    	{
		return Redirect::route('task.request.forcompany.details', $id)
							->with('class', 'error')
							->with('message', 'Fill-up *required fields.');
    	}else{
		DB::table('mytask_forcompany')->where('id', $id)->update(array('status' => 3, 'approved_request' => 3, 'comments' => strtoupper(Input::get('remarks_hid')), 'approved_by' => Auth::id()));
		
		return Redirect::route('task.request.receiver.forcompany')
								->with('class', 'success')
								->with('message', 'Task requested was successfully denied.');
		}

	}

	//---------------------- task request receiver project----------------------
	public function newtask_request_receiver_forproject()
	{
		$pagetitle = 'Project Task Request List/s';

		$task_request = Task::select_alltask_request_forproject(Input::get('status',1),Input::get('s')); 
		$task_request_forcontact = Task::select_alltask_request_forcontact(Input::get('status',1),Input::get('s')); 

		return View::make('task.request_receiver_forproject', compact('pagetitle','task_request', 'task_request_forcontact'));
	}

	public function newtask_request_receiver_forproject_details($id)
	{
		$pagetitle = 'Details for Task Request';

		$details = Task::details_forproject_request($id);
		$getattached = DB::table('attached_forproject')->where('forproject_id', $id)->get();

		$getthread = Task::getthread_forproject($id,2);

		return View::make('task.request_receiver_forproject_details', compact('pagetitle', 'details', 'getattached', 'getthread'));
	}

	public function newtask_forproject_approve()
	{

		$id = Input::get('task_hid');
		
		if(Input::get('a_remarks_hid') == "")
    	{
		return Redirect::route('task.request.forproject.details', $id)
							->with('class', 'error')
							->with('message', 'Fill-up *required fields.');
    	}else{

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		DB::table('mytask_forproject')->where('id', $id)->update(array('approved_request' => 1, 'approved_by' => Auth::id()));
		
		$threadid = DB::table('thread_forproject')->insertGetId(array(
                  'user_id' => Auth::id(),
                  'forproject_id' => $id,
                  'thread' => strtoupper(Input::get('a_remarks_hid')),
                  'status' => 2,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now));	
		
		$filename = Input::file('file_images');

	    if(Input::hasFile('file_images'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('newtask.forproject')
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
		
				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $destinationPath = base_path() . '/public/asset/img/forproject-thread'; // upload path
	            }else{
	              $destinationPath = base_path() . '/public/asset/files/forproject-thread'; // upload path    
	            }

				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
		              DB::table('thread_forproject_image')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forproject_id' => $id,
		                  'thread_id' => $threadid,
		                  'image' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));

	            }else{
	              	 DB::table('thread_forproject_file')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forproject_id' => $id,
		                  'thread_id' => $threadid,
		                  'filename' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));	
	            }
		   	}

		   }

		}

		return Redirect::route('task.request.receiver.forproject')
								->with('class', 'success')
								->with('message', 'Task requested was successfully approved.');
	
		}
	}

	public function newtask_forproject_approve_saveremarks()
	{

		$id = Input::get('task_hid');

		if(Input::get('remarks_thread') == "" || Input::get('remarks_thread') == "Write remarks here.")
    	{
		return Redirect::route('task.request.forproject.details', $id)
							->with('class', 'error')
							->with('message', 'Fill-up *required fields.');
    	}else{

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		$threadid = DB::table('thread_forproject')->insertGetId(array(
                  'user_id' => Auth::id(),
                  'forproject_id' => $id,
                  'thread' => strtoupper(Input::get('remarks_thread')),
                  'status' => 2,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now));	
		
		$filename = Input::file('file_images');

	    if(Input::hasFile('file_images'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('task.request.forproject.details', $id)
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
		
				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $destinationPath = base_path() . '/public/asset/img/forproject-thread'; // upload path
	            }else{
	              $destinationPath = base_path() . '/public/asset/files/forproject-thread'; // upload path    
	            }

				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
		              DB::table('thread_forproject_image')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forproject_id' => $id,
		                  'thread_id' => $threadid,
		                  'image' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));

	            }else{
	              	 DB::table('thread_forproject_file')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forproject_id' => $id,
		                  'thread_id' => $threadid,
		                  'filename' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));	
	            }
		   	}

		   }

		}
			if(Input::get('closed') == 1)
			{
				DB::table('mytask_forproject')->where('id', $id)->update(array('status' => 2, 'approved_request' => 2));
				
				return Redirect::route('task.request.receiver.forproject')
									->with('class', 'success')
									->with('message', 'Remarks successfully closed.');

			}else{			
				return Redirect::route('task.request.forproject.details', $id)
									->with('class', 'success')
									->with('message', 'Remarks successfully posted.');

			}
		
		}
	}

	public function newtask_forproject_decline($id)
	{
		if(Input::get('a_remarks_hid') == "")
    	{
		return Redirect::route('task.request.forproject.details', $id)
							->with('class', 'error')
							->with('message', 'Fill-up *required fields.');
    	}else{
		
		DB::table('mytask_forproject')->where('id', $id)->update(array('status' => 3, 'approved_request' => 3, 'comments' => strtoupper(Input::get('remarks_hid')), 'approved_by' => Auth::id()));
		
		return Redirect::route('task.request.receiver.forproject')
								->with('class', 'success')
								->with('message', 'Task requested was successfully denied.');
		}

	}
	//--------------------- task request receiver others----------------------..
	public function newtask_request_receiver_forothers()
	{
		$pagetitle = 'Others Task Request List/s';

		$task_request = Task::select_alltask_request_forothers(Input::get('status',1),Input::get('s')); 
		$task_request_forcompany = Task::select_alltask_request_forcompany(Input::get('status',1),Input::get('s')); 

		return View::make('task.request_receiver_forothers', compact('pagetitle','task_request','task_request_forcompany'));
	}

	public function newtask_request_receiver_forothers_details($id)
	{
		$pagetitle = 'Details for Task Request';

		$details = Task::details_forothers_request($id);
		$getattached = DB::table('attached_forothers')->where('forothers_id', $id)->get();

		$getthread = Task::getthread_forothers($id,2);

		return View::make('task.request_receiver_forothers_details', compact('pagetitle', 'details', 'getattached', 'getthread'));
	}

	public function newtask_forothers_approve()
	{

		$id = Input::get('task_hid');

		if(Input::get('a_remarks_hid') == "")
    	{
		return Redirect::route('task.request.forothers.details', $id)
							->with('class', 'error')
							->with('message', 'Fill-up *required fields.');
    	}else{

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		DB::table('mytask_forothers')->where('id', $id)->update(array('approved_request' => 1, 'approved_by' => Auth::id()));
		
		$threadid = DB::table('thread_forothers')->insertGetId(array(
                  'user_id' => Auth::id(),
                  'forothers_id' => $id,
                  'thread' => strtoupper(Input::get('a_remarks_hid')),
                  'status' => 2,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now));	
		
		$filename = Input::file('file_images');

	    if(Input::hasFile('file_images'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('newtask.forothers')
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
		
				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $destinationPath = base_path() . '/public/asset/img/forothers-thread'; // upload path
	            }else{
	              $destinationPath = base_path() . '/public/asset/files/forothers-thread'; // upload path    
	            }

				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
		              DB::table('thread_forothers_image')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forothers_id' => $id,
		                  'thread_id' => $threadid,
		                  'image' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));

	            }else{
	              	 DB::table('thread_forothers_file')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forothers_id' => $id,
		                  'thread_id' => $threadid,
		                  'filename' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));	
	            }
		   	}

		   }

		}
		return Redirect::route('task.request.receiver.forothers')
								->with('class', 'success')
								->with('message', 'Task requested was successfully approved.');
	
		}
	}

	public function newtask_forothers_approve_saveremarks()
	{

		$id = Input::get('task_hid');

		if(Input::get('remarks_thread') == "" || Input::get('remarks_thread') == "Write remarks here.")
    	{
		return Redirect::route('task.request.forothers.details', $id)
							->with('class', 'error')
							->with('message', 'Fill-up *required fields.');
    	}else{

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

		$threadid = DB::table('thread_forothers')->insertGetId(array(
                  'user_id' => Auth::id(),
                  'forothers_id' => $id,
                  'thread' => strtoupper(Input::get('remarks_thread')),
                  'status' => 2,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now));	
		
		$filename = Input::file('file_images');

	    if(Input::hasFile('file_images'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('task.request.forothers.details', $id)
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
		
				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $destinationPath = base_path() . '/public/asset/img/forothers-thread'; // upload path
	            }else{
	              $destinationPath = base_path() . '/public/asset/files/forothers-thread'; // upload path    
	            }

				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
		              DB::table('thread_forothers_image')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forothers_id' => $id,
		                  'thread_id' => $threadid,
		                  'image' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));

	            }else{
	              	 DB::table('thread_forothers_file')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forothers_id' => $id,
		                  'thread_id' => $threadid,
		                  'filename' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));	
	            }
		   	}

		   }

		}
			if(Input::get('closed') == 1)
			{
				DB::table('mytask_forothers')->where('id', $id)->update(array('status' => 2, 'approved_request' => 2));
				
				return Redirect::route('task.request.receiver.forothers')
									->with('class', 'success')
									->with('message', 'Remarks successfully closed.');

			}else{			
				return Redirect::route('task.request.forothers.details', $id)
									->with('class', 'success')
									->with('message', 'Remarks successfully posted.');

			}

		}
	
	}

	public function newtask_forothers_decline($id)
	{
		if(Input::get('a_remarks_hid') == "")
    	{
		return Redirect::route('task.request.forothers.details', $id)
							->with('class', 'error')
							->with('message', 'Fill-up *required fields.');
    	}else{

		DB::table('mytask_forothers')->where('id', $id)->update(array('status' => 3, 'approved_request' => 3, 'comments' => strtoupper(Input::get('remarks_hid')), 'approved_by' => Auth::id()));
		
		return Redirect::route('task.request.receiver.forothers')
								->with('class', 'success')
								->with('message', 'Task requested was successfully denied.');
		}

	}
	//--------------------- task request approver contact----------------------..
	public function newtask_request_approver_forcontact()
	{
		$pagetitle = 'Contact Task Request List/s';

		$task_request = Task::select_alltask_approver_forcontact(Input::get('status',1),Input::get('s')); 

		return View::make('task.request_approver_forcontact', compact('pagetitle','task_request','task_request_forcompany'));
	}

	public function newtask_request_approver_forcontact_details($id)
	{
		$pagetitle = 'Details for Task Request';

		$details = Task::details_forcontact_request($id);
		$getattached = DB::table('attached_forcontact')->where('forcontact_id', $id)->get();

		$getthread = Task::getthread($id,2);

		return View::make('task.request_approver_forcontact_details', compact('pagetitle', 'details', 'getattached', 'getthread'));
	}

	public function newtask_forcontact_approver_saveremarks()
	{
		$id = Input::get('task_hid');

		if(Input::get('remarks_thread') == "" || Input::get('remarks_thread') == "Write remarks here.")
    	{
		return Redirect::route('task.approver.forcontact.details', $id)
								->with('class', 'error')
								->with('message', 'Fill-up *required fields.');
    	}else{

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

    	if(Input::get(('closed')) == 1)
    	{
    		$closed = 1;
    	}else{
    		$closed = 0;
    	}

		$threadid = DB::table('thread_forcontact')->insertGetId(array(
                  'user_id' => Auth::id(),
                  'forcontact_id' => $id,
                  'thread' => strtoupper(Input::get('remarks_thread')),
                  'closed' => $closed,
                  'status' => 2,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now));	
		
		DB::table('mytask_forcontact')->where('id', $id)->update(array('final_amount' => Input::get('amount')));

		$filename = Input::file('file_images');

	    if(Input::hasFile('file_images'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('task.request.forcontact.details', $id)
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
		
				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $destinationPath = base_path() . '/public/asset/img/forcontact-thread'; // upload path
	            }else{
	              $destinationPath = base_path() . '/public/asset/files/forcontact-thread'; // upload path    
	            }

				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
		              DB::table('thread_forcontact_image')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forcontact_id' => $id,
		                  'thread_id' => $threadid,
		                  'image' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));

	            }else{
	              	 DB::table('thread_forcontact_file')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forcontact_id' => $id,
		                  'thread_id' => $threadid,
		                  'filename' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));	
	            }
		   	}

		   }

		}
			if(Input::get('closed') == 1)
			{
				return Redirect::route('task.request.approver.forcontact')
								->with('class', 'success')
								->with('message', 'Remarks successfully closed.');
			}else{			
				return Redirect::route('task.approver.forcontact.details', $id)
								->with('class', 'success')
								->with('message', 'Remarks successfully posted.');
			}

		}	
	
	}
	//--------------------- task request approver company----------------------..
	public function newtask_request_approver_forcompany()
	{
		$pagetitle = 'Company Task Request List/s';

		$task_request = Task::select_alltask_approver_forcompany(Input::get('status',1),Input::get('s')); 

		return View::make('task.request_approver_forcompany', compact('pagetitle','task_request','task_request_forcompany'));
	}

	public function newtask_request_approver_forcompany_details($id)
	{
		$pagetitle = 'Details for Task Request';

		$details = Task::details_forcompany_request($id);
		$getattached = DB::table('attached_forcompany')->where('forcompany_id', $id)->get();

		$getthread = Task::getthread_forcompany($id,2);

		return View::make('task.request_approver_forcompany_details', compact('pagetitle', 'details', 'getattached', 'getthread'));
	}

	public function newtask_forcompany_approver_saveremarks()
	{

		$id = Input::get('task_hid');

		if(Input::get('remarks_thread') == "" || Input::get('remarks_thread') == "Write remarks here.")
    	{
		return Redirect::route('task.approver.forcompany.details', $id)
								->with('class', 'error')
								->with('message', 'Fill-up *required fields.');
    	}else{

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

    	if(Input::get(('closed')) == 1)
    	{
    		$closed = 1;
    	}else{
    		$closed = 0;
    	}

		$threadid = DB::table('thread_forcompany')->insertGetId(array(
                  'user_id' => Auth::id(),
                  'forcompany_id' => $id,
                  'thread' => strtoupper(Input::get('remarks_thread')),
                  'closed' => $closed,
                  'status' => 2,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now));	
		
		DB::table('mytask_forcompany')->where('id', $id)->update(array('final_amount' => Input::get('amount')));

		$filename = Input::file('file_images');

	    if(Input::hasFile('file_images'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('task.request.forcompany.details', $id)
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
		
				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $destinationPath = base_path() . '/public/asset/img/forcompany-thread'; // upload path
	            }else{
	              $destinationPath = base_path() . '/public/asset/files/forcompany-thread'; // upload path    
	            }

				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
		              DB::table('thread_forcompany_image')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forcompany_id' => $id,
		                  'thread_id' => $threadid,
		                  'image' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));

	            }else{
	              	 DB::table('thread_forcompany_file')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forcompany_id' => $id,
		                  'thread_id' => $threadid,
		                  'filename' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));	
	            }
		   	}

		   }

		}
			if(Input::get('closed') == 1)
			{
				return Redirect::route('task.request.approver.forcompany')
								->with('class', 'success')
								->with('message', 'Remarks successfully closed.');
			}else{			
				return Redirect::route('task.approver.forcompany.details', $id)
								->with('class', 'success')
								->with('message', 'Remarks successfully posted.');
			}
		
		}

	}
	//--------------------- task request approver project----------------------..
	public function newtask_request_approver_forproject()
	{
		$pagetitle = 'Project Task Request List/s';

		$task_request = Task::select_alltask_approver_forproject(Input::get('status',1),Input::get('s')); 

		return View::make('task.request_approver_forproject', compact('pagetitle','task_request','task_request_forcompany'));
	}

	public function newtask_request_approver_forproject_details($id)
	{
		$pagetitle = 'Details for Task Request';

		$details = Task::details_forproject_request($id);
		$getattached = DB::table('attached_forproject')->where('forproject_id', $id)->get();

		$getthread = Task::getthread_forproject($id,2);

		return View::make('task.request_approver_forproject_details', compact('pagetitle', 'details', 'getattached', 'getthread'));
	}

	public function newtask_forproject_approver_saveremarks()
	{

		$id = Input::get('task_hid');

		if(Input::get('remarks_thread') == "" || Input::get('remarks_thread') == "Write remarks here.")
    	{
		return Redirect::route('task.approver.forproject.details', $id)
								->with('class', 'error')
								->with('message', 'Fill-up *required fields.');
    	}else{

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

    	if(Input::get(('closed')) == 1)
    	{
    		$closed = 1;
    	}else{
    		$closed = 0;
    	}

		$threadid = DB::table('thread_forproject')->insertGetId(array(
                  'user_id' => Auth::id(),
                  'forproject_id' => $id,
                  'thread' => strtoupper(Input::get('remarks_thread')),
                  'closed' => $closed,
                  'status' => 2,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now));	
		
		DB::table('mytask_forproject')->where('id', $id)->update(array('final_amount' => Input::get('amount')));

		$filename = Input::file('file_images');

	    if(Input::hasFile('file_images'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('task.request.forproject.details', $id)
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
		
				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $destinationPath = base_path() . '/public/asset/img/forproject-thread'; // upload path
	            }else{
	              $destinationPath = base_path() . '/public/asset/files/forproject-thread'; // upload path    
	            }

				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
		              DB::table('thread_forproject_image')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forproject_id' => $id,
		                  'thread_id' => $threadid,
		                  'image' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));

	            }else{
	              	 DB::table('thread_forproject_file')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forproject_id' => $id,
		                  'thread_id' => $threadid,
		                  'filename' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));	
	            }
		   	}

		   }

		}
			if(Input::get('closed') == 1)
			{
				return Redirect::route('task.request.approver.forproject')
								->with('class', 'success')
								->with('message', 'Remarks successfully closed.');
			}else{			
				return Redirect::route('task.approver.forproject.details', $id)
								->with('class', 'success')
								->with('message', 'Remarks successfully posted.');
			}
		}	
	
	}
	//--------------------- task request approver others----------------------..
	public function newtask_request_approver_forothers()
	{
		$pagetitle = 'Others Task Request List/s';

		$task_request = Task::select_alltask_approver_forothers(Input::get('status',1),Input::get('s')); 

		return View::make('task.request_approver_forothers', compact('pagetitle','task_request','task_request_forcompany'));
	}

	public function newtask_request_approver_forothers_details($id)
	{
		$pagetitle = 'Details for Task Request';

		$details = Task::details_forothers_request($id);
		$getattached = DB::table('attached_forothers')->where('forothers_id', $id)->get();

		$getthread = Task::getthread_forothers($id,2);

		return View::make('task.request_approver_forothers_details', compact('pagetitle', 'details', 'getattached', 'getthread'));
	}

	public function newtask_forothers_approver_saveremarks()
	{

		$id = Input::get('task_hid');

		if(Input::get('remarks_thread') == "" || Input::get('remarks_thread') == "Write remarks here.")
    	{
		return Redirect::route('task.approver.forothers.details', $id)
								->with('class', 'error')
								->with('message', 'Fill-up *required fields.');
    	}else{

		$gettime = time() - 14400;
    	$datetime_now = date("H:i:s", $gettime);

    	if(Input::get(('closed')) == 1)
    	{
    		$closed = 1;
    	}else{
    		$closed = 0;
    	}

		$threadid = DB::table('thread_forothers')->insertGetId(array(
                  'user_id' => Auth::id(),
                  'forothers_id' => $id,
                  'thread' => strtoupper(Input::get('remarks_thread')),
                  'closed' => $closed,
                  'status' => 2,
                  'date_created' => date('Y-m-d'),
                  'time_created' => $datetime_now));	
		
		DB::table('mytask_forothers')->where('id', $id)->update(array('final_amount' => Input::get('amount')));

		$filename = Input::file('file_images');

	    if(Input::hasFile('file_images'))
	    {

		   $uploadcount = 0;

		   foreach($filename as $img)
		   {
        	
        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		return Redirect::route('task.request.forothers.details', $id)
							->withInput()
							->with('class', 'error')
							->with('message', 'Make sure that upload file is correct.');		
		   	}else{
				// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        		$imgname = $img->getClientOriginalName();
		
				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
	              $destinationPath = base_path() . '/public/asset/img/forothers-thread'; // upload path
	            }else{
	              $destinationPath = base_path() . '/public/asset/files/forothers-thread'; // upload path    
	            }

				$upload_success = $img->move($destinationPath, $imgname);

				if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	            {
		              DB::table('thread_forothers_image')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forothers_id' => $id,
		                  'thread_id' => $threadid,
		                  'image' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));

	            }else{
	              	 DB::table('thread_forothers_file')->insert(array([
		                  'user_id' => Auth::id(),
		                  'forothers_id' => $id,
		                  'thread_id' => $threadid,
		                  'filename' => $imgname,
		                  'datetime_created' => date('Y-m-d') . $datetime_now,
		            	]));	
	            }
		   	}

		   }

		}
			if(Input::get('closed') == 1)
			{
				return Redirect::route('task.request.approver.forothers')
								->with('class', 'success')
								->with('message', 'Remarks successfully closed.');
			}else{			
				return Redirect::route('task.approver.forothers.details', $id)
								->with('class', 'success')
								->with('message', 'Remarks successfully posted.');
			}
	
		}

	}


}