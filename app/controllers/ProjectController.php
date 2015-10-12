<?php

class ProjectController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /project
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'My Project List';
		Input::flash();

		if(Input::get('status') > 1)
		{
			if(Input::get('s') != '')
			{
				DB::table('projects')->where('project_name', Input::get('s'))->update(array('notif' => 2));
			}

			if(Session::get('role') == 1 || Session::get('role') == 2)
			{
				$projects = Project::select_projects_all(Input::get('status', 1),Input::get('s'),Auth::id());
				$projects->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();		
        $project_stats = DB::table('project_status')->orderBy('id', 'desc')->get();

			}else{
				$projects = Project::select_projects(Auth::id(),Input::get('status', 1),Input::get('s'),Auth::id());
				$projects->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();			
			  $project_stats = DB::table('project_status')->where('created_by', Auth::id())->orderBy('id', 'desc')->get();

      }

			return View::make('projects.index', compact('pagetitle','projects','project_stats'));

		}else{	
			
			if(Session::get('role') == 1 || Session::get('role') == 2)
			{
				$projects = Project::select_projects_all(Input::get('status', 1),Input::get('s'),Auth::id());
				$projects->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();		
		    $project_stats = DB::table('project_status')->orderBy('id', 'desc')->get();

    	}else{
				$projects = Project::select_projects(Auth::id(),Input::get('status', 1),Input::get('s'),Auth::id());
				$projects->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();			
			  $project_stats = DB::table('project_status')->where('created_by', Auth::id())->orderBy('id', 'desc')->get();
      }

			// $company_status = DB::table('company_status')->get();
			return View::make('projects.index', compact('pagetitle','projects','project_stats'));

		}

		// $projects = Project::select_projects(Input::get('status', 1),Input::get('s'),Auth::id());
		// return View::make('projects.index', compact('pagetitle', 'projects'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /project/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = 'Create Project';

		$project_id = Project::selectprojectid();
		$bdo = Project::selectbdo_list();

		$developer = Project::select_developer_forcompany();
		$sub_developer = Project::select_developer_forindiv();
		$gencon = Project::select_gencon_forcompany();
		$sub_gencon = Project::select_gencon_forindiv();
		$proj_mngrdesigner = Project::select_project_managerdesigner_forcompany();
		$sub_proj_mngrdesigner = Project::select_project_managerdesigner_forindiv();
		$architect = Project::select_architect_forcompany();
		$sub_architect = Project::select_architect_forindiv();
		$applicator = Project::select_applicator();
		$sub_applicator = Project::select_sub_applicator();
		$dealersupplier = Project::select_dealersupplier();
		$sub_dealersupplier = Project::select_sub_dealersupplier();

		$recordlist = Project::select_contactandcompany_list();
		
		$classification = Project::select_projclassification_list();
		$category = Project::select_projcategory_list();
		$stage = Project::select_projstage_list();
		$status = Project::select_projstatus_list();

		$cities = City::selectCity();
		$provinces = Province::selectProvince_forproject();
		return View::make('projects.create', compact('pagetitle', 'project_id', 'bdo', 'developer', 'sub_developer', 'gencon', 'sub_gencon', 'proj_mngrdesigner', 'sub_proj_mngrdesigner', 'architect', 'sub_architect', 'applicator', 'sub_applicator', 'dealersupplier', 'sub_dealersupplier', 'recordlist', 'classification', 'category', 'stage', 'status', 'cities', 'provinces'));
	}

	public function getarea()
	{
		$bdo_id = Input::get('bdo_id');

		$area_list = Project::select_arealist($bdo_id);
		$data = array();
		
		foreach($area_list as $row)
		{
			$data[] = array(
				'id' => $row->area_id,
				'name' => $row->area,
				);
			
		}
		return Response::json($data,200);
	
	}
	/**
	 * Store a newly created resource in storage.
	 * POST /project
	 *
	 * @return Response
	 */
	public function store()
	{
		// Input::merge(array_map('trim', Input::all()));
		 $input = Input::all();

      	 $validation = Validator::make($input, Project::$rules);

   //    	 if(Input::get('project_classification') == '0' || Input::get('project_category') == '0' || Input::get('project_stage') == '0')
		 // {
		 // 	return Redirect::route('project.create')
			// 					->withInput()
			// 					->withErrors($validation)
			// 					->with('class', 'warning')
			// 					->with('message', 'Fill-up project classification, project category & project stage.');
		 // }

      	 $developer = Input::get('developer');
      	 $sub_developer = Input::get('sub_developer');
      	 $general_contractor = Input::get('general_contractor');
      	 $sub_general_contractor = Input::get('sub_general_contractor');
      	 $project_mgr_designer = Input::get('project_mgr_designer');
      	 $sub_project_mgr_designer = Input::get('sub_project_mgr_designer');
      	 $architect = Input::get('architect');
      	 $sub_architect = Input::get('sub_architect');
      	 $applicator = Input::get('applicator');
      	 $sub_applicator = Input::get('sub_applicator');
      	 $dealer_supplier = Input::get('dealer_supplier');
      	 $sub_dealer_supplier = Input::get('sub_dealer_supplier');

         $gettime = time() - 14400;
         $datetime_now = date("H:i:s", $gettime);

      	 if($validation->passes())
      	 {

      	 	$project = new Project();
      	 	$project->date_reported = date("Y-m-d", strtotime(Input::get('date_reported')));
          $project->project_photos = Input::get('project_photos');
      	 	$project->bdo_id = Input::get('bdo');
      	 	$project->area_id = Input::get('area_region');
      	 	$project->project_name = strtoupper(Input::get('project_name'));
      	 	$project->project_owner = strtoupper(Input::get('project_owner'));
      	 	$project->street = strtoupper(Input::get('street'));
      	 	$project->city = Input::get('city');
          $project->province = Input::get('province');
      	 	$project->country = strtoupper(Input::get('country'));
          $project->zip_code = Input::get('zip_code');

      	 	$project->project_classification = Input::get('project_classification');
      	 	$project->project_category = Input::get('project_category');
      	 	$project->project_stage = Input::get('project_stage');
      	 	$project->project_status = Input::get('project_status');
      	 	$project->project_details = strtoupper(Input::get('project_details'));
      	 	$project->painting_dtstart = Input::get('painting_dtstart');
      	 	$project->painting_dtend = Input::get('painting_dtend');
      	 	
      	 	$project->painting_specification = Input::get('painting_specification1', 'N/A');
      	 	$project->paints = strtoupper(Input::get('paint'));
          $project->area = strtoupper(Input::get('area_sqm'));
          $project->painting_requirement = strtoupper(Input::get('painting_req'));
          $project->painting_cost = strtoupper(Input::get('painting_cost'));

          $project->painting_specification_2 = Input::get('painting_specification2', 'N/A');
      	 	$project->paints2 = strtoupper(Input::get('2nd_paint'));
          $project->area2 = strtoupper(Input::get('2nd_area_sqm'));
          $project->painting_requirement2 = strtoupper(Input::get('2nd_painting_req'));
          $project->painting_cost2 = strtoupper(Input::get('2nd_painting_cost'));

          $project->painting_specification_3 = Input::get('painting_specification3', 'N/A');
          $project->paints3 = strtoupper(Input::get('3rd_paint'));
          $project->area3 = strtoupper(Input::get('3rd_area_sqm'));
          $project->painting_requirement3 = strtoupper(Input::get('3rd_painting_req'));
          $project->painting_cost3 = strtoupper(Input::get('3rd_painting_cost'));

      	 	$project->status = 1;

      	 	$project->created_by = Auth::id();
			    $project->approved_by = 0;

    			if(Project::checkifexist($project)){
    				return Redirect::route('project.create')
    								->withInput()
    								->withErrors($validation)
    								->with('class', 'warning')
    								->with('message', 'Record already exist.');

    			}

    			$project->save();
          DB::table('project_users')->insert(array([
              'created_by' => Auth::id(),
              'user_id' => Input::get('bdo'),
              'project_id' => $project->id,
              'status' => 1,
          ]));    

        if(count($developer)>0)
        {
         foreach($developer as $dev_row)
         {
              DB::table('developer')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'developer_id' => $dev_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $dev_bdo_id = DB::table('contacts')->select('created_by')->where('id', $dev_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $dev_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }
              
        }

        if(count($sub_developer)>0)
        {
         foreach($sub_developer as $sub_dev_row)
         {
              DB::table('sub_developer')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_developer_id' => $sub_dev_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_dev_row = DB::table('contacts')->select('created_by')->where('id', $sub_dev_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_dev_row->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }
              
        }

        if(count($general_contractor)>0)
        {
         foreach($general_contractor as $gencon_row)
         {
              DB::table('gencon')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'gencon_id' => $gencon_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $gencon_bdo_id = DB::table('contacts')->select('created_by')->where('id', $gencon_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $gencon_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }
              
        }

        if(count($sub_general_contractor)>0)
        {
         foreach($sub_general_contractor as $sub_gencon_row)
         {
              DB::table('sub_gencon')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_gencon_id' => $sub_gencon_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_gencon_bdo_id = DB::table('contacts')->select('created_by')->where('id', $sub_gencon_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_gencon_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }
              
        }

        if(count($project_mgr_designer)>0)
        {
         foreach($project_mgr_designer as $projmgrdes_row)
         {
              DB::table('project_mgr_designer')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'project_mgr_designer_id' => $projmgrdes_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $projmgrdes_bdo_id = DB::table('contacts')->select('created_by')->where('id', $projmgrdes_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $projmgrdes_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }
              
        }

        if(count($sub_project_mgr_designer)>0)
        {
         foreach($sub_project_mgr_designer as $sub_projmgrdes_row)
         {
              DB::table('sub_project_mgr_designer')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_project_mgr_designer_id' => $sub_projmgrdes_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_projmgrdes_bdo_id = DB::table('contacts')->select('created_by')->where('id', $sub_projmgrdes_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_projmgrdes_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }
              
        }

        if(count($architect)>0)
        {
         foreach($architect as $arch_row)
         {
              DB::table('architect')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'architect_id' => $arch_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $arch_bdo_id = DB::table('contacts')->select('created_by')->where('id', $arch_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $arch_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }
              
        }

        if(count($sub_architect)>0)
        {
         foreach($sub_architect as $sub_arch_row)
         {
              DB::table('sub_architect')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_architect_id' => $sub_arch_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_arch_bdo_id = DB::table('contacts')->select('created_by')->where('id', $sub_arch_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_arch_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }
              
        }

        if(count($applicator)>0)
        {
         foreach($applicator as $app_row)
         {
              DB::table('applicator')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'applicator_id' => $app_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $app_bdo_id = DB::table('contacts')->select('created_by')->where('id', $app_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $app_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }
              
        }    

        if(count($sub_applicator)>0)
        {
         foreach($sub_applicator as $sub_app_row)
         {
              DB::table('sub_applicator')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_applicator_id' => $sub_app_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_app_bdo_id = DB::table('contacts')->select('created_by')->where('id', $sub_app_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_app_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }
              
        }

       if(count($dealer_supplier)>0)
        {
         foreach($dealer_supplier as $dealsupp_row)
         {
              DB::table('dealer_supplier')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'dealer_supplier_id' => $dealsupp_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $dealsupp_bdo_id = DB::table('contacts')->select('created_by')->where('id', $dealsupp_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $dealsupp_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }      
        
        }

       if(count($sub_dealer_supplier)>0)
        {
         foreach($sub_dealer_supplier as $sub_dealsupp_row)
         {
              DB::table('sub_dealer_supplier')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_dealer_supplier_id' => $sub_dealsupp_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_dealsupp_bdo_id = DB::table('contacts')->select('created_by')->where('id', $sub_dealsupp_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_dealsupp_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => 1,
              ]));

         }
              
        }

		    $imagename = Input::file('image');
		    $imagestatus = Input::get('photo_files_type');
		    $img_count = count($imagename);
		    // $project_id = $project->id;
		    // $id = Auth::id();

		    if(Input::hasFile('image'))
		    {

			   $uploadcount = 0;

			   foreach($imagename as $img)
			   {
	        	
	        	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

		   	   	$imgname = $img->getClientOriginalName();

			   	if(!in_array($img->getMimeType(), $mimeType)) 
			   	{	
			   	  DB::table('projects')->where('id', '=', $project->id)->delete();
	    			DB::table('project_users')->where('project_id', '=', $project->id)->delete();
	    			DB::table('project_images')->where('project_id', '=', $project->id)->delete();
	    			DB::table('project_files')->where('project_id', '=', $project->id)->delete();
            DB::table('developer')->where('project_id', '=', $project->id)->delete();
            DB::table('sub_developer')->where('project_id', '=', $project->id)->delete();
            DB::table('gencon')->where('project_id', '=', $project->id)->delete();
            DB::table('sub_gencon')->where('project_id', '=', $project->id)->delete();
            DB::table('project_mgr_designer')->where('project_id', '=', $project->id)->delete();
            DB::table('sub_project_mgr_designer')->where('project_id', '=', $project->id)->delete();
            DB::table('architect')->where('project_id', '=', $project->id)->delete();
            DB::table('sub_architect')->where('project_id', '=', $project->id)->delete();
            DB::table('applicator')->where('project_id', '=', $project->id)->delete();
            DB::table('sub_applicator')->where('project_id', '=', $project->id)->delete();
            DB::table('dealer_supplier')->where('project_id', '=', $project->id)->delete();
            DB::table('sub_dealer_supplier')->where('project_id', '=', $project->id)->delete();

            // $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            $delete_imgname = $img->getClientOriginalName();

            if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
            {
              $destinationPath = base_path() . '/public/asset/img/project'; // upload path
            }else{
              $destinationPath = base_path() . '/public/asset/files/project'; // upload path               
            }

            File::delete($destinationPath.'/'.$delete_imgname);
                                                      
			   		return Redirect::route('project.create')
								->withInput()
								->withErrors($validation)
								->with('class', 'error')
								->with('message', 'Make sure that upload file is correct.');	

        		}else{
        			// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
	        		$imgname = $img->getClientOriginalName();

	        		if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	        		{
	        			$destinationPath = base_path() . '/public/asset/img/project'; // upload path
	        		}else{
						    $destinationPath = base_path() . '/public/asset/files/project'; // upload path	        			
	        		}

	        		$upload_success = $img->move($destinationPath, $imgname);
	        		
	        		if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	        		{
            			DB::table('project_images')->insert(
				    		array('user_id' => Auth::id(),
				     	  	'project_id' => $project->id,
				     	  	'image' => $imgname,
				     	  	'status' => 1,
				     	  )
						);

					}else{
						DB::table('project_files')->insert(
				    		array('user_id' => Auth::id(),
				     	  	'project_id' => $project->id,
				     	  	'file' => $imgname,
				     	  	'status' => 1,
				     	  )
						);

					}

	        	}

	        	$uploadcount ++;
			      
			   }
		    	

		    }

                  DB::table('project_status')->insert(array([
                              'project_id' => $project->id,
                              'user_id' => Auth::id(),
                              'update' => 'CREATE' . ' ' . strtoupper(Input::get('project_name')) . ' ' . 'IN PROJECT RECORD',
                              'created_by' => Auth::id(),
                              'created_at' => date('Y-m-d') . ' ' . $datetime_now,
                        ]));

			return Redirect::route('project.index')
								->with('class', 'success')
								->with('message', 'Record successfully created.');

      	 }else{
      	 	return Redirect::route('project.create')
								->withInput()
								->withErrors($validation)
								->with('class', 'error')
								->with('message', 'There were validation errors.');

      	 }


	}

	/**
	 * Display the specified resource.
	 * GET /project/{id}
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
	 * GET /project/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = 'Update Project';

		$project_detail = Project::select_projectdetails($id);

		$mybdo = DB::table('assigned_areas')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, assigned_areas.user_id'))
					->join('users', 'users.id', '=', 'assigned_areas.user_id')
					->where('assigned_areas.user_id', $project_detail->bdo_id)
					->first();

		$myarea = DB::table('areas')->where('id', $project_detail->area_id)->first();
		
		$bdo = Project::selectbdo_list();

		// $recordlist = Project::select_contactandcompany_list();
		$classification = Project::select_projclassification_list();
		$category = Project::select_projcategory_list();
		$stage = Project::select_projstage_list();
		
		$my_projectstatus = DB::table('statuses')->where('id', $project_detail->project_status)->first();
		if(count($my_projectstatus)>0)
		{
			$projectstatus_id = $my_projectstatus->id; 
			$projectstatus = $my_projectstatus->status; 
			
		}else{

			$projectstatus_id = '';
			$projectstatus = 'CHOOSE PROJECT STATUS HERE';

		}

		$status = Project::select_projstatus_list();

		$cities = Project::get_city($id);

		// if($project_detail->developer != 0)
		// {
		// 	$project_detail_dev = DB::table('contacts')->select('category')->where('id', $project_detail->developer)->first();
		// 	if($project_detail_dev->category == 1)
		// 	{
		// 		$dev = Project::get_developer($project_detail);
			
		// 	}else{
		// 		$dev = Project::get_developer_ind($project_detail);

		// 	}
		// 	$bdo_dev = DB::table('project_users')->where('project_id', $id)->where('user_id', $dev->id)->first();

		// }	

		// if($project_detail->general_contractor != 0)
		// {
		// 	$project_detail_gencon = DB::table('contacts')->select('category')->where('id', $project_detail->general_contractor)->first();
		// 	if($project_detail_gencon->category == 1)
		// 	{
		// 		$gencon = Project::get_generalcontractor($project_detail);
			
		// 	}else{
		// 		$gencon = Project::get_generalcontractor_ind($project_detail);	
			
		// 	}
		// 	$bdo_gencon = DB::table('project_users')->where('project_id', $id)->where('user_id', $gencon->id)->first();

		// }
		
		// if($project_detail->project_mgr_designer != 0)
		// {
		// 	$project_detail_projmgrdesigner = DB::table('contacts')->select('category')->where('id', $project_detail->project_mgr_designer)->first();
		// 	if($project_detail_projmgrdesigner->category == 1)
		// 	{
		// 		$projmgrdes = Project::get_projectmgrdesigner($project_detail);
			
		// 	}else{
		// 		$projmgrdes = Project::get_projectmgrdesigner_ind($project_detail);

		// 	}
		// 	$bdo_projmgrdes = DB::table('project_users')->where('project_id', $id)->where('user_id', $projmgrdes->id)->first();

		// }
		
		// if($project_detail->architect != 0)
		// {
		// 	$project_detail_architect = DB::table('contacts')->select('category')->where('id', $project_detail->architect)->first();
		// 	if($project_detail_architect->category == 1)
		// 	{
		// 		$arch = Project::get_architect($project_detail);
			
		// 	}else{
		// 		$arch = Project::get_architect_ind($project_detail);

		// 	}
		// 	$bdo_arch = DB::table('project_users')->where('project_id', $id)->where('user_id', $arch->id)->first();
		
		// }
			
		// if($project_detail->applicator != 0)
		// {
		// 	$project_detail_applicator = DB::table('contacts')->select('category')->where('id', $project_detail->applicator)->first();
		// 	if($project_detail_applicator->category == 1)
		// 	{
		// 		$app = Project::get_applicator($project_detail);
			
		// 	}else{
		// 		$app = Project::get_applicator_ind($project_detail);

		// 	}
		// 	$bdo_app = DB::table('project_users')->where('project_id', $id)->where('user_id', $app->id)->first();

		// }
		
		// if($project_detail->dealer_supplier != 0)
		// {
		// 	$project_detail_dealersupplier = DB::table('contacts')->select('category')->where('id', $project_detail->dealer_supplier)->first();
		// 	if($project_detail_dealersupplier->category == 1)
		// 	{
		// 		$dealsupp = Project::get_dealersupplier($project_detail);

		// 	}else{
		// 		$dealsupp = Project::get_dealersupplier_ind($project_detail);

		// 	}
		// 	$bdo_dealsupp = DB::table('project_users')->where('project_id', $id)->where('user_id', $dealsupp->id)->first();

		// }
		

		// $developers = Project::select_developer();
		// $gencons = Project::select_gencon();
		// $proj_mngrdesigners = Project::select_project_managerdesigner();
		// $architects = Project::select_architect();
		// $applicators = Project::select_applicator();
		// $dealersuppliers = Project::select_dealersupplier();
            
    $dev = Project::get_developer($id);
    $sub_dev = Project::get_sub_developer($id);
    $gencons = Project::get_generalcontractor($id);
    $sub_gencons = Project::get_sub_generalcontractor($id);
    $projmgrdes = Project::get_projectmgrdesigner($id);
    $sub_projmgrdes = Project::get_sub_projectmgrdesigner($id);
    $arch = Project::get_architect($id);
    $sub_arch = Project::get_sub_architect($id);
    $app = Project::get_applicator($id);
    $sub_app = Project::get_sub_applicator($id);
    $dealsupp = Project::get_dealersupplier($id);
    $sub_dealsupp = Project::get_sub_dealersupplier($id);

    $developer = Project::select_developer_forcompany();
    $sub_developer = Project::select_developer_forindiv();
    $gencon = Project::select_gencon_forcompany();
    $sub_gencon = Project::select_gencon_forindiv();
    $proj_mngrdesigner = Project::select_project_managerdesigner_forcompany();
    $sub_proj_mngrdesigner = Project::select_project_managerdesigner_forindiv();
    $architect = Project::select_architect_forcompany();
    $sub_architect = Project::select_architect_forindiv();
    $applicator = Project::select_applicator();
    $sub_applicator = Project::select_sub_applicator();
    $dealersupplier = Project::select_dealersupplier();
    $sub_dealersupplier = Project::select_sub_dealersupplier();

		$cities = City::selectCity();
		$mycity = DB::table('cities')->where('id', $project_detail->city)->where('id', '>', '0')->first();

		$provinces = Province::selectProvince();
            $myprovince = DB::table('provinces')->where('id', $project_detail->province)->where('id', '>', '0')->first();

		$projimg = DB::table('project_images')->where('project_id', $id)->get();
		$projfiles = DB::table('project_files')->where('project_id', $id)->get();

		return View::make('projects.edit', compact('pagetitle', 'project_detail', 'mybdo', 'bdo', 'myarea', 'mydeveloper', 'classification', 'category', 'stage', 'status', 'developer', 'sub_developer', 'gencon', 'sub_gencon', 'proj_mngrdesigner', 'sub_proj_mngrdesigner', 'architect', 'sub_architect', 'applicator', 'sub_applicator', 'dealersupplier', 'sub_dealersupplier', 'dev', 'sub_dev', 'gencons', 'sub_gencons', 'projmgrdes', 'sub_projmgrdes', 'arch', 'sub_arch', 'app', 'sub_app', 'dealsupp', 'sub_dealsupp', 'projimg', 'projfiles', 'mycity', 'cities', 'provinces', 'myprovince', 'projectstatus_id', 'projectstatus'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /project/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$input = Input::all();

    $validation = Validator::make($input, Project::$updaterules);

  //     	if(Input::get('project_classification') == '0' || Input::get('project_category') == '0' || Input::get('project_stage') == '0')
		// {
		//  	return Redirect::route('project.edit', $id)
		// 						->withInput()
		// 						->withErrors($validation)
		// 						->with('class', 'warning')
		// 						->with('message', 'Fill-up all dropdown lists.');
		// }

   $developer = Input::get('developer');
   $sub_developer = Input::get('sub_developer');
   $general_contractor = Input::get('general_contractor');
   $sub_general_contractor = Input::get('sub_general_contractor');
   $project_mgr_designer = Input::get('project_mgr_designer');
   $sub_project_mgr_designer = Input::get('sub_project_mgr_designer');
   $architect = Input::get('architect');
   $sub_architect = Input::get('sub_architect');
   $applicator = Input::get('applicator');
   $sub_applicator = Input::get('sub_applicator');
   $dealer_supplier = Input::get('dealer_supplier');
   $sub_dealer_supplier = Input::get('sub_dealer_supplier');

   $gettime = time() - 14400;
   $datetime_now = date("H:i:s", $gettime);

	if($validation->passes())
	{

	 	$project = Project::find($id);

		if(is_null($project))
		{
		return Redirect::route('projects.index')
							->withInput()
							->withErrors($validation)
							->with('class', 'warning')
							->with('message', 'Project information does not exist.');
		}

	 	$project->date_reported = date("Y-m-d", strtotime(Input::get('date_reported')));
    $project->project_photos = Input::get('project_photos');
	 	$project->bdo_id = Input::get('bdo');
	 	$project->area_id = Input::get('area');
	 	$project->project_name = strtoupper(Input::get('project_name'));
	 	$project->project_owner = strtoupper(Input::get('project_owner'));
	 	
    $project->street = strtoupper(Input::get('street'));
    $project->city = Input::get('city');
    $project->province = Input::get('province');
    $project->country = strtoupper(Input::get('country'));
    $project->zip_code = Input::get('zip_code');

	 	$project->project_classification = Input::get('project_classification');
	 	$project->project_category = Input::get('project_category');
	 	$project->project_stage = Input::get('project_stage');
	 	$project->project_status = Input::get('project_status');
	 	$project->project_details = strtoupper(Input::get('project_details'));
	 	$project->painting_dtstart = Input::get('painting_dtstart');
	 	$project->painting_dtend = Input::get('painting_dtend');
    
    $project->painting_specification = Input::get('painting_specification1', 'N/A');
    $project->paints = strtoupper(Input::get('paint'));
    $project->area = strtoupper(Input::get('area_sqm'));
    $project->painting_requirement = strtoupper(Input::get('painting_req'));
    $project->painting_cost = strtoupper(Input::get('painting_cost'));

    $project->painting_specification_2 = Input::get('painting_specification2', 'N/A');
    $project->paints2 = strtoupper(Input::get('2nd_paint'));
    $project->area2 = strtoupper(Input::get('2nd_area_sqm'));
    $project->painting_requirement2 = strtoupper(Input::get('2nd_painting_req'));
    $project->painting_cost2 = strtoupper(Input::get('2nd_painting_cost'));

    $project->painting_specification_3 = Input::get('painting_specification3', 'N/A');
    $project->paints3 = strtoupper(Input::get('3rd_paint'));
    $project->area3 = strtoupper(Input::get('3rd_area_sqm'));
    $project->painting_requirement3 = strtoupper(Input::get('3rd_painting_req'));
    $project->painting_cost3 = strtoupper(Input::get('3rd_painting_cost'));

    $project->status = 1;

    $project_information = DB::table('projects')
                 ->select('projects.*','projects.status as current_stats', 'users.first_name', 'users.last_name', 'areas.area_place', 'classifications.classification', 'categories.category', 'stages.stage', 'cities.city', 'provinces.province')
                 ->join('cities', 'cities.id', '=', 'projects.city')
                 ->join('provinces', 'provinces.id', '=', 'projects.province')
                 ->join('users', 'users.id', '=', 'projects.bdo_id')
                 ->join('areas', 'areas.id', '=', 'projects.area_id')
                 ->join('classifications', 'classifications.id', '=', 'projects.project_classification')
                 ->join('categories', 'categories.id', '=', 'projects.project_category')
                 ->join('stages', 'stages.id', '=', 'projects.project_stage')
                 ->where('projects.id', $id)
                 ->first();
    $bdoname = DB::table('users')->where('id', Input::get('bdo'))->first();
    $areaname = DB::table('areas')->where('id', Input::get('area'))->first();
    $cityname = DB::table('cities')->where('id', Input::get('city'))->first();
    $classifname = DB::table('classifications')->where('id', Input::get('project_classification'))->first();
    $categoryname = DB::table('categories')->where('id', Input::get('project_category'))->first();
    $stagename = DB::table('stages')->where('id', Input::get('project_stage'))->first();

    if(Project::where('date_reported', date("Y-m-d", strtotime(Input::get('date_reported'))))->where('id', $id)->count() > 0)
    {
      $datereported = "";
    }else{
      $datereported = "REPORTED DATE : " . date("m-d-Y", strtotime($project_information->date_reported)) . " INTO " . strtoupper(Input::get('date_reported')) . ", ";
    }
    if(Project::where('bdo_id', Input::get('bdo'))->where('id', $id)->count() > 0)
    {
      $bdo_name = "";
    }else{
      $bdo_name = "ASSIGNED BDO : " . $project_information->first_name . ' ' . $project_information->last_name . " INTO " . strtoupper($bdoname->first_name) . ' ' . strtoupper($bdoname->last_name) . ", ";
    }
    if(Project::where('area_id', Input::get('area'))->where('id', $id)->count() > 0)
    {
      $areaplace = "";
    }else{
      $areaplace = "AREA PLACE : " . $project_information->area_place . " INTO " . strtoupper($areaname->area_place) . ", ";
    }
    if(Project::where('project_name', strtoupper(Input::get('project_name')))->where('id', $id)->count() > 0)
    {
      $projectname = "";
    }else{
      $projectname = "PROJECT NAME : " . $project_information->project_name . " INTO " . strtoupper(Input::get('project_name')) . ", ";
    }
    if(Project::where('project_owner', strtoupper(Input::get('project_owner')))->where('id', $id)->count() > 0)
    {
      $projectowner = "";
    }else{
      $projectowner = "PROJECT OWNER : " . $project_information->project_owner . " INTO " . strtoupper(Input::get('project_owner')) . ", ";
    }
    if(Project::where('street', strtoupper(Input::get('street')))->where('city', Input::get('city'))->where('province', Input::get('province'))->where('country', strtoupper(Input::get('country')))->where('zip_code', Input::get('zip_code'))->where('id', $id)->count() > 0)
    {
      $projectstreet = "";
    }else{
      $projectstreet = "PROJECT STREET : " . $project_information->street . ' ' . $project_information->city . ', ' . $project_information->country . ' ' . $project_information->zip_code . " INTO " . strtoupper(Input::get('street')) . ' ' . strtoupper($cityname->city) . ', ' . strtoupper(Input::get('country')) . ' ' . Input::get('zip_code') .  ", ";
    }
    if(Project::where('project_classification', Input::get('project_classification'))->where('id', $id)->count() > 0)
    {
      $projectclassif = "";
    }else{
      $projectclassif = "PROJECT CLASSIFICATION : " . $project_information->classification . " INTO " . strtoupper($classifname->classification) . ", ";
    }
    if(Project::where('project_category', Input::get('project_category'))->where('id', $id)->count() > 0)
    {
      $projectcategory = "";
    }else{
      $projectcategory = "PROJECT CATEGORY : " . $project_information->category . " INTO " . strtoupper($categoryname->category) . ", ";
    }
    if(Project::where('project_stage', Input::get('project_stage'))->where('id', $id)->count() > 0)
    {
      $projectstage = "";
    }else{
      $projectstage = "PROJECT STAGE : " . $project_information->stage . " INTO " . strtoupper($stagename->stage) . ", ";
    }
    if(Project::where('project_details', Input::get('project_details'))->where('id', $id)->count() > 0)
    {
      $projectdetails = "";
    }else{
      $projectdetails = "PROJECT DETAILS : " . $project_information->project_details . " INTO " . strtoupper(Input::get('project_details')) . ", ";
    }
    if(Project::where('painting_dtstart', date("Y-m-d", strtotime(Input::get('painting_dtstart'))))->where('id', $id)->count() > 0)
    {
      $projectdtstart = "";
    }else{
      $projectdtstart = "PAINTING DATE-START : " . date("m-d-Y", strtotime($project_information->painting_dtstart)) . " INTO " . Input::get('painting_dtstart') . ", ";
    }
    if(Project::where('painting_dtend', date("Y-m-d", strtotime(Input::get('painting_dtend'))))->where('id', $id)->count() > 0)
    {
      $projectdtend = "";
    }else{
      $projectdtend = "PAINTING DATE-END : " . date("m-d-Y", strtotime($project_information->painting_dtend)) . " INTO " . Input::get('painting_dtend') . ", ";
    }
    if(Project::where('painting_specification', strtoupper(Input::get('painting_specification1', 'N/A')))->where('id', $id)->count() > 0)
    {
      $projectspec1 = "";
    }else{
      $projectspec1 = "PAINTING SPECIFICATION : " . $project_information->painting_specification . " INTO " . strtoupper(Input::get('painting_specification1', 'N/A')) . ", ";
    }
    if(Project::where('paints', strtoupper(Input::get('paint')))->where('id', $id)->count() > 0)
    {
      $projectpaint1 = "";
    }else{
      $projectpaint1 = "EXTERIOR PAINT : " . $project_information->paints . " INTO " . strtoupper(Input::get('paint')) . ", ";
    }
    if(Project::where('area', strtoupper(Input::get('area_sqm')))->where('id', $id)->count() > 0)
    {
      $projectarea_sqm1 = "";
    }else{
      $projectarea_sqm1 = "EXTERIOR AREA(SQM) : " . $project_information->area . " INTO " . strtoupper(Input::get('area_sqm')) . ", ";
    }
    if(Project::where('painting_requirement', strtoupper(Input::get('painting_req')))->where('id', $id)->count() > 0)
    {
      $projectpainting_req1 = "";
    }else{
      $projectpainting_req1 = "EXTERIOR PAINTING REQUIREMENT(LTRS) : " . $project_information->painting_requirement . " INTO " . strtoupper(Input::get('painting_req')) . ", ";
    }
    if(Project::where('painting_cost', strtoupper(Input::get('painting_cost')))->where('id', $id)->count() > 0)
    {
      $projectpainting_cost1 = "";
    }else{
      $projectpainting_cost1 = "EXTERIOR PAINTING COST(PHP) : " . $project_information->painting_cost . " INTO " . strtoupper(Input::get('painting_cost')) . ", ";
    }
    if(Project::where('painting_specification_2', strtoupper(Input::get('painting_specification2', 'N/A')))->where('id', $id)->count() > 0)
    {
      $projectspec2 = "";
    }else{
      $projectspec2 = "2ND PAINTING SPECIFICATION : " . $project_information->painting_specification_2 . " INTO " . strtoupper(Input::get('painting_specification2', 'N/A')) . ", ";
    }
    if(Project::where('paints2', strtoupper(Input::get('2nd_paint')))->where('id', $id)->count() > 0)
    {
      $projectpaint2 = "";
    }else{
      $projectpaint2 = "INTERIOR PAINT : " . $project_information->paints2 . " INTO " . strtoupper(Input::get('2nd_paint')) . ", ";
    }
    if(Project::where('area2', strtoupper(Input::get('2nd_area_sqm')))->where('id', $id)->count() > 0)
    {
      $projectarea_sqm2 = "";
    }else{
      $projectarea_sqm2 = "INTERIOR AREA(SQM) : " . $project_information->area2 . " INTO " . strtoupper(Input::get('2nd_area_sqm')) . ", ";
    }
    if(Project::where('painting_requirement2', strtoupper(Input::get('2nd_painting_req')))->where('id', $id)->count() > 0)
    {
      $projectpainting_req2 = "";
    }else{
      $projectpainting_req2 = "INTERIOR PAINTING REQUIREMENT(LTRS) : " . $project_information->painting_requirement2 . " INTO " . strtoupper(Input::get('2nd_painting_req')) . ", ";
    }
    if(Project::where('painting_cost2', strtoupper(Input::get('2nd_painting_cost')))->where('id', $id)->count() > 0)
    {
      $projectpainting_cost2 = "";
    }else{
      $projectpainting_cost2 = "INTERIOR PAINTING COST(PHP) : " . $project_information->painting_cost2 . " INTO " . strtoupper(Input::get('2nd_painting_cost')) . ", ";
    }
    if(Project::where('painting_specification_3', strtoupper(Input::get('painting_specification3', 'N/A')))->where('id', $id)->count() > 0)
    {
      $projectspec3 = "";
    }else{
      $projectspec3 = "3RD PAINTING SPECIFICATION : " . $project_information->painting_specification_3 . " INTO " . strtoupper(Input::get('painting_specification3', 'N/A')) . ", ";
    }
    if(Project::where('paints3', strtoupper(Input::get('3rd_paint')))->where('id', $id)->count() > 0)
    {
      $projectpaint3 = "";
    }else{
      $projectpaint3 = "OTHERS PAINT : " . $project_information->paints3 . " INTO " . strtoupper(Input::get('3rd_paint')) . ", ";
    }
    if(Project::where('area3', strtoupper(Input::get('3rd_area_sqm')))->where('id', $id)->count() > 0)
    {
      $projectarea_sqm3 = "";
    }else{
      $projectarea_sqm3 = "OTHERS AREA(SQM) : " . $project_information->area3 . " INTO " . strtoupper(Input::get('3rd_area_sqm')) . ", ";
    }
    if(Project::where('painting_requirement3', strtoupper(Input::get('3rd_painting_req')))->where('id', $id)->count() > 0)
    {
      $projectpainting_req3 = "";
    }else{
      $projectpainting_req3 = "OTHERS PAINTING REQUIREMENT(LTRS) : " . $project_information->painting_requirement3 . " INTO " . strtoupper(Input::get('3rd_painting_req')) . ", ";
    }
    if(Project::where('painting_cost3', strtoupper(Input::get('3rd_painting_cost')))->where('id', $id)->count() > 0)
    {
      $projectpainting_cost3 = "";
    }else{
      $projectpainting_cost3 = "OTHERS PAINTING COST(PHP) : " . $project_information->painting_cost3 . " INTO " . strtoupper(Input::get('3rd_painting_cost')) . ", ";
    }

    if($datereported != "" || $bdo_name != "" || $areaplace != "" || $projectname != "" || $projectowner != "" || $projectstreet != "" || $projectclassif != "" || $projectcategory != "" || $projectstage != "" || $projectdetails != "" || $projectdtstart != "" || $projectdtend != "")
    {
     DB::table('project_status')->insert(array([
        'project_id' => $id,
        'user_id' => Auth::id(),
        'update' => 'CHANGE ' . $project_information->project_name . ' IN PROJECT RECORD ' . ' | ' . $datereported . $bdo_name . $areaplace . $projectname . $projectowner . $projectstreet . $projectclassif . $projectcategory . $projectstage . $projectdetails . $projectdtstart . $projectdtend . $projectspec1 . $projectpaint1 . $projectarea_sqm1 . $projectpainting_cost1 . $projectspec2 . $projectpaint2 . $projectarea_sqm2 . $projectpainting_cost2 . $projectspec3 . $projectpaint3 . $projectarea_sqm3 . $projectpainting_cost3,
        'created_by' => Auth::id(),
        'created_at' => date('Y-m-d') . $datetime_now,
        'access' => 1,
      ]));
    }
    
    $count_olddev = DB::table('developer')->where('project_id', $id)->count();
    $count_oldsubdev = DB::table('sub_developer')->where('project_id', $id)->count();
    $count_oldgencon = DB::table('gencon')->where('project_id', $id)->count();
    $count_oldsubgencon = DB::table('sub_gencon')->where('project_id', $id)->count();
    $count_oldprojmgrdes = DB::table('project_mgr_designer')->where('project_id', $id)->count();
    $count_oldsubprojmgrdes = DB::table('sub_project_mgr_designer')->where('project_id', $id)->count();
    $count_oldarch = DB::table('architect')->where('project_id', $id)->count();
    $count_oldsubarch = DB::table('sub_architect')->where('project_id', $id)->count();
    $count_oldapp = DB::table('applicator')->where('project_id', $id)->count();
    $count_oldsubapp = DB::table('sub_applicator')->where('project_id', $id)->count();
    $count_olddealsupp = DB::table('dealer_supplier')->where('project_id', $id)->count();
    $count_oldsubdealsupp = DB::table('sub_dealer_supplier')->where('project_id', $id)->count();

    if(count($developer) == $count_olddev)
        {
          $newdev = "";
        }else{
          $newdev = "DEVELOPER(IN-COMPANY), ";
        }
        if(count($sub_developer) == $count_oldsubdev)
        {
          $newsubdev = "";
        }else{
          $newsubdev = "DEVELOPER(INDIVIDUAL), ";
        }
        if(count($general_contractor) == $count_oldgencon)
        {
          $newgencon = "";
        }else{
          $newgencon = "GENERAL CONTRACTOR(IN-COMPANY), ";
        }
        if(count($sub_general_contractor) == $count_oldsubgencon)
        {
          $newsubgencon = "";
        }else{
          $newsubgencon = "SUB-GENERAL CONTRACTOR(INDIVIDUAL), ";
        }
        if(count($project_mgr_designer) == $count_oldprojmgrdes)
        {
          $newprojmgrdes = "";
        }else{
          $newprojmgrdes = "PROJECT MANAGER/ DESIGNER(IN-COMPANY), ";
        }
        if(count($sub_project_mgr_designer) == $count_oldsubprojmgrdes)
        {
          $newsubprojmgrdes = "";
        }else{
          $newsubprojmgrdes = "SUB-PROJECT MANAGER/ DESIGNER(INDIVIDUAL), ";
        }
        if(count($architect) == $count_oldarch)
        {
          $newarch = "";
        }else{
          $newarch = "ARCHITECT(INDIVIDUAL), ";
        }
        if(count($sub_architect) == $count_oldsubarch)
        {
          $newsubarch = "";
        }else{
          $newsubarch = "SUB-ARCHITECT(INDIVIDUAL), ";
        }
        if(count($applicator) == $count_oldapp)
        {
          $newapp = "";
        }else{
          $newapp = "APPLICATOR(IN-COMPANY), ";
        }
        if(count($sub_applicator) == $count_oldsubapp)
        {
          $newsubapp = "";
        }else{
          $newsubapp = "SUB-APPLICATOR(INDIVIDUAL), ";
        }
        if(count($dealer_supplier) == $count_olddealsupp)
        {
          $newdealsupp = "";
        }else{
          $newdealsupp = "DEALER sUPPLIER(IN-COMPANY), ";
        }
        if(count($sub_dealer_supplier) == $count_oldsubdealsupp)
        {
          $newsubdealsupp = "";
        }else{
          $newsubdealsupp = "SUB-DEALER sUPPLIER(INDIVIDUAL), ";
        }

        if($newdev != "" || $newsubdev != "" || $newgencon != "" || $newsubgencon != "" || $newprojmgrdes != "" || $newsubprojmgrdes != "" || $newarch != "" || $newsubarch != "" || $newapp != "" || $newsubapp != "" || $newdealsupp != "" || $newsubdealsupp != "")
        {
          DB::table('project_status')->insert(array([
            'project_id' => $id,
            'user_id' => Auth::id(),
            'update' => 'IN ' . $project_information->project_name . ', UPDATES THE  ' . $newdev . $newsubdev . $newgencon . $newsubgencon . $newprojmgrdes . $newsubprojmgrdes . $newarch . $newsubarch . $newapp . $newsubapp . $newdealsupp . $newsubdealsupp . ' RECORDS.',
            'created_by' => Auth::id(),
            'created_at' => date('Y-m-d') . ' ' . $datetime_now,
            'access' => 1,
          ]));
        }

    $project->save();    

    $get_statuses = DB::table('project_users')->where('project_id', $project->id)->first();
	 	DB::table('project_users')->where('project_id', $project->id)->delete();
    DB::table('developer')->where('project_id', $project->id)->delete();
    DB::table('sub_developer')->where('project_id', $project->id)->delete();
    DB::table('gencon')->where('project_id', $project->id)->delete();
    DB::table('sub_gencon')->where('project_id', $project->id)->delete();
    DB::table('project_mgr_designer')->where('project_id', $project->id)->delete();
    DB::table('sub_project_mgr_designer')->where('project_id', $project->id)->delete();
    DB::table('architect')->where('project_id', $project->id)->delete();
    DB::table('sub_architect')->where('project_id', $project->id)->delete();
    DB::table('applicator')->where('project_id', $project->id)->delete();
    DB::table('sub_applicator')->where('project_id', $project->id)->delete();
    DB::table('dealer_supplier')->where('project_id', $project->id)->delete();
    DB::table('sub_dealer_supplier')->where('project_id', $project->id)->delete();

    DB::table('project_users')->insert(array([
    'created_by' => Auth::id(),
    'user_id' => Input::get('bdo'),
    'project_id' => $project->id,
    'status' => $get_statuses->status,
    'status_forthread' => $get_statuses->status_forthread,
    ]));

        if(count($developer)>0)
        {
         foreach($developer as $dev_row)
         {
              DB::table('developer')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'developer_id' => $dev_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $dev_bdo_id = DB::table('contacts')->select('created_by')->where('id', $dev_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $dev_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }
              
        }
        
        if(count($sub_developer)>0)
        {
         foreach($sub_developer as $sub_dev_row)
         {
              DB::table('sub_developer')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_developer_id' => $sub_dev_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_dev_row = DB::table('contacts')->select('created_by')->where('id', $sub_dev_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_dev_row->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }
              
        }
        
        if(count($general_contractor)>0)
        {
         foreach($general_contractor as $gencon_row)
         {
              DB::table('gencon')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'gencon_id' => $gencon_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $gencon_bdo_id = DB::table('contacts')->select('created_by')->where('id', $gencon_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $gencon_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }
              
        }
        
        if(count($sub_general_contractor)>0)
        {
         foreach($sub_general_contractor as $sub_gencon_row)
         {
              DB::table('sub_gencon')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_gencon_id' => $sub_gencon_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_gencon_bdo_id = DB::table('contacts')->select('created_by')->where('id', $sub_gencon_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_gencon_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }
              
        }
        
        if(count($project_mgr_designer)>0)
        {
         foreach($project_mgr_designer as $projmgrdes_row)
         {
              DB::table('project_mgr_designer')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'project_mgr_designer_id' => $projmgrdes_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $projmgrdes_bdo_id = DB::table('contacts')->select('created_by')->where('id', $projmgrdes_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $projmgrdes_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }
              
        }
        
        if(count($sub_project_mgr_designer)>0)
        {
         foreach($sub_project_mgr_designer as $sub_projmgrdes_row)
         {
              DB::table('sub_project_mgr_designer')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_project_mgr_designer_id' => $sub_projmgrdes_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_projmgrdes_bdo_id = DB::table('contacts')->select('created_by')->where('id', $sub_projmgrdes_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_projmgrdes_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }
              
        }
        
        if(count($architect)>0)
        {
         foreach($architect as $arch_row)
         {
              DB::table('architect')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'architect_id' => $arch_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $arch_bdo_id = DB::table('contacts')->select('created_by')->where('id', $arch_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $arch_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }
              
        }
        
        if(count($sub_architect)>0)
        {
         foreach($sub_architect as $sub_arch_row)
         {
              DB::table('sub_architect')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_architect_id' => $sub_arch_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_arch_bdo_id = DB::table('contacts')->select('created_by')->where('id', $sub_arch_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_arch_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }
              
        }
        
        if(count($applicator)>0)
        {
         foreach($applicator as $app_row)
         {
              DB::table('applicator')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'applicator_id' => $app_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $app_bdo_id = DB::table('contacts')->select('created_by')->where('id', $app_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $app_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }
              
        }    
        
        if(count($sub_applicator)>0)
        {
         foreach($sub_applicator as $sub_app_row)
         {
              DB::table('sub_applicator')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_applicator_id' => $sub_app_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_app_bdo_id = DB::table('contacts')->select('created_by')->where('id', $sub_app_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_app_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }
              
        }
        
        if(count($dealer_supplier)>0)
        {
         foreach($dealer_supplier as $dealsupp_row)
         {
              DB::table('dealer_supplier')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'dealer_supplier_id' => $dealsupp_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $dealsupp_bdo_id = DB::table('contacts')->select('created_by')->where('id', $dealsupp_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $dealsupp_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }      
        
        }

        if(count($sub_dealer_supplier)>0)
        {
         foreach($sub_dealer_supplier as $sub_dealsupp_row)
         {
              DB::table('sub_dealer_supplier')->insert(array([
                    'project_id' => $project->id,
                    'user_id' => Auth::id(),
                    'sub_dealer_supplier_id' => $sub_dealsupp_row,
                    'status' => 1,
                    'date_created' => date('Y-m-d'),
                    'time_created' => $datetime_now,
              ]));

              $sub_dealsupp_bdo_id = DB::table('contacts')->select('created_by')->where('id', $sub_dealsupp_row)->first();

              DB::table('project_users')->insert(array([
                    'created_by' => Auth::id(),
                    'user_id' => $sub_dealsupp_bdo_id->created_by,
                    'project_id' => $project->id,
                    'status' => $get_statuses->status,
                    'status_forthread' => $get_statuses->status_forthread,
              ]));

         }
              
        }

		    $imagename = Input::file('image');
		    $imagestatus = Input::get('photo_files_type');
		    $img_count = count($imagename);
		    // $project_id = $project->id;
		    // $id = Auth::id();

		    if(Input::hasFile('image'))
		    {

			   $uploadcount = 0;

			   foreach($imagename as $img)
			   {
	        	
	        $mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     
		   	  $imgname = $img->getClientOriginalName();

			   	if(!in_array($img->getMimeType(), $mimeType)) 
			   	{

             // $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
            $delete_imgname = $img->getClientOriginalName();

            if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
            {
              $destinationPath = base_path() . '/public/asset/img/project'; // upload path
            }else{
              $destinationPath = base_path() . '/public/asset/files/project'; // upload path               
            }

            File::delete($destinationPath.'/'.$delete_imgname);

			   		return Redirect::route('project.edit', $id)
								->withInput()
								->withErrors($validation)
								->with('class', 'error')
								->with('message', 'Make sure that upload file is correct.');
	
        		}else{
        			// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
	        		$imgname = $img->getClientOriginalName();

	        		if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	        		{
	        			$destinationPath = base_path() . '/public/asset/img/project'; // upload path
	        		}else{
						    $destinationPath = base_path() . '/public/asset/files/project'; // upload path	        			
	        		}

	        		$upload_success = $img->move($destinationPath, $imgname);
	        		
	        		if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "bmp" || $img->getClientOriginalExtension() == "jpeg")
	        		{
            			DB::table('project_images')->insert(
				    		array('user_id' => Auth::id(),
				     	  	'project_id' => $project->id,
				     	  	'image' => $imgname,
				     	  	'status' => 1,
				     	  )
						);

  					}else{
  						DB::table('project_files')->insert(
  				    		array('user_id' => Auth::id(),
  				     	  	'project_id' => $project->id,
  				     	  	'file' => $imgname,
  				     	  	'status' => 1,
  				     	  )
  						);

  					}

	        	}

	        	$uploadcount ++;
			      
			   }
		    	

		    }	

		    $count_imgdel = count(Input::get('delete_image'));
		    $imgdel = Input::get('delete_image');

		    if($count_imgdel > 0)
		    {
		    	foreach($imgdel as $row)
		    	{

          $img_destinationPath = base_path() . '/public/asset/img/project'; // upload path                 
          File::delete($img_destinationPath.'/'.$row);
            
					DB::table('project_images')->where('id', '=', $row)->delete();		    		
		    	}
		    }

		    $count_filedel = count(Input::get('delete_file'));
		    $filedel = Input::get('delete_file');

		    if($count_filedel > 0)
		    {
		    	foreach($filedel as $rows)
		    	{
          
          $file_destinationPath = base_path() . '/public/asset/files/project'; // upload path                 
          File::delete($file_destinationPath.'/'.$rows);  

					DB::table('project_files')->where('id', '=', $rows)->delete();		    		
		    	}
		    }	
         
         return Redirect::route('project.index')
  								->with('class', 'success')
  								->with('message', 'Record successfully updated.');
      	 
      	}else{
      	 
         	return Redirect::route('project.edit', $id)
								->withInput()
								->withErrors($validation)
								->with('class', 'error')
								->with('message', 'There were validation errors.');

      	 }

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /project/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
    $project_name = DB::table('projects')->select('id','project_name','created_by')->where('id', $id)->first();
    $imgs = DB::table('project_images')->where('proj_id', $id)->get();
    $files = DB::table('project_files')->where('proj_id', $id)->get();

		$project = Project::find($id)->delete();

    $gettime = time() - 14400;
    $datetime_now = date("H:i:s", $gettime);

		if(is_null($project)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			DB::table('project_users')->where('project_id', '=', $id)->delete();
			DB::table('project_images')->where('project_id', '=', $id)->delete();
			DB::table('project_files')->where('project_id', '=', $id)->delete();
			DB::table('project_thread')->where('proj_id', '=', $id)->delete();
			DB::table('project_thread_file')->where('proj_id', '=', $id)->delete();
			DB::table('project_thread_image')->where('proj_id', '=', $id)->delete();
      DB::table('developer')->where('project_id', '=', $id)->delete();
      DB::table('sub_developer')->where('project_id', '=', $id)->delete();
      DB::table('gencon')->where('project_id', '=', $id)->delete();
      DB::table('sub_gencon')->where('project_id', '=', $id)->delete();
      DB::table('project_mgr_designer')->where('project_id', '=', $id)->delete();
      DB::table('sub_project_mgr_designer')->where('project_id', '=', $id)->delete();
      DB::table('architect')->where('project_id', '=', $id)->delete();
      DB::table('sub_architect')->where('project_id', '=', $id)->delete();
      DB::table('applicator')->where('project_id', '=', $id)->delete();
      DB::table('sub_applicator')->where('project_id', '=', $id)->delete();
      DB::table('dealer_supplier')->where('project_id', '=', $id)->delete();
      DB::table('sub_dealer_supplier')->where('project_id', '=', $id)->delete();

      foreach($imgs as $imgrow)
      {
        $imgpath = base_path() . '/public/asset/img/project'; 
        File::delete($imgpath().'/'.$imgrow->image);
      }

      foreach($files as $filerow)
      {
        $filepath = base_path() . '/public/asset/files/project'; 
        File::delete($filepath().'/'.$filerow->file);
      }
      
      DB::table('project_status')->where('project_id', $id)->where('access', 1)->update(array('access' => 0));      
      DB::table('project_status')->insert(array([
                  'project_id' => $project_name->id,
                  'user_id' => Auth::id(),
                  'update' => 'REMOVE' . ' ' . $project_name->project_name . ' ' . 'IN PROJECT RECORD',
                  'created_by' => $project_name->created_by,
                  'created_at' => date('Y-m-d') . ' ' . $datetime_now,
            ]));

			$class = 'success';
			$message = 'Record successfully deleted.';

		}

		return Redirect::route('project.index')
						->with('class', $class)
						->with('message', $message);
	}

	public function details($id)
	{
		$pagetitle = 'My Project Details';

		$project_detail = Project::select_projectdetails($id);
		$cities = Project::get_city($id);
		
		$my_projectstatus = DB::table('statuses')->where('id', $project_detail->project_status)->first();
		if(count($my_projectstatus)>0)
		{
			$projectstatus = $my_projectstatus->status; 
		
		}else{
			$projectstatus = 'N/A';

		}

		$dev = Project::get_developer($id);
		$sub_dev = Project::get_sub_developer($id);
		$gencon = Project::get_generalcontractor($id);
		$sub_gencon = Project::get_sub_generalcontractor($id);
		$projmgrdes = Project::get_projectmgrdesigner($id);
		$sub_projmgrdes = Project::get_sub_projectmgrdesigner($id);
		$arch = Project::get_architect($id);
		$sub_arch = Project::get_sub_architect($id);
		$app = Project::get_applicator($id);
		$sub_app = Project::get_sub_applicator($id);
		$dealsupp = Project::get_dealersupplier($id);
		$sub_dealsupp = Project::get_sub_dealersupplier($id);

		$project_img = DB::table('project_images')->where('project_id', $id)->get();
		$project_files = DB::table('project_files')->where('project_id', $id)->get();

		return View::make('projects.details', compact('pagetitle', 'project_detail', 'dev', 'sub_dev', 'gencon', 'sub_gencon', 'projmgrdes', 'sub_projmgrdes', 'arch', 'sub_arch', 'app', 'sub_app', 'dealsupp', 'sub_dealsupp', 'project_img', 'project_files', 'cities', 'projectstatus'));
	}

//--- for cc ----//

	public static function ra()
	{
		$pagetitle = "Project/s List";
		Input::flash();

		$project = Project::requestProjectsList(Input::get('status', 1),Input::get('s'));	
		$project->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();

    $project_status = DB::table('project_status')
          ->select(DB::raw('concat(users.first_name, " " ,users.last_name, " " ,project_status.update) as history, project_status.id, project_status.created_at, project_status.access'))
          ->join('users', 'users.id', '=', 'project_status.user_id')
          ->where('project_status.access', '<', 3)
          ->orderBy('id', 'desc')->get();

		return View::make('projects.ra', compact('pagetitle','project','project_status'));

	}

	public function a($id)
	{
		$project = Project::find($id);
    $gettime = time() - 14400;
    $datetime_now = date("H:i:s", $gettime);

		if(is_null($project)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

      $project->status_forthread = 1;
			$project->status = 2;
			$project->notif = 1;
			$project->notif_dt = date('Y-m-d') . $datetime_now;
			$project->approved_by = Auth::id();
			$project->save();

			DB::table('project_images')->where('project_id', $id)->update(array('status' => 2));
			DB::table('project_files')->where('project_id', $id)->update(array('status' => 2));
			DB::table('project_users')->where('project_id', $id)->update(array('status' => 2));
      DB::table('developer')->where('project_id', $id)->update(array('status' => 2));
      DB::table('sub_developer')->where('project_id', $id)->update(array('status' => 2));
      DB::table('gencon')->where('project_id', $id)->update(array('status' => 2));
      DB::table('sub_gencon')->where('project_id', $id)->update(array('status' => 2));
      DB::table('project_mgr_designer')->where('project_id', $id)->update(array('status' => 2));
      DB::table('sub_project_mgr_designer')->where('project_id', $id)->update(array('status' => 2));
      DB::table('architect')->where('project_id', $id)->update(array('status' => 2));
      DB::table('sub_architect')->where('project_id', $id)->update(array('status' => 2));
      DB::table('applicator')->where('project_id', $id)->update(array('status' => 2));
      DB::table('sub_applicator')->where('project_id', $id)->update(array('status' => 2));
      DB::table('dealer_supplier')->where('project_id', $id)->update(array('status' => 2));
      DB::table('sub_dealer_supplier')->where('project_id', $id)->update(array('status' => 2));

      $project_name = DB::table('projects')->select('project_name','created_by')->where('id', $id)->first();

      DB::table('project_users')->where('project_id', $id)->update(array('status_forthread' => 1));
      DB::table('project_status')->where('project_id', $id)->where('access', 1)->update(array('access' => 2));
      DB::table('project_status')->insert(array([
                  'project_id' => $id,
                  'user_id' => Auth::id(),
                  'update' => 'APPROVED THE REQUEST FOR' . ' ' . $project_name->project_name,
                  'created_by' => $project_name->created_by,
                  'created_at' => date('Y-m-d') . ' ' . $datetime_now,
                  'access' => 3,
            ]));

			$class = 'success';
			$message = 'Record successfully Approved.';

		}

		return Redirect::route('project.ra')
								->with('class', $class)
								->with('message', $message);
	}

	public function d($id)
	{
		$project = Project::find($id);
    $gettime = time() - 14400;
    $datetime_now = date("H:i:s", $gettime);

		if(is_null($project)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$project->remarks = strtoupper(Input::get('remarks_hid'));
			$project->status = 3;
			$project->notif = 1;
			$project->notif_dt = date('Y-m-d') . ' ' . $datetime_now;
			$project->approved_by = Auth::id();
      $project->status_forthread = 0;
			$project->save();

			DB::table('project_images')->where('project_id', $id)->update(array('status' => 3));
			DB::table('project_files')->where('project_id', $id)->update(array('status' => 3));
			DB::table('project_users')->where('project_id', $id)->update(array('status' => 3, 'status_forthread' => 0));
      DB::table('developer')->where('project_id', $id)->update(array('status' => 3));
      DB::table('sub_developer')->where('project_id', $id)->update(array('status' => 3));
      DB::table('gencon')->where('project_id', $id)->update(array('status' => 3));
      DB::table('sub_gencon')->where('project_id', $id)->update(array('status' => 3));
      DB::table('project_mgr_designer')->where('project_id', $id)->update(array('status' => 3));
      DB::table('sub_project_mgr_designer')->where('project_id', $id)->update(array('status' => 3));
      DB::table('architect')->where('project_id', $id)->update(array('status' => 3));
      DB::table('sub_architect')->where('project_id', $id)->update(array('status' => 3));
      DB::table('applicator')->where('project_id', $id)->update(array('status' => 3));
      DB::table('sub_applicator')->where('project_id', $id)->update(array('status' => 3));
      DB::table('dealer_supplier')->where('project_id', $id)->update(array('status' => 3));
      DB::table('sub_dealer_supplier')->where('project_id', $id)->update(array('status' => 3));

      $project_name = DB::table('projects')->select('project_name','created_by')->where('id', $id)->first();

      DB::table('project_status')->where('project_id', $id)->where('access', 1)->update(array('access' => 2));
      DB::table('project_status')->insert(array([
                  'project_id' => $id,
                  'user_id' => Auth::id(),
                  'update' => 'APPROVED THE REQUEST FOR' . ' ' . $project_name->project_name,
                  'created_by' => $project_name->created_by,
                  'created_at' => date('Y-m-d') . ' ' . $datetime_now,
                  'access' => 3,
            ]));

			$class = 'success';
			$message = 'Record successfully Denied.';

		}

		return Redirect::route('project.ra')
								->with('class', $class)
								->with('message', $message);
	}

	public function ra_details($id)
	{
		$pagetitle = 'Project Details';

		$project = Project::selectnfo_fordetails($id);
		$cities = Project::get_city($id);

		$my_projectstatus = DB::table('statuses')->where('id', $project->project_status)->first();
		if(count($my_projectstatus)>0)
		{
			$projectstatus = $my_projectstatus->status; 
		
		}else{
			$projectstatus = 'N/A';

		}

		// if($project->developer != 0)
		// {
		// 	$project_detail_dev = DB::table('contacts')->select('category')->where('id', $project->developer)->first();
		// 	if($project_detail_dev->category == 1)
		// 	{
		// 		$dev = Project::get_developer($project);
			
		// 	}else{
		// 		$dev = Project::get_developer_ind($project);

		// 	}

		// }

		// if($project->general_contractor != 0)
		// {
		// 	$project_detail_gencon = DB::table('contacts')->select('category')->where('id', $project->general_contractor)->first();
		// 	if($project_detail_gencon->category == 1)
		// 	{
		// 		$gencon = Project::get_generalcontractor($project);
			
		// 	}else{
		// 		$gencon = Project::get_generalcontractor_ind($project);	
			
		// 	}

		// }

		// if($project->project_mgr_designer != 0)
		// {
		// 	$project_detail_projmgrdesigner = DB::table('contacts')->select('category')->where('id', $project->project_mgr_designer)->first();
		// 	if($project_detail_projmgrdesigner->category == 1)
		// 	{
		// 		$projmgrdes = Project::get_projectmgrdesigner($project);
			
		// 	}else{
		// 		$projmgrdes = Project::get_projectmgrdesigner_ind($project);

		// 	}

		// }
		
		// if($project->architect != 0)
		// {
		// 	$project_detail_architect = DB::table('contacts')->select('category')->where('id', $project->architect)->first();
		// 	if($project_detail_architect->category == 1)
		// 	{
		// 		$arch = Project::get_architect($project);
			
		// 	}else{
		// 		$arch = Project::get_architect_ind($project);

		// 	}

		// }
			
		// if($project->applicator != 0)
		// {
		// 	$project_detail_applicator = DB::table('contacts')->select('category')->where('id', $project->applicator)->first();
		// 	if($project_detail_applicator->category == 1)
		// 	{
		// 		$app = Project::get_applicator($project);
			
		// 	}else{
		// 		$app = Project::get_applicator_ind($project);

		// 	}

		// }
		
		// if($project->dealer_supplier != 0)
		// {
		// 	$project_detail_dealersupplier = DB::table('contacts')->select('category')->where('id', $project->dealer_supplier)->first();
		// 	if($project_detail_dealersupplier->category == 1)
		// 	{
		// 		$dealsupp = Project::get_dealersupplier($project);

		// 	}else{
		// 		$dealsupp = Project::get_dealersupplier_ind($project);

		// 	}

		// }

    $dev = Project::get_developer($id);
    $sub_dev = Project::get_sub_developer($id);
    $gencon = Project::get_generalcontractor($id);
    $sub_gencon = Project::get_sub_generalcontractor($id);
    $projmgrdes = Project::get_projectmgrdesigner($id);
    $sub_projmgrdes = Project::get_sub_projectmgrdesigner($id);
    $arch = Project::get_architect($id);
    $sub_arch = Project::get_sub_architect($id);
    $app = Project::get_applicator($id);
    $sub_app = Project::get_sub_applicator($id);
    $dealsupp = Project::get_dealersupplier($id);
    $sub_dealsupp = Project::get_sub_dealersupplier($id);	

		$project_img = DB::table('project_images')->where('project_id', $id)->get();
		$project_files = DB::table('project_files')->where('project_id', $id)->get();

		$almost_sameproj = Project::selectsameinfo_fordetails($project);

		return View::make('projects.ra-details', compact('pagetitle', 'project', 'dev', 'sub_dev', 'gencon', 'sub_gencon', 'projmgrdes', 'sub_projmgrdes', 'arch', 'sub_arch', 'app', 'sub_app', 'dealsupp', 'sub_dealsupp', 'project_img', 'project_files', 'cities', 'almost_sameproj','projectstatus'));
	}

//----------------- change bdo ------------------//
	public function editbdo($id)
	{
		$pagetitle = 'Assign to other BDO';

		$bdo_list = Project::selectbdo_list();
		$bdo = DB::table('projects')
						->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.id, projects.bdo_id'))
						->join('users', 'users.id', '=', 'projects.bdo_id')
						->where('projects.id', $id)
						->first();

		return View::make('projects.updatebdo', compact('pagetitle', 'bdo', 'bdo_list'));
	}

	public function updatebdo($id)
	{
		$project = Project::find($id);

		if(is_null($project)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$project->bdo_id = Input::get('bdo');
			$project->save();

			DB::table('project_users')->where(array('project_id' => $id, 'user_id' => Input::get('former_bdo')))->update(array('user_id' => Input::get('bdo')));

			$class = 'success';
			$message = 'Record successfully assigned to other BDO.';

		}

		return Redirect::route('project.list')
								->with('class', $class)
								->with('message', $message);
	}
	
//----------------- for list --------------------//	

	public function myprojectlist()
	{
		$pagetitle = 'My Assigned-Project List';
		
		if(Session::get('role') == 1 || Session::get('role') == 2)
		{
			
			if(Input::get('status') == 4)
			{
    		$myprojectlist = Project::get_allprojects(Input::get('status'),Input::get('s'));
				$myprojectlist_count = Project::get_allproject_counts(Input::get('status'),Input::get('s'));

			}elseif(Input::get('status') == 0){
        $myprojectlist = Project::get_allprojectclosed(Input::get('s'));
        $myprojectlist_count = Project::get_allprojectclosed_count(Input::get('s'));

      }else{  
   			$myprojectlist = Project::get_allproject(Input::get('status', 2),Input::get('s'));
				$myprojectlist_count = Project::get_allproject_count(Input::get('status', 2),Input::get('s'));

			}
					
		}elseif(Session::get('role') == 3){
			
			if(Input::get('status') == 4)
			{
				$myprojectlist = Project::get_bdoprojects(Input::get('status'),Input::get('s'),Auth::id());
				$myprojectlist_count = Project::get_bdoproject_counts(Input::get('status'),Input::get('s'),Auth::id());
			
			}else{
				$myprojectlist = Project::get_bdoproject(Input::get('status', 2),Input::get('s'),Auth::id());
				$myprojectlist_count = Project::get_bdoproject_count(Input::get('status', 2),Input::get('s'),Auth::id());

			}

		}elseif(Session::get('role') == 4){
			
			if(Input::get('status') == 4)
			{
				$myprojectlist = Project::get_ccprojects(Input::get('status'),Input::get('s'),Auth::id());
				$myprojectlist_count =Project::get_ccproject_counts(Input::get('status'),Input::get('s'),Auth::id());

			}else{
				$myprojectlist = Project::get_ccproject(Input::get('status', 2),Input::get('s'),Auth::id());
				$myprojectlist_count =Project::get_ccproject_count(Input::get('status', 2),Input::get('s'),Auth::id());
			
			}

		}
		// $projects = Project::select_projects_all(Input::get('status', 1),Input::get('s'),Auth::id());
		// $projects->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();	

    return View::make('projects.myprojects', compact('pagetitle', 'myprojectlist', 'myprojectlist_count'));
	}

	public function myproject_details($id)
	{
		$pagetitle = 'Project Details';

		$project = Project::selectproject_info_details($id);
		$dev = Project::get_developer($project);
		$gencon = Project::get_generalcontractor($project);
		$projmgrdes = Project::get_projectmgrdesigner($project);
		$arch = Project::get_architect($project);
		$app = Project::get_applicator($project);
		$dealsupp = Project::get_dealersupplier($project);

		$almost_sameproj = Project::selectsameinfo_fordetails($project);
		$project_img = DB::table('project_images')->where('project_id', $id)->where('status', 1)->get();

		return View::make('projects.myprojects-details', compact('pagetitle', 'project', 'dev', 'gencon', 'projmgrdes', 'arch', 'app', 'dealsupp', 'almost_sameproj', 'project_img'));
	}

	public function myproject_status($id)
	{
		$pagetitle = 'Project Thread';

		$project = Project::selectnfo_fordetails($id);

    if($project->status == 0)
    {
      return Redirect::route('project.list')
                ->with('class', 'error')
                ->with('message', 'This project was already closed.');
    }else{
      $my_projectstatus = DB::table('statuses')->where('id', $project->project_status)->first();
    if(count($my_projectstatus)>0)
    {
      $projectstatus = $my_projectstatus->status; 
    
    }else{
      $projectstatus = 'N/A';

    }

    // if($project->developer)
    // {
    //  $project_detail_dev = DB::table('contacts')->select('category')->where('id', $project->developer)->first();
    //  if($project_detail_dev->category == 1)
    //  {
    //    $dev = Project::get_developer($project);
      
    //  }else{
    //    $dev = Project::get_developer_ind($project);

    //  }

    // }

    // if($project->general_contractor)
    // {
    //  $project_detail_gencon = DB::table('contacts')->select('category')->where('id', $project->general_contractor)->first();
    //  if($project_detail_gencon->category == 1)
    //  {
    //    $gencon = Project::get_generalcontractor($project);
      
    //  }else{
    //    $gencon = Project::get_generalcontractor_ind($project); 
      
    //  }

    // }

    // if($project->project_mgr_designer)
    // {
    //  $project_detail_projmgrdesigner = DB::table('contacts')->select('category')->where('id', $project->project_mgr_designer)->first();
    //  if($project_detail_projmgrdesigner->category == 1)
    //  {
    //    $projmgrdes = Project::get_projectmgrdesigner($project);
      
    //  }else{
    //    $projmgrdes = Project::get_projectmgrdesigner_ind($project);

    //  }

    // }

    // if($project->architect)
    // {
    //  $project_detail_architect = DB::table('contacts')->select('category')->where('id', $project->architect)->first();
    //  if($project_detail_architect->category == 1)
    //  {
    //    $arch = Project::get_architect($project);
      
    //  }else{
    //    $arch = Project::get_architect_ind($project);

    //  }

    // }  

    // if($project->applicator)
    // {
    //  $project_detail_applicator = DB::table('contacts')->select('category')->where('id', $project->applicator)->first();
    //  if($project_detail_applicator->category == 1)
    //  {
    //    $app = Project::get_applicator($project);
      
    //  }else{
    //    $app = Project::get_applicator_ind($project);

    //  }

    // }

    // if($project->dealer_supplier)
    // {
    //  $project_detail_dealersupplier = DB::table('contacts')->select('category')->where('id', $project->dealer_supplier)->first();
    //  if($project_detail_dealersupplier->category == 1)
    //  {
    //    $dealsupp = Project::get_dealersupplier($project);

    //  }else{
    //    $dealsupp = Project::get_dealersupplier_ind($project);

    //  }

    // }

    $dev = Project::s_get_developer($id);
    $sub_dev = Project::s_get_sub_developer($id);
    $gencon = Project::s_get_generalcontractor($id);
    $sub_gencon = Project::s_get_sub_generalcontractor($id);
    $projmgrdes = Project::s_get_projectmgrdesigner($id);
    $sub_projmgrdes = Project::s_get_sub_projectmgrdesigner($id);
    $arch = Project::s_get_architect($id);
    $sub_arch = Project::s_get_sub_architect($id);
    $app = Project::s_get_applicator($id);
    $sub_app = Project::s_get_sub_applicator($id);
    $dealsupp = Project::s_get_dealersupplier($id);
    $sub_dealsupp = Project::s_get_sub_dealersupplier($id);

    // $almost_sameproj = Project::selectsameinfo_fordetails($project);
    $project_img = DB::table('project_images')->where('project_id', $id)->where('status', 2)->get();
    $project_files = DB::table('project_files')->where('project_id', $id)->where('status', 2)->get();

    if(Session::get('role') == 1 || Session::get('role') == 2)
    {
      
      $project_thread = Project::get_allproject_thread($project->id);
      $project_status = DB::table('projects')
                ->select('id','status')
                ->where('id', $id)
                ->first();

    }elseif(Session::get('role') == 3){
      
      $project_thread = Project::get_bdoproject_thread($project->approved_by,$project->id);
      $project_status = DB::table('project_users')
                ->select('id','status')
                ->where('project_id', $id)
                ->where('user_id', Auth::id())
                ->first();  

    }elseif(Session::get('role') == 4){
      
      $project_thread = Project::get_ccproject_thread($project->id,$project->bdo_id);
      $project_status = DB::table('projects')
                ->select('id','status')
                ->where('id', $id)
                ->first();

    }
  
    return View::make('projects.myprojects-status', compact('pagetitle', 'project', 'dev', 'sub_dev', 'gencon', 'sub_gencon', 'projmgrdes', 'sub_projmgrdes', 'arch', 'sub_arch', 'app', 'sub_app', 'dealsupp', 'sub_dealsupp', 'almost_sameproj', 'project_img', 'project_files', 'project_thread', 'project_status', 'projectstatus'));
    }
		
	}

	public function myproject_addremarks($id)
	{

		// $file_validator = Validator::make(
		// 	array('file' => $img),
		// 	array('file' => 'required|mimes:pdf,gif,jpg,png,jpeg,bmp,csv')
		// );

		// if($file_validator->passes()) 
		// {
		// }

    $gettime = time() - 14400;
    $datetime_now = date("H:i:s", $gettime);
    
		if(Input::get('remarks') == "" || Input::get('remarks') == "Write here.")
		{	
			return Redirect::route('myproject.status', $id)
						->withInput()
						->with('class', 'error')
						->with('message', 'Fill-up *required fields.');

		}
		
		// else{
		$thread = DB::table('project_thread')->insertGetId(array(
			'proj_id' => $id,
			'user_id' => Auth::id(),
			'remarks' => Input::get('remarks'),
			'date_created' => date('Y-m-d'),
			'time_created' => $datetime_now,
			'returned' => 1
			)
		);
					
		$imagename = Input::file('image');
		// $imagestatus = Input::get('photo_files_type');
	    $img_count = count($imagename);
	    $proj_thread_id = $thread;
	    // $id = Auth::id();

	    if(Input::hasFile('image'))
	    {

		   $uploadcount = 0;	

		   foreach($imagename as $img)
		   {
        
        if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "jpeg" || $img->getClientOriginalExtension() == "bmp")
        {
         $exif_data = exif_read_data($img);
         $attached_imgattr = date("Y-m-d H:i:s", strtotime($exif_data['DateTimeOriginal']));
        }

		   	$mimeType = array('image/png','image/gif','image/jpeg','image/bmp','application/zip','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-office','application/vnd.ms-excel','application/pdf','application/msword');     

	   	  $imgname = $img->getClientOriginalName();

		   	if(!in_array($img->getMimeType(), $mimeType)) 
		   	{
		   		
		   		DB::table('project_thread')->where('id', '=', $proj_thread_id)->delete();
    			DB::table('project_thread_image')->where('proj_thread_id', '=', $proj_thread_id)->delete();
    			DB::table('project_thread_file')->where('proj_thread_id', '=', $proj_thread_id)->delete();

    			return Redirect::route('myproject.status', $id)
					->withInput()
					->with('class', 'error')
					->with('message', 'Make sure that upload file is correct.');
	    		
		   	}else{	

		   		if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "jpeg" || $img->getClientOriginalExtension() == "bmp")
		   		{
		   			$destinationPath = base_path() . '/public/asset/img/project-thread'; // upload path
		   		}else{
		   			$destinationPath = base_path() . '/public/asset/files/project-thread'; // upload path
		   		}
		  
    			$upload_success = $img->move($destinationPath, $imgname);

    			if($img->getClientOriginalExtension() == "gif" || $img->getClientOriginalExtension() == "png" || $img->getClientOriginalExtension() == "jpg" || $img->getClientOriginalExtension() == "jpeg" || $img->getClientOriginalExtension() == "bmp")
		   		{

	    			DB::table('project_thread_image')->insert(
					    array('user_id' => Auth::id(),
					     	  'proj_id' => $id,
					     	  'proj_thread_id' => $proj_thread_id, 
					     	  'filename' => $imgname,
					     	  'datetime_created' => $attached_imgattr,
					     	  )
						);
				}else{
				  
        	DB::table('project_thread_file')->insert(
				    array('user_id' => Auth::id(),
				     	  'proj_id' => $id,
				     	  'proj_thread_id' => $proj_thread_id, 
				     	  'filename' => $imgname,
				     	  'datetime_created' => date('Y-m-d') . $datetime_now,
				     	  )
					);

				}
			}
        	
     		// $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
        	}

        	$uploadcount ++;  
	    }

		if(Input::get('closed') == 1)
		{

			$project = Project::find($id);
			$project->status = 0;
      // $project->status_forthread = 0;
			$project->save();

			DB::table('project_thread')->where(array('proj_id' => $id))->update(
					array(
						'returned' => 2
						)
				);

			DB::table('project_images')->where('project_id', $id)->update(array('status' => 0));
			DB::table('project_files')->where('project_id', $id)->update(array('status' => 0));
			DB::table('project_users')->where('project_id', $id)->update(array('status' => 0));

			return Redirect::route('project.list')
				->with('class', 'success')
				->with('message', 'Project successfully closed.');

		}else{			
			return Redirect::route('myproject.status', $id)
				->with('class', 'success')
				->with('message', 'Remarks successfully posted.');
		}

	}
	

	public function closedproject_information($id)
	{
		$pagetitle = 'Closed Project Information';

		$project = Project::selectnfo_fordetails($id);

		$my_projectstatus = DB::table('statuses')->where('id', $project->project_status)->first();
		if(count($my_projectstatus)>0)
		{
			$projectstatus = $my_projectstatus->status; 
		
		}else{
			$projectstatus = 'N/A';

		}

		$dev = Project::s_get_developer($id);
    $sub_dev = Project::s_get_sub_developer($id);
    $gencon = Project::s_get_generalcontractor($id);
    $sub_gencon = Project::s_get_sub_generalcontractor($id);
    $projmgrdes = Project::s_get_projectmgrdesigner($id);
    $sub_projmgrdes = Project::s_get_sub_projectmgrdesigner($id);
    $arch = Project::s_get_architect($id);
    $sub_arch = Project::s_get_sub_architect($id);
    $app = Project::s_get_applicator($id);
    $sub_app = Project::s_get_sub_applicator($id);
    $dealsupp = Project::s_get_dealersupplier($id);
    $sub_dealsupp = Project::s_get_sub_dealersupplier($id);

		// $almost_sameproj = Project::selectsameinfo_fordetails($project);
		$project_img = DB::table('project_images')->where('project_id', $id)->where('status', 0)->get();
		$project_files = DB::table('project_files')->where('project_id', $id)->where('status', 0)->get();

		if(Session::get('role') == 1 || Session::get('role') == 2)
		{
			
			$project_thread = Project::getall_closedproject_thread($project->id);
			$project_status = DB::table('projects')
								->select('id','status')
								->where('id', $id)
								->first();

		}elseif(Session::get('role') == 3){
			
			$project_thread = Project::get_closed_bdoproject_thread($project->approved_by,$project->id);
			$project_status = DB::table('projects')
								->select('id','status')
								->where('id', $id)
								->first();	

		}elseif(Session::get('role') == 4){
			
			$project_thread = Project::get_closed_ccproject_thread($project->id,$project->bdo_id);
			$project_status = DB::table('projects')
								->select('id','status')
								->where('id', $id)
								->first();

		}

		return View::make('projects.closed-project', compact('pagetitle', 'project', 'dev', 'sub_dev', 'gencon', 'sub_gencon', 'projmgrdes', 'sub_projmgrdes', 'arch', 'sub_arch', 'app', 'sub_app', 'dealsupp', 'sub_dealsupp', 'almost_sameproj', 'project_img', 'project_files', 'project_thread', 'project_status', 'projectstatus'));
			
	}

	//-------------------------------- activate project ------------------------------------//

	public function activate_project($id)
	{
		$project = Project::find($id);
		
		if(is_null($project)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			DB::table('projects')->where('id', $id)->update(array('status' => 2));
			DB::table('project_images')->where('project_id', $id)->update(array('status' => 2));
			DB::table('project_files')->where('project_id', $id)->update(array('status' => 2));
			DB::table('project_users')->where('project_id', $id)->update(array('status' => 2));
			DB::table('project_thread')->where('proj_id', $id)->update(array('returned' => 1));

			$class = 'success';
			$message = 'Project successfully activate.';

		}

		return Redirect::route('project.list')
				->with('class', $class)
				->with('message', $message);

	}


}