<?php

class ReportsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /reports
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /reports/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /reports
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /reports/{id}
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
	 * GET /reports/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /reports/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /reports/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function company_reports_list()
	{
		$pagetitle = 'Company Reports';

		return View::make('reports.company', compact('pagetitle'));
	}

	public function project_via_categories()
	{
		$pagetitle = 'Project List - Categories';

		$categories = DB::table('categories')
						->select(DB::raw('concat(category," ","-"," ",description) as record, id'))
						->orderBy('record', 'asc')
						->lists('record', 'id');

		$areas = DB::table('areas')
					->select('area_place', 'id')
					->orderBy('area_place', 'asc')
					->lists('area_place', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_categories = DB::table('projects')
					->select('id', 'project_name', 'project_owner', 'painting_dtstart', 'painting_dtend')
					->where('status', '<', 3)
					->where('status', '<>', 1)
					->get();

		}else{
			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_categories = DB::table('projects')
					->select('id', 'project_name', 'project_owner', 'painting_dtstart', 'painting_dtend')
					->where('status', '<', 3)
					->where('status', '<>', 1)
					->where('project_category', Input::get('project_category'))
					->where('area_id', Input::get('area_place'))
					->where('painting_dtstart', '>=', Input::get('date_from'))
					->where('painting_dtend', '<=', Input::get('date_to'))
					->get();					
			}else{
			 $project_via_categories = DB::table('projects')
					->select('id', 'project_name', 'project_owner', 'painting_dtstart', 'painting_dtend')
					->where('status', '<', 3)
					->where('status', '<>', 1)
					->get();
			}
			$project_categories = DB::table('categories')
					->select('id', 'category')
					->where('id', Input::get('project_category'))
					->first();							
			
			$areas_search = DB::table('areas')
					->select('id', 'area_place')
					->where('id', Input::get('area_place'))
					->first();						
		}
		return View::make('reports.project-via-categories', compact('pagetitle', 'categories', 'areas', 'project_via_categories', 'project_categories', 'areas_search'));
	}

	public function project_via_categories_print()
	{
		$agree = Input::get('hid_agree_val');
		$project_category = Input::get('hid_proj_cat');
		$area_place = Input::get('hid_area');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('projects')
				->select('project_name as project', 'project_owner as owner', 'painting_dtstart as painting_date_start', 'painting_dtend as painting_date_end')
				->where('status', '<', 3)
				->where('status', '<>', 1)
				->get();

			foreach($result as $row)
			{
				$row->project = $row->project;
				$row->owner = $row->owner;
				$row->painting_date_start = date("m-d-Y", strtotime($row->painting_date_start));
				$row->painting_date_end = date("m-d-Y", strtotime($row->painting_date_end));
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-CATEGORIES' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
				$result = DB::table('projects')
				->select('project_name as project', 'project_owner as owner', 'painting_dtstart as painting_date_start', 'painting_dtend as painting_date_end')
				->where('status', '<', 3)
				->where('status', '<>', 1)
				->where('project_category', $project_category)
				->where('area_id', $area_place)
				->where('painting_dtstart', '>=', $from)
				->where('painting_dtend', '<=', $to)
				->get();
			}else{
				$result = DB::table('projects')
				->select('project_name as project', 'project_owner as owner', 'painting_dtstart as painting_date_start', 'painting_dtend as painting_date_end')
				->where('status', '<', 3)
				->where('status', '<>', 1)
				->get();
			}
			
			foreach($result as $row)
			{
				$row->project = $row->project;
				$row->owner = $row->owner;
				$row->painting_date_start = date("m-d-Y", strtotime($row->painting_date_start));
				$row->painting_date_end = date("m-d-Y", strtotime($row->painting_date_end));
				$data[] = (array)$row;	
			}

			$categorys = DB::table('categories')
						->select('id', 'category')
						->where('id', $project_category)
						->first();		

			$filename = date('m-d-Y') .  '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Search by Categories', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Project List - Categories'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'PROJECT NAME', 'PROJECT OWNER','PAINTING DATE-START','PAINTING DATE-END'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_developer()
	{
		$pagetitle = 'Project List - Developer(In-Company)';

		$developer = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 8)
					->where('contacts.category', 1)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_developer = DB::table('developer')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
					->join('projects', 'projects.id', '=', 'developer.project_id')
					->join('users', 'users.id', '=', 'developer.user_id')
					->join('contacts', 'contacts.id', '=', 'developer.developer_id')
					->where('developer.status', 2)
					->get();

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_developer = DB::table('developer')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'developer.project_id')
				->join('users', 'users.id', '=', 'developer.user_id')
				->join('contacts', 'contacts.id', '=', 'developer.developer_id')
				->where('developer.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_developer = DB::table('developer')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'developer.project_id')
				->join('users', 'users.id', '=', 'developer.user_id')
				->join('contacts', 'contacts.id', '=', 'developer.developer_id')
				->where('developer.status', 2)
				->where('developer.developer_id', Input::get('project_developer'))
				->get();
			}			
			
			$project_developer = DB::table('contacts')
									->select('id', 'fullname')
									->where('id', Input::get('project_developer'))
									->first();							
			
		}
		
		return View::make('reports.project-via-developer', compact('pagetitle','developer','project_via_developer','project_developer'));
	}

	public function project_via_developers_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_proj_dev');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('sub_architect')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'sub_architect.project_id')
					->join('users', 'users.id', '=', 'sub_architect.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_architect.sub_architect_id')
					->where('sub_architect.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-DEVELOPER(IN-COMPANY)' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('sub_architect')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_architect.project_id')
				->join('users', 'users.id', '=', 'sub_architect.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_architect.sub_architect_id')
				->where('sub_architect.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('sub_architect')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_architect.project_id')
				->join('users', 'users.id', '=', 'sub_architect.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_architect.sub_architect_id')
				->where('sub_architect.status', 2)
				->where('developer.developer_id', Input::get('hid_proj_dev'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-DEVELOPER(IN-COMPANY)' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Search by Developer(In-Company)', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Project List - Developer(In-Company)'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'DEVELOPER NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_sub_developer()
	{
		$pagetitle = 'Project List - Developer(Individual)';

		$developer = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 8)
					->where('contacts.category', 2)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_sub_developer = DB::table('sub_developer')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
					->join('projects', 'projects.id', '=', 'sub_developer.project_id')
					->join('users', 'users.id', '=', 'sub_developer.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_developer.sub_developer_id')
					->where('sub_developer.status', 2)
					->get();

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_sub_developer = DB::table('sub_developer')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_developer.project_id')
				->join('users', 'users.id', '=', 'sub_developer.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_developer.sub_developer_id')
				->where('sub_developer.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_sub_developer = DB::table('sub_developer')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_developer.project_id')
				->join('users', 'users.id', '=', 'sub_developer.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_developer.sub_developer_id')
				->where('sub_developer.status', 2)
				->where('sub_developer.sub_developer_id', Input::get('project_developer'))
				->get();
			}			
			
			$project_developer = DB::table('contacts')
									->select('id', 'fullname')
									->where('id', Input::get('project_developer'))
									->first();							
			
		}
		
		return View::make('reports.project-via-sub-developer', compact('pagetitle','developer','project_via_sub_developer','project_developer'));
	}

	public function project_via_sub_developers_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_proj_dev');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('sub_developer')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'sub_developer.project_id')
					->join('users', 'users.id', '=', 'sub_developer.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_developer.sub_developer_id')
					->where('sub_developer.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-DEVELOPER(INDIVIDUAL)' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('sub_developer')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_developer.project_id')
				->join('users', 'users.id', '=', 'sub_developer.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_developer.sub_developer_id')
				->where('sub_developer.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('sub_developer')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_developer.project_id')
				->join('users', 'users.id', '=', 'sub_developer.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_developer.sub_developer_id')
				->where('sub_developer.status', 2)
				->where('sub_developer.sub_developer_id', Input::get('hid_proj_dev'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-DEVELOPER(INDIVIDUAL)' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Search by Developer(Individual)', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Project List - Developer(Individual)'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'DEVELOPER NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_gencon()
	{
		$pagetitle = 'Project List - GenCon(In-Company)';

		$gencon = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 9)
					->where('contacts.category', 1)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_gencon = DB::table('gencon')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
					->join('projects', 'projects.id', '=', 'gencon.project_id')
					->join('users', 'users.id', '=', 'gencon.user_id')
					->join('contacts', 'contacts.id', '=', 'gencon.gencon_id')
					->where('gencon.status', 2)
					->get();

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_gencon = DB::table('gencon')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'gencon.project_id')
				->join('users', 'users.id', '=', 'gencon.user_id')
				->join('contacts', 'contacts.id', '=', 'gencon.gencon_id')
				->where('gencon.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_gencon = DB::table('gencon')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'gencon.project_id')
				->join('users', 'users.id', '=', 'gencon.user_id')
				->join('contacts', 'contacts.id', '=', 'gencon.gencon_id')
				->where('gencon.status', 2)
				->where('gencon.gencon_id', Input::get('general_contractor'))
				->get();
			}			
			
			$general_contractor = DB::table('contacts')
				->select('id', 'fullname')
				->where('id', Input::get('general_contractor'))
				->first();									
		}
		return View::make('reports.project-via-gencon', compact('pagetitle','general_contractor','project_via_gencon','gencon'));
	}

	public function project_via_gencons_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_gencon');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('gencon')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'gencon.project_id')
					->join('users', 'users.id', '=', 'gencon.user_id')
					->join('contacts', 'contacts.id', '=', 'gencon.gencon_id')
					->where('gencon.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-GENCON(IN-COMPANY)' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('gencon')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'gencon.project_id')
				->join('users', 'users.id', '=', 'gencon.user_id')
				->join('contacts', 'contacts.id', '=', 'gencon.gencon_id')
				->where('gencon.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('gencon')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'gencon.project_id')
				->join('users', 'users.id', '=', 'gencon.user_id')
				->join('contacts', 'contacts.id', '=', 'gencon.gencon_id')
				->where('gencon.status', 2)
				->where('gencon.gencon_id', Input::get('hid_gencon'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-GENCON(IN-COMPANY)' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Search by GenCon(In-Company)', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Project List - GenCon(In-Company)'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'GEN-CON NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_sub_gencon()
	{
		$pagetitle = 'Project List - GenCon(Individual)';

		$gencon = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 9)
					->where('contacts.category', 2)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_sub_gencon = DB::table('sub_gencon')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
					->join('projects', 'projects.id', '=', 'sub_gencon.project_id')
					->join('users', 'users.id', '=', 'sub_gencon.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_gencon.sub_gencon_id')
					->where('sub_gencon.status', 2)
					->get();

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_sub_gencon = DB::table('sub_gencon')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_gencon.project_id')
				->join('users', 'users.id', '=', 'sub_gencon.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_gencon.sub_gencon_id')
				->where('sub_gencon.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_sub_gencon = DB::table('sub_gencon')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_gencon.project_id')
				->join('users', 'users.id', '=', 'sub_gencon.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_gencon.sub_gencon_id')
				->where('sub_gencon.status', 2)
				->where('sub_gencon.sub_gencon_id', Input::get('general_contractor'))
				->get();
			}			
			
			$general_contractor = DB::table('contacts')
				->select('id', 'fullname')
				->where('id', Input::get('general_contractor'))
				->first();									
		}
		return View::make('reports.project-via-sub-gencon', compact('pagetitle','general_contractor','project_via_sub_gencon','gencon'));
	}

	public function project_via_sub_gencons_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_gencon');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('sub_gencon')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'sub_gencon.project_id')
					->join('users', 'users.id', '=', 'sub_gencon.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_gencon.sub_gencon_id')
					->where('sub_gencon.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-GENCON(INDIVIDUAL)' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('sub_gencon')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_gencon.project_id')
				->join('users', 'users.id', '=', 'sub_gencon.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_gencon.sub_gencon_id')
				->where('sub_gencon.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('sub_gencon')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_gencon.project_id')
				->join('users', 'users.id', '=', 'sub_gencon.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_gencon.sub_gencon_id')
				->where('sub_gencon.status', 2)
				->where('sub_gencon.sub_gencon_id', Input::get('hid_gencon'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-GENCON(INDIVIDUAL)' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Search by GenCon(Individual)', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Project List - GenCon(Individual)'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'GEN-CON NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_mngrdesigner()
	{
		$pagetitle = 'Project List - Project Mngr/Designer(In-Company)';

		$mgr_designer = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 10)
					->where('contacts.category', 1)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_mgrdesigner = DB::table('project_mgr_designer')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
					->join('projects', 'projects.id', '=', 'project_mgr_designer.project_id')
					->join('users', 'users.id', '=', 'project_mgr_designer.user_id')
					->join('contacts', 'contacts.id', '=', 'project_mgr_designer.project_mgr_designer_id')
					->where('project_mgr_designer.status', 2)
					->get();

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_mgrdesigner = DB::table('project_mgr_designer')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'project_mgr_designer.project_id')
				->join('users', 'users.id', '=', 'project_mgr_designer.user_id')
				->join('contacts', 'contacts.id', '=', 'project_mgr_designer.project_mgr_designer_id')
				->where('project_mgr_designer.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_mgrdesigner = DB::table('project_mgr_designer')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'project_mgr_designer.project_id')
				->join('users', 'users.id', '=', 'project_mgr_designer.user_id')
				->join('contacts', 'contacts.id', '=', 'project_mgr_designer.project_mgr_designer_id')
				->where('project_mgr_designer.status', 2)
				->where('project_mgr_designer.project_mgr_designer_id', Input::get('project_mgr_designer'))
				->get();
			}			
			
			$project_mgr_designer = DB::table('contacts')
				->select('id', 'fullname')
				->where('id', Input::get('project_mgr_designer'))
				->first();									
		}
		return View::make('reports.project-via-mgrdesigner', compact('pagetitle','project_mgr_designer','project_via_mgrdesigner','mgr_designer'));
	}

	public function project_via_mgrdesigners_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_mngr_designer');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('project_mgr_designer')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'project_mgr_designer.project_id')
					->join('users', 'users.id', '=', 'project_mgr_designer.user_id')
					->join('contacts', 'contacts.id', '=', 'project_mgr_designer.project_mgr_designer_id')
					->where('project_mgr_designer.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'MANAGER-DESIGNER(IN-COMPANY)' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('project_mgr_designer')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'project_mgr_designer.project_id')
				->join('users', 'users.id', '=', 'project_mgr_designer.user_id')
				->join('contacts', 'contacts.id', '=', 'project_mgr_designer.project_mgr_designer_id')
				->where('project_mgr_designer.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('project_mgr_designer')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'project_mgr_designer.project_id')
				->join('users', 'users.id', '=', 'project_mgr_designer.user_id')
				->join('contacts', 'contacts.id', '=', 'project_mgr_designer.project_mgr_designer_id')
				->where('project_mgr_designer.status', 2)
				->where('project_mgr_designer.project_mgr_designer_id', Input::get('hid_mngr_designer'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'MANAGER-DESIGNER(IN-COMPANY)' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Manager-Designer(In-Company)', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Manager-Designer(In-Company)'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'MANAGER OR DESIGNER NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_sub_mngrdesigner()
	{
		$pagetitle = 'Project List - Project Mngr/Designer(Individual)';

		$mgr_designer = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 10)
					->where('contacts.category', 2)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_sub_mgrdesigner = DB::table('sub_project_mgr_designer')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
					->join('projects', 'projects.id', '=', 'sub_project_mgr_designer.project_id')
					->join('users', 'users.id', '=', 'sub_project_mgr_designer.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_project_mgr_designer.sub_project_mgr_designer_id')
					->where('sub_project_mgr_designer.status', 2)
					->get();

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_sub_mgrdesigner = DB::table('sub_project_mgr_designer')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_project_mgr_designer.project_id')
				->join('users', 'users.id', '=', 'sub_project_mgr_designer.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_project_mgr_designer.sub_project_mgr_designer_id')
				->where('sub_project_mgr_designer.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_mgrdesub_signer = DB::table('sub_project_mgr_designer')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_project_mgr_designer.project_id')
				->join('users', 'users.id', '=', 'sub_project_mgr_designer.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_project_mgr_designer.sub_project_mgr_designer_id')
				->where('sub_project_mgr_designer.status', 2)
				->where('sub_project_mgr_designer.sub_project_mgr_designer_id', Input::get('project_mgr_designer'))
				->get();
			}			
			
			$project_mgr_designer = DB::table('contacts')
				->select('id', 'fullname')
				->where('id', Input::get('project_mgr_designer'))
				->first();									
		}
		return View::make('reports.project-via-sub-mgrdesigner', compact('pagetitle','project_mgr_designer','project_via_sub_mgrdesigner','mgr_designer'));
	}

	public function project_via_sub_mgrdesigners_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_mngr_designer');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('sub_project_mgr_designer')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'sub_project_mgr_designer.project_id')
					->join('users', 'users.id', '=', 'sub_project_mgr_designer.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_project_mgr_designer.sub_project_mgr_designer_id')
					->where('sub_project_mgr_designer.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'MANAGER-DESIGNER(INDIVIDUAL)' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('sub_project_mgr_designer')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_project_mgr_designer.project_id')
				->join('users', 'users.id', '=', 'sub_project_mgr_designer.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_project_mgr_designer.sub_project_mgr_designer_id')
				->where('sub_project_mgr_designer.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('sub_project_mgr_designer')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_project_mgr_designer.project_id')
				->join('users', 'users.id', '=', 'sub_project_mgr_designer.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_project_mgr_designer.sub_project_mgr_designer_id')
				->where('sub_project_mgr_designer.status', 2)
				->where('sub_project_mgr_designer.sub_project_mgr_designer_id', Input::get('hid_mngr_designer'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'MANAGER-DESIGNER(INDIVIDUAL)' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Manager-Designer(Individual)', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Manager-Designer(Individual)'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'MANAGER OR DESIGNER NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_architect()
	{
		$pagetitle = 'Project List - Architect(In-Company)';

		$arch = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 7)
					->where('contacts.category', 1)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_architect = DB::table('architect')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
					->join('projects', 'projects.id', '=', 'architect.project_id')
					->join('users', 'users.id', '=', 'architect.user_id')
					->join('contacts', 'contacts.id', '=', 'architect.architect_id')
					->where('architect.status', 2)
					->get();

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_architect = DB::table('architect')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'architect.project_id')
				->join('users', 'users.id', '=', 'architect.user_id')
				->join('contacts', 'contacts.id', '=', 'architect.architect_id')
				->where('architect.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_architect = DB::table('architect')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'architect.project_id')
				->join('users', 'users.id', '=', 'architect.user_id')
				->join('contacts', 'contacts.id', '=', 'architect.architect_id')
				->where('architect.status', 2)
				->where('architect.architect_id', Input::get('architect'))
				->get();
			}			
			
			$architect = DB::table('contacts')
				->select('id', 'fullname')
				->where('id', Input::get('architect'))
				->first();									
		}
		return View::make('reports.project-via-architect', compact('pagetitle','architect','project_via_architect','arch'));
	}

	public function project_via_architects_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_arch');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('architect')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'architect.project_id')
					->join('users', 'users.id', '=', 'architect.user_id')
					->join('contacts', 'contacts.id', '=', 'architect.architect_id')
					->where('architect.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-ARCHITECT(IN-COMPANY)' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('architect')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'architect.project_id')
				->join('users', 'users.id', '=', 'architect.user_id')
				->join('contacts', 'contacts.id', '=', 'architect.architect_id')
				->where('architect.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('architect')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'architect.project_id')
				->join('users', 'users.id', '=', 'architect.user_id')
				->join('contacts', 'contacts.id', '=', 'architect.architect_id')
				->where('architect.status', 2)
				->where('architect.architect_id', Input::get('hid_arch'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-ARCHITECT(IN-COMPANY)' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Search by Architect(In-Company)', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Project List - Architect(In-Company)'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'ARCHITECT NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_sub_architect()
	{
		$pagetitle = 'Project List - Architect(Individual)';

		$sub_architect = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 7)
					->where('contacts.category', 2)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_sub_architect = DB::table('sub_architect')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
					->join('projects', 'projects.id', '=', 'sub_architect.project_id')
					->join('users', 'users.id', '=', 'sub_architect.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_architect.sub_architect_id')
					->where('sub_architect.status', 2)
					->get();

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_sub_architect = DB::table('sub_architect')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_architect.project_id')
				->join('users', 'users.id', '=', 'sub_architect.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_architect.sub_architect_id')
				->where('sub_architect.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_sub_architect = DB::table('sub_architect')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_architect.project_id')
				->join('users', 'users.id', '=', 'sub_architect.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_architect.sub_architect_id')
				->where('sub_architect.status', 2)
				->where('sub_architect.sub_architect_id', Input::get('sub_architect'))
				->get();
			}			
			
			$project_sub_architect = DB::table('contacts')
				->select('id', 'fullname')
				->where('id', Input::get('sub_architect'))
				->first();									
		}
		return View::make('reports.project-via-sub-architect', compact('pagetitle','sub_architect','project_via_sub_architect','project_sub_architect'));
	}

	public function project_via_sub_architect_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_arch');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('sub_architect')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'sub_architect.project_id')
					->join('users', 'users.id', '=', 'sub_architect.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_architect.sub_architect_id')
					->where('sub_architect.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-ARCHITECT(INDIVIDUAL)' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('sub_architect')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_architect.project_id')
				->join('users', 'users.id', '=', 'sub_architect.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_architect.sub_architect_id')
				->where('sub_architect.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('sub_architect')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_architect.project_id')
				->join('users', 'users.id', '=', 'sub_architect.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_architect.sub_architect_id')
				->where('sub_architect.status', 2)
				->where('sub_architect.sub_architect_id', Input::get('hid_arch'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-ARCHITECT(INDIVIDUAL)' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Search by Architect(Individual)', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Project List - Architect(Individual)'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'ARCHITECT NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_applicator()
	{
		$pagetitle = 'Project List - Applicator';

		$app = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 11)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_applicator = DB::table('applicator')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'applicator.project_id')
					->join('users', 'users.id', '=', 'applicator.user_id')
					->join('contacts', 'contacts.id', '=', 'applicator.applicator_id')
					->where('applicator.status', 2)
					->get();		

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_applicator = DB::table('applicator')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'applicator.project_id')
				->join('users', 'users.id', '=', 'applicator.user_id')
				->join('contacts', 'contacts.id', '=', 'applicator.applicator_id')
				->where('applicator.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_applicator = DB::table('applicator')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'applicator.project_id')
				->join('users', 'users.id', '=', 'applicator.user_id')
				->join('contacts', 'contacts.id', '=', 'applicator.applicator_id')
				->where('applicator.status', 2)
				->where('applicator.applicator_id', Input::get('applicator'))
				->get();
			}			
			
			$applicator = DB::table('contacts')
						->select('id', 'fullname')
						->where('id', Input::get('applicator'))
						->first();							
			
		}
		
		return View::make('reports.project-via-applicator', compact('pagetitle','app','project_via_applicator','applicator'));
	}

	public function project_via_applicators_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_app');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('applicator')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'applicator.project_id')
					->join('users', 'users.id', '=', 'applicator.user_id')
					->join('contacts', 'contacts.id', '=', 'applicator.applicator_id')
					->where('applicator.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-APPLICATOR' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('applicator')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'applicator.project_id')
				->join('users', 'users.id', '=', 'applicator.user_id')
				->join('contacts', 'contacts.id', '=', 'applicator.applicator_id')
				->where('applicator.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('applicator')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'applicator.project_id')
				->join('users', 'users.id', '=', 'applicator.user_id')
				->join('contacts', 'contacts.id', '=', 'applicator.applicator_id')
				->where('applicator.status', 2)
				->where('applicator.applicator_id', Input::get('hid_app'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-APPLICATOR' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Search by Applicator', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Project List - Applicator'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'APPLICATOR NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_sub_applicator()
	{
		$pagetitle = 'Project List - Sub-Applicator';

		$app = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 17)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_sub_applicator = DB::table('sub_applicator')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'sub_applicator.project_id')
					->join('users', 'users.id', '=', 'sub_applicator.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_applicator.sub_applicator_id')
					->where('sub_applicator.status', 2)
					->get();		

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_sub_applicator = DB::table('sub_applicator')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_applicator.project_id')
				->join('users', 'users.id', '=', 'sub_applicator.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_applicator.sub_applicator_id')
				->where('sub_applicator.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_sub_applicator = DB::table('sub_applicator')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_applicator.project_id')
				->join('users', 'users.id', '=', 'sub_applicator.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_applicator.sub_applicator_id')
				->where('sub_applicator.status', 2)
				->where('sub_applicator.sub_applicator_id', Input::get('applicator'))
				->get();
			}			
			
			$applicator = DB::table('contacts')
						->select('id', 'fullname')
						->where('id', Input::get('applicator'))
						->first();							
			
		}
		
		return View::make('reports.project-via-sub-applicator', compact('pagetitle','app','project_via_sub_applicator','applicator'));
	}

	public function project_via_sub_applicators_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_app');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('sub_applicator')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'sub_applicator.project_id')
					->join('users', 'users.id', '=', 'sub_applicator.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_applicator.sub_applicator_id')
					->where('sub_applicator.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-SUB-APPLICATOR' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('sub_applicator')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_applicator.project_id')
				->join('users', 'users.id', '=', 'sub_applicator.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_applicator.sub_applicator_id')
				->where('sub_applicator.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('sub_applicator')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_applicator.project_id')
				->join('users', 'users.id', '=', 'sub_applicator.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_applicator.sub_applicator_id')
				->where('sub_applicator.status', 2)
				->where('sub_applicator.sub_applicator_id', Input::get('hid_app'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-SUB-APPLICATOR' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Search by Sub-Applicator', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Project List - Sub-Applicator'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'SUB-APPLICATOR NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_dealersupplier()
	{
		$pagetitle = 'Project List - Dealer/Supplier';

		$deal_supp = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 12)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_dealsupp = DB::table('dealer_supplier')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'dealer_supplier.project_id')
					->join('users', 'users.id', '=', 'dealer_supplier.user_id')
					->join('contacts', 'contacts.id', '=', 'dealer_supplier.dealer_supplier_id')
					->where('dealer_supplier.status', 2)
					->get();		

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_dealsupp = DB::table('dealer_supplier')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'dealer_supplier.project_id')
				->join('users', 'users.id', '=', 'dealer_supplier.user_id')
				->join('contacts', 'contacts.id', '=', 'dealer_supplier.dealer_supplier_id')
				->where('dealer_supplier.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_dealsupp = DB::table('dealer_supplier')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'dealer_supplier.project_id')
				->join('users', 'users.id', '=', 'dealer_supplier.user_id')
				->join('contacts', 'contacts.id', '=', 'dealer_supplier.dealer_supplier_id')
				->where('dealer_supplier.status', 2)
				->where('dealer_supplier.dealer_supplier_id', Input::get('dealer_supplier'))
				->get();
			}			
			
			$dealer_supplier = DB::table('contacts')
						->select('id', 'fullname')
						->where('id', Input::get('applicator'))
						->first();							
			
		}
		
		return View::make('reports.project-via-dealersupplier', compact('pagetitle','deal_supp','project_via_dealsupp','dealer_supplier'));
	}

	public function project_via_dealersuppliers_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_deal_supp');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('dealer_supplier')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'dealer_supplier.project_id')
					->join('users', 'users.id', '=', 'dealer_supplier.user_id')
					->join('contacts', 'contacts.id', '=', 'dealer_supplier.dealer_supplier_id')
					->where('dealer_supplier.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-DEALER-SUPPLIER' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('dealer_supplier')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'dealer_supplier.project_id')
				->join('users', 'users.id', '=', 'dealer_supplier.user_id')
				->join('contacts', 'contacts.id', '=', 'dealer_supplier.dealer_supplier_id')
				->where('dealer_supplier.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('dealer_supplier')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'dealer_supplier.project_id')
				->join('users', 'users.id', '=', 'dealer_supplier.user_id')
				->join('contacts', 'contacts.id', '=', 'dealer_supplier.dealer_supplier_id')
				->where('dealer_supplier.status', 2)
				->where('dealer_supplier.dealer_supplier_id', Input::get('hid_deal_supp'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-DEALER-SUPPLIER' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Search by Dealer-Supplier', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Project List - Dealer-Supplier'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'DEALER OR SUPPLIER NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}

	public function project_via_sub_dealersupplier()
	{
		$pagetitle = 'Project List - Sub-Dealer/Supplier';

		$deal_supp = DB::table('contacts')
					->select('contacts.id','contacts.fullname')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->where('contacts.status', '<', 3)
					->where('contacts.status', '<>', 1)
					->where('positions.id', 18)
					->orderBy('fullname', 'asc')
					->lists('fullname', 'id');

		if(Input::get('agree_value') == 1)
		{
			$project_via_sub_dealsupp = DB::table('sub_dealer_supplier')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'sub_dealer_supplier.project_id')
					->join('users', 'users.id', '=', 'sub_dealer_supplier.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_dealer_supplier.sub_dealer_supplier_id')
					->where('sub_dealer_supplier.status', 2)
					->get();		

		}else{

			if(Input::get('date_from') || Input::get('date_to'))
			{
			 $project_via_sub_dealsupp = DB::table('sub_dealer_supplier')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_dealer_supplier.project_id')
				->join('users', 'users.id', '=', 'sub_dealer_supplier.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_dealer_supplier.sub_dealer_supplier_id')
				->where('sub_dealer_supplier.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $project_via_sub_dealsupp = DB::table('sub_dealer_supplier')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as bdo_name, projects.project_name, contacts.fullname'))
				->join('projects', 'projects.id', '=', 'sub_dealer_supplier.project_id')
				->join('users', 'users.id', '=', 'sub_dealer_supplier.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_dealer_supplier.sub_dealer_supplier_id')
				->where('sub_dealer_supplier.status', 2)
				->where('sub_dealer_supplier.sub_dealer_supplier_id', Input::get('dealer_supplier'))
				->get();
			}			
			
			$dealer_supplier = DB::table('contacts')
						->select('id', 'fullname')
						->where('id', Input::get('dealer_supplier'))
						->first();							
			
		}
		
		return View::make('reports.project-via-sub-dealersupplier', compact('pagetitle','deal_supp','project_via_sub_dealsupp','dealer_supplier'));
	}

	public function project_via_sub_dealersuppliers_print()
	{
		$agree = Input::get('hid_agree_val');
		$searchby = Input::get('hid_deal_supp');
		$from = Input::get('hid_from');
		$to = Input::get('hid_to');

		$data = array();

		if($agree == 1)
		{
			$result = DB::table('sub_dealer_supplier')
					->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
					->join('projects', 'projects.id', '=', 'sub_dealer_supplier.project_id')
					->join('users', 'users.id', '=', 'sub_dealer_supplier.user_id')
					->join('contacts', 'contacts.id', '=', 'sub_dealer_supplier.sub_dealer_supplier_id')
					->where('sub_dealer_supplier.status', 2)
					->get();

			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}				 

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-SUB-DEALER-SUPPLIER' . '-' . Session::get('fullname');

		}else{
			
			if($from || $to)
			{
			 $result = DB::table('sub_dealer_supplier')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_dealer_supplier.project_id')
				->join('users', 'users.id', '=', 'sub_dealer_supplier.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_dealer_supplier.sub_dealer_supplier_id')
				->where('sub_dealer_supplier.status', 2)
				->where('projects.painting_dtstart', '>=', Input::get('date_from'))
				->where('projects.painting_dtend', '<=', Input::get('date_to'))
				->get();

			}else{
			 $result = DB::table('sub_dealer_supplier')
				->select(DB::raw('contacts.fullname, projects.project_name, concat(users.first_name, " " ,users.last_name) as bdo_name'))
				->join('projects', 'projects.id', '=', 'sub_dealer_supplier.project_id')
				->join('users', 'users.id', '=', 'sub_dealer_supplier.user_id')
				->join('contacts', 'contacts.id', '=', 'sub_dealer_supplier.sub_dealer_supplier_id')
				->where('sub_dealer_supplier.status', 2)
				->where('sub_dealer_supplier.sub_dealer_supplier_id', Input::get('hid_deal_supp'))
				->get();
			}
			
			foreach($result as $row)
			{
				$row->fullname = $row->fullname;
				$row->project_name = $row->project_name;
				$row->bdo_name = $row->bdo_name;
				$data[] = (array)$row;	
			}	

			$filename = date('m-d-Y') . '-' . 'PROJECT-LIST-SUB-DEALER-SUPPLIER' . '-' . Session::get('fullname');								
		}
			
			Excel::create($filename, function ($excel) use($data) {

			    $excel->sheet('Search by Sub-Dealer-Supplier', function ($sheet) use($data) {

			        // first row styling and writing content
			        $sheet->mergeCells('A1:W1');
			        $sheet->row(1, function ($row) {
			            $row->setFontFamily('Tahoma');
			            $row->setFontSize(15);
			        });

			        $sheet->row(1, array('Project List - Sub-Dealer-Supplier'));

			        // second row styling and writing content
			        // $sheet->row(2, function ($row) {

			        //     // call cell manipulation methods
			        //     $row->setFontFamily('Comic Sans MS');
			        //     $row->setFontSize(15);
			        //     $row->setFontWeight('bold');

			        // });

			        // $sheet->row(2, array('Something else here'));

			        // getting data to display - in my case only one record
			        $users = $data;

			        // setting column names for data - you can of course set it manually
			        $sheet->appendRow(array_keys($users[0])); // column names

			        $sheet->row(2, array(
					     'SUB-DEALER OR SUPPLIER NAME', 'PROJECT NAME','PREPARED BDO'
					));
			        // getting last row number (the one we already filled and setting it to bold
			        $sheet->row($sheet->getHighestRow(), function ($row) {
			            $row->setFontWeight('bold');
			        });

			        // putting users data as next rows
			        foreach ($users as $user) {
			            $sheet->appendRow($user);
			        }
			    });

		})->export('xlsx');


	}


}