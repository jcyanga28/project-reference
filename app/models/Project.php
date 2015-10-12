<?php

class Project extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'bdo' => 'required',
			'area_region' => 'required',	
			'project_name' => 'required',
			'project_owner' => 'required',
			'street' => 'required',
			'city' => 'required',
			'country' => 'required',
			'project_classification' => 'required',
			'project_category' => 'required',
			'project_stage' => 'required',
			// 'project_status' => 'required',
			// 'date_reported' => 'required',
			// 'bdo' => 'required',
			// 'area_region' => 'required',
			// 'developer' => 'required',
			// 'general_contractor' => 'required',
			// 'project_mgr_designer' => 'required',
			// 'architect' => 'required',
			// 'applicator' => 'required',
			// 'dealer_supplier' => 'required',
			// 'project_status' => 'required',
			// 'project_details' => 'required',
			// 'painting_dtstart' => 'required',
			// 'painting_dtend' => 'required',
			// 'painting_specification' => 'required',
			// 'area_sqm' => 'required',
			// 'painting_req' => 'required',
			// 'painting_cost' => 'required',
			// 'image' => 'required|mimes:pdf,gif,jpg,png,txt,xls,xlsx,doc,docx,jpeg,bmp,csv|integerorArray',

		);

	public static $updaterules = array(
			'bdo' => 'required',
			'area' => 'required',	
			'project_name' => 'required',
			'project_owner' => 'required',
			'street' => 'required',
			'city' => 'required',
			'country' => 'required',
			'project_classification' => 'required',
			'project_category' => 'required',
			'project_stage' => 'required',	
			// 'project_status' => 'required',
			// 'date_reported' => 'required',
			//'bdo' => 'required',
			// 'area' => 'required',
			// 'project_name' => 'required',
			// 'project_owner' => 'required',
			// 'developer' => 'required',
			// 'general_contractor' => 'required',
			// 'project_mgr_designer' => 'required',
			// 'architect' => 'required',
			// 'applicator' => 'required',
			// 'dealer_supplier' => 'required',
			// 'project_classification' => 'required',
			// 'project_category' => 'required',
			// 'project_stage' => 'required',
			// 'project_status' => 'required',
			// 'project_details' => 'required',
			// 'painting_dtstart' => 'required',
			// 'painting_dtend' => 'required',
			// 'painting_specification' => 'required',
			// 'area_sqm' => 'required',
			// 'painting_req' => 'required',
			// 'painting_cost' => 'required',

		);

	public static function select_projects_all($filter,$search,$id)
	{
		return DB::table('projects')
					->select('projects.*', 'users.first_name', 'users.last_name', 'areas.area_place')
					->join('users', 'users.id', '=', 'projects.bdo_id')
					->join('areas', 'areas.id', '=', 'projects.area_id')
					// ->join('contacts', 'contacts.id', '=', 'projects.developer')			
					->where('projects.status', $filter)
					->where(function($query) use ($search){
					$query->where('projects.project_name', 'LIKE' ,"%$search%")
						->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%")
						->orwhere('areas.area_place', 'LIKE' ,"%$search%")
						->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
						->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
						// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
					})
					->orderBy('project_name', 'asc')
					->paginate(10);
					// ->get();
	}

	public static function select_projects($id,$filter,$search)
	{
		return DB::table('projects')
					->select('projects.*', 'users.first_name', 'users.last_name', 'areas.area_place')
					->join('users', 'users.id', '=', 'projects.bdo_id')
					->join('areas', 'areas.id', '=', 'projects.area_id')
					// ->join('contacts', 'contacts.id', '=', 'projects.developer')											
					->where('projects.created_by', $id)
					->where('projects.status', $filter)
					->where(function($query) use ($search){
					$query->where('projects.project_name', 'LIKE' ,"%$search%")
						->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%")
						->orwhere('areas.area_place', 'LIKE' ,"%$search%")
						->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
						->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
						// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
					})
					->orderBy('project_name', 'asc')
					->paginate(10);
					// ->get();
	}

	public static function selectprojectid()
	{
		$proj_id = DB::table('projects')
					->select(DB::raw('max(id) as project_id'))
					->first();

		return $proj_id->project_id + 1;
	}

	public static function selectbdo_list()
	{
		return DB::table('assigned_areas')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, assigned_areas.user_id'))
					->join('users', 'users.id', '=', 'assigned_areas.user_id')
					->orderBy('fullname', 'asc')
					->lists('fullname', 'user_id');
	}

	public static function select_arealist($bdo_id)
	{
		return DB::table('assigned_areas')
					->select(DB::raw('concat(areas.area_no," ","-"," ",areas.area_place) as area, assigned_areas.area_id'))
					->join('areas', 'areas.id', '=', 'assigned_areas.area_id')
					->where('assigned_areas.user_id', $bdo_id)
					->orderBy('area', 'asc')
					->get();
					// ->lists('area', 'area_id');
	}

	public static function select_developer_forcompany()
	{
		return DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('contacts.category', 1)
					->where('positions.id', 8)
					->orderBy('full_info', 'asc')
					// ->get();
					->lists('full_info', 'contact_id');
	
	}

	public static function select_developer_forindiv()
	{	
		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					// ->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('contacts.category', 2)
					->where('positions.id', 8)
					->orderBy('full_info', 'asc')
					// ->get();
					->lists('full_info', 'contact_id');

	}

	// public static function select_sub_developer()
	// {
	// 	$withcompany = DB::table('contacts')
	// 				->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
	// 				->join('companies', 'companies.id', '=', 'contacts.company')
	// 				->join('positions', 'positions.id', '=', 'contacts.position')
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.status', 2)
	// 				->where('positions.id', 13)
	// 				->orderBy('full_info', 'asc');
	// 				// ->get();
	// 				// ->lists('full_info', 'contact_id');
		
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
	// 				// ->join('companies', 'companies.id', '=', 'contacts.company')
	// 				->join('positions', 'positions.id', '=', 'contacts.position')
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.status', 2)
	// 				->where('positions.id', 13)
	// 				->orderBy('full_info', 'asc')
	// 				// ->get();
	// 				->union($withcompany)
	// 				->lists('full_info', 'contact_id');

	// }

	public static function select_gencon_forcompany()
	{
		return DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('contacts.category', 1)
					->where('positions.id', 9)
					->orderBy('full_info', 'asc')
					// ->get();
					->lists('full_info', 'contact_id');
	
	}

	public static function select_gencon_forindiv()
	{	
		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					// ->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('contacts.category', 2)
					->where('positions.id', 9)
					->orderBy('full_info', 'asc')
					// ->get();
					->lists('full_info', 'contact_id');

	}

	// public static function select_sub_gencon()
	// {
	// 	$withcompany = DB::table('contacts')
	// 				->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
	// 				->join('companies', 'companies.id', '=', 'contacts.company')
	// 				->join('positions', 'positions.id', '=', 'contacts.position')
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.status', 2)
	// 				->where('positions.id', 14)
	// 				->orderBy('full_info', 'asc');
	// 				// ->get();
	// 				// ->lists('full_info', 'contact_id');
		
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
	// 				// ->join('companies', 'companies.id', '=', 'contacts.company')
	// 				->join('positions', 'positions.id', '=', 'contacts.position')
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.status', 2)
	// 				->where('positions.id', 14)
	// 				->orderBy('full_info', 'asc')
	// 				// ->get();
	// 				->union($withcompany)
	// 				->lists('full_info', 'contact_id');

	// }

	public static function select_project_managerdesigner_forcompany()
	{
		return DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('contacts.category', 1)
					->where('positions.id', 10)
					->orderBy('full_info', 'asc')
					// ->get();
					->lists('full_info', 'contact_id');
	}

	public static function select_project_managerdesigner_forindiv()
	{	
		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					// ->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('contacts.category', 2)
					->where('positions.id', 10)
					->orderBy('full_info', 'asc')
					// ->get();
					->lists('full_info', 'contact_id');
	}

	// public static function select_sub_project_managerdesigner()
	// {
	// 	$withcompany = DB::table('contacts')
	// 				->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
	// 				->join('companies', 'companies.id', '=', 'contacts.company')
	// 				->join('positions', 'positions.id', '=', 'contacts.position')
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.status', 2)
	// 				->where('positions.id', 15)
	// 				->orderBy('full_info', 'asc');
	// 				// ->get();
	// 				// ->lists('full_info', 'contact_id');
		
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
	// 				// ->join('companies', 'companies.id', '=', 'contacts.company')
	// 				->join('positions', 'positions.id', '=', 'contacts.position')
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.status', 2)
	// 				->where('positions.id', 15)
	// 				->orderBy('full_info', 'asc')
	// 				// ->get();
	// 				->union($withcompany)
	// 				->lists('full_info', 'contact_id');

	// }

	public static function select_architect_forcompany()
	{
		return DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('contacts.category', 1)
					->where('positions.id', 7)
					->orderBy('full_info', 'asc')
					// ->get();
					->lists('full_info', 'contact_id');
	}

	public static function select_architect_forindiv()
	{	
		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					// ->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('contacts.category', 2)
					->where('positions.id', 7)
					->orderBy('full_info', 'asc')
					// ->get();
					->lists('full_info', 'contact_id');
	}

	public static function select_sub_architect()
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('positions.id', 16)
					->orderBy('full_info', 'asc');
					// ->get();
					// ->lists('full_info', 'contact_id');
		
		return DB::table('contacts')
					->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					// ->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('positions.id', 16)
					->orderBy('full_info', 'asc')
					// ->get();
					->union($withcompany)
					->lists('full_info', 'contact_id');

	}

	public static function select_applicator()
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('positions.id', 11)
					->orderBy('full_info', 'asc');
					// ->get();
					// ->lists('full_info', 'contact_id');
		
		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					// ->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('positions.id', 11)
					->orderBy('full_info', 'asc')
					// ->get();
					->union($withcompany)
					->lists('full_info', 'contact_id');

	}

	public static function select_sub_applicator()
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('positions.id', 17)
					->orderBy('full_info', 'asc');
					// ->get();
					// ->lists('full_info', 'contact_id');
		
		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					// ->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('positions.id', 17)
					->orderBy('full_info', 'asc')
					// ->get();
					->union($withcompany)
					->lists('full_info', 'contact_id');

	}

	public static function select_dealersupplier()
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('positions.id', 12)
					->orderBy('full_info', 'asc');
					// ->get();
					// ->lists('full_info', 'contact_id');
		
		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					// ->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('positions.id', 12)
					->orderBy('full_info', 'asc')
					// ->get();
					->union($withcompany)
					->lists('full_info', 'contact_id');

	}

	public static function select_sub_dealersupplier()
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('positions.id', 18)
					->orderBy('full_info', 'asc');
					// ->get();
					// ->lists('full_info', 'contact_id');
		
		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as full_info, contacts.id as contact_id'))
					// ->join('companies', 'companies.id', '=', 'contacts.company')
					->join('positions', 'positions.id', '=', 'contacts.position')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->where('contacts.status', 2)
					->where('positions.id', 18)
					->orderBy('full_info', 'asc')
					// ->get();
					->union($withcompany)
					->lists('full_info', 'contact_id');

	}

	public static function select_contactandcompany_list()
	{
		return DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as full_info, companies.id as company_id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->where('contacts.status', 2)
					->orderBy('full_info', 'asc')
					// ->get();
					->lists('full_info', 'contact_id');
	}

	public static function select_projclassification_list()
	{
		return DB::table('classifications')
					->orderBy('classification', 'asc')
					->lists('classification', 'id');
	}

	public static function select_projcategory_list()
	{
		return DB::table('categories')
					->select(DB::raw('concat(category," ","-"," ",description) as record, id'))
					->orderBy('record', 'asc')
					->lists('record', 'id');
	}

	public static function select_projstage_list()
	{
		return DB::table('stages')
					->select(DB::raw('concat(stage) as record, id'))
					->orderBy('record', 'asc')
					->lists('record', 'id');
	}

	public static function select_projstatus_list()
	{
		return DB::table('statuses')
					->select(DB::raw('concat(status) as record, id'))
					->orderBy('record', 'asc')
					->lists('record', 'id');
	}

	public static function checkifexist($project)
	{
		return DB::table('projects')
					->where('project_name', $project->project_name)
					->where('project_owner', $project->project_owner)
					->where('painting_dtstart', $project->painting_dtstart)
					->where('painting_dtend', $project->painting_dtend)
					->first();
	}

	public static function select_projectdetails($id)
	{
		return DB::table('projects')
					->select('projects.*','projects.status as current_stats', 'users.first_name', 'users.last_name', 'areas.area_place', 'classifications.classification', 'categories.category', 'stages.stage')
					->join('users', 'users.id', '=', 'projects.bdo_id')
					->join('areas', 'areas.id', '=', 'projects.area_id')
					->join('classifications', 'classifications.id', '=', 'projects.project_classification')
					->join('categories', 'categories.id', '=', 'projects.project_category')
					->join('stages', 'stages.id', '=', 'projects.project_stage')
					// ->join('statuses', 'statuses.id', '=', 'projects.project_status')
					->where('projects.id', $id)
					->first();
	}

	public static function get_city($id)
	{
		return DB::table('projects')
				->select('cities.city', 'projects.id')
				->join('cities', 'cities.id', '=', 'projects.city')
				->where('projects.id', $id)
				->first();
	}

	public static function get_developer($id)
	{
		return DB::table('contacts')
			->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as developer_record, users.id, contacts.id as contact_id'))
			->join('companies', 'companies.id', '=', 'contacts.company')
			->join('users', 'users.id', '=', 'contacts.created_by')
			->join('developer', 'developer.developer_id', '=', 'contacts.id')
			->where('contacts.status', 2)
			->where('contacts.category', 1)
			->where('developer.project_id', $id)
			->orderBy('developer_record', 'asc')
			->get();
	}

	public static function get_sub_developer($id)
	{
		return DB::table('contacts')
			->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as developer_record, users.id, contacts.id as contact_id'))
			->join('users', 'users.id', '=', 'contacts.created_by')
			->join('sub_developer', 'sub_developer.sub_developer_id', '=', 'contacts.id')
			->where('contacts.status', 2)
			->where('contacts.category', 2)
			->where('sub_developer.project_id', $id)
			->orderBy('developer_record', 'asc')
			->get();
	}

	// public static function get_developer_ind($project_detail)
	// {
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as developer_record, users.id'))
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.id', $project_detail->developer)
	// 				->first();
	// }

	public static function get_generalcontractor($id)
	{
		return DB::table('contacts')
			->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as generalcontractor_record, users.id, contacts.id as contact_id'))
			->join('companies', 'companies.id', '=', 'contacts.company')
			->join('users', 'users.id', '=', 'contacts.created_by')
			->join('gencon', 'gencon.gencon_id', '=', 'contacts.id')
			->where('contacts.status', 2)
			->where('contacts.category', 1)
			->where('gencon.project_id', $id)
			->orderBy('generalcontractor_record', 'asc')
			->get();
	}

	public static function get_sub_generalcontractor($id)
	{
		return DB::table('contacts')
			->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as generalcontractor_record, users.id, contacts.id as contact_id'))
			->join('users', 'users.id', '=', 'contacts.created_by')
			->join('sub_gencon', 'sub_gencon.sub_gencon_id', '=', 'contacts.id')
			->where('contacts.status', 2)
			->where('contacts.category', 2)
			->where('sub_gencon.project_id', $id)
			->orderBy('generalcontractor_record', 'asc')
			->get();
	}

	// public static function get_generalcontractor_ind($project_detail)
	// {
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as generalcontractor_record, users.id'))
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.id', $project_detail->general_contractor)
	// 				->first();
	// }

	public static function get_projectmgrdesigner($id)
	{
		return DB::table('contacts')
			->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as projectmgrdesigner_record, users.id, contacts.id as contact_id'))
			->join('companies', 'companies.id', '=', 'contacts.company')
			->join('users', 'users.id', '=', 'contacts.created_by')
			->join('project_mgr_designer', 'project_mgr_designer.project_mgr_designer_id', '=', 'contacts.id')
			->where('contacts.status', 2)
			->where('contacts.category', 1)
			->where('project_mgr_designer.project_id', $id)
			->orderBy('projectmgrdesigner_record', 'asc')
			->get();
	}

	public static function get_sub_projectmgrdesigner($id)
	{
		return DB::table('contacts')
			->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as projectmgrdesigner_record, users.id, contacts.id as contact_id'))
			->join('users', 'users.id', '=', 'contacts.created_by')
			->join('sub_project_mgr_designer', 'sub_project_mgr_designer.sub_project_mgr_designer_id', '=', 'contacts.id')
			->where('contacts.status', 2)
			->where('contacts.category', 2)
			->where('sub_project_mgr_designer.project_id', $id)
			->orderBy('projectmgrdesigner_record', 'asc')
			->get();
	}

	// public static function get_projectmgrdesigner_ind($project_detail)
	// {
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as projectmgrdesigner_record, users.id'))
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.id', $project_detail->project_mgr_designer)
	// 				->first();
	// }

	public static function get_architect($id)
	{
		return DB::table('contacts')
			->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as architect_record, users.id, contacts.id as contact_id'))
			->join('companies', 'companies.id', '=', 'contacts.company')
			->join('users', 'users.id', '=', 'contacts.created_by')
			->join('architect', 'architect.architect_id', '=', 'contacts.id')
			->where('contacts.status', 2)
			->where('contacts.category', 1)
			->where('architect.project_id', $id)
			->orderBy('architect_record', 'asc')
			->get();
	}

	public static function get_sub_architect($id)
	{
		return DB::table('contacts')
			->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as architect_record, users.id, contacts.id as contact_id'))
			->join('users', 'users.id', '=', 'contacts.created_by')
			->join('sub_architect', 'sub_architect.sub_architect_id', '=', 'contacts.id')
			->where('contacts.status', 2)
			->where('contacts.category', 2)
			->where('sub_architect.project_id', $id)
			->orderBy('architect_record', 'asc')
			->get();
	}

	// public static function get_architect_ind($project_detail)
	// {
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as architect_record, users.id'))
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.id', $project_detail->architect)
	// 				->first();
	// }

	public static function get_applicator($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as applicator_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('applicator', 'applicator.applicator_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('applicator.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as applicator_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('applicator', 'applicator.applicator_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('applicator.project_id', $id)
					->orderBy('applicator_record', 'asc')
					->union($withcompany)
					->get();

	}
	public static function get_sub_applicator($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as applicator_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_applicator', 'sub_applicator.sub_applicator_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('sub_applicator.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as applicator_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_applicator', 'sub_applicator.sub_applicator_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('sub_applicator.project_id', $id)
					->orderBy('applicator_record', 'asc')
					->union($withcompany)
					->get();

	}

	// public static function get_applicator_ind($project_detail)
	// {
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as applicator_record, users.id'))
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.id', $project_detail->applicator)
	// 				->first();
	// }

	public static function get_dealersupplier($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as dealersupplier_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('dealer_supplier', 'dealer_supplier.dealer_supplier_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('dealer_supplier.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as dealersupplier_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('dealer_supplier', 'dealer_supplier.dealer_supplier_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('dealer_supplier.project_id', $id)
					->orderBy('dealersupplier_record', 'asc')
					->union($withcompany)
					->get();

	}
	public static function get_sub_dealersupplier($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as dealersupplier_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_dealer_supplier', 'sub_dealer_supplier.sub_dealer_supplier_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('sub_dealer_supplier.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number," ","-"," ","BDO :"," ",users.first_name," ",users.last_name) as dealersupplier_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_dealer_supplier', 'sub_dealer_supplier.sub_dealer_supplier_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('sub_dealer_supplier.project_id', $id)
					->orderBy('dealersupplier_record', 'asc')
					->union($withcompany)
					->get();

	}

	// public static function get_dealersupplier_ind($project_detail)
	// {
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as dealersupplier_record, users.id'))
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.id', $project_detail->dealer_supplier)
	// 				->first();
	// }

	public static function s_get_developer($id)
	{
		return DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as developer_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('developer', 'developer.developer_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('developer.project_id', $id)
					->get();
	}

	public static function s_get_sub_developer($id)
	{
		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number) as developer_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_developer', 'sub_developer.sub_developer_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('sub_developer.project_id', $id)
					->get();

	}

	// public static function get_developer_ind($project_detail)
	// {
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as developer_record, users.id'))
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.id', $project_detail->developer)
	// 				->first();
	// }

	public static function s_get_generalcontractor($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as generalcontractor_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('gencon', 'gencon.gencon_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('gencon.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as generalcontractor_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('gencon', 'gencon.gencon_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('gencon.project_id', $id)
					->union($withcompany)
					->get();

	}
	public static function s_get_sub_generalcontractor($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as generalcontractor_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_gencon', 'sub_gencon.sub_gencon_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('sub_gencon.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as generalcontractor_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_gencon', 'sub_gencon.sub_gencon_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('sub_gencon.project_id', $id)
					->union($withcompany)
					->get();

	}

	// public static function get_generalcontractor_ind($project_detail)
	// {
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as generalcontractor_record, users.id'))
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.id', $project_detail->general_contractor)
	// 				->first();
	// }

	public static function s_get_projectmgrdesigner($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as projectmgrdesigner_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('project_mgr_designer', 'project_mgr_designer.project_mgr_designer_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('project_mgr_designer.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as projectmgrdesigner_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('project_mgr_designer', 'project_mgr_designer.project_mgr_designer_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('project_mgr_designer.project_id', $id)
					->union($withcompany)
					->get();

	}
	public static function s_get_sub_projectmgrdesigner($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as projectmgrdesigner_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_project_mgr_designer', 'sub_project_mgr_designer.sub_project_mgr_designer_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('sub_project_mgr_designer.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as projectmgrdesigner_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_project_mgr_designer', 'sub_project_mgr_designer.sub_project_mgr_designer_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('sub_project_mgr_designer.project_id', $id)
					->union($withcompany)
					->get();

	}

	// public static function get_projectmgrdesigner_ind($project_detail)
	// {
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as projectmgrdesigner_record, users.id'))
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.id', $project_detail->project_mgr_designer)
	// 				->first();
	// }

	public static function s_get_architect($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as architect_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('architect', 'architect.architect_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('architect.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as architect_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('architect', 'architect.architect_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('architect.project_id', $id)
					->union($withcompany)
					->get();

	}
	public static function s_get_sub_architect($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as architect_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_architect', 'sub_architect.sub_architect_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('sub_architect.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as architect_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_architect', 'sub_architect.sub_architect_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('sub_architect.project_id', $id)
					->union($withcompany)
					->get();

	}

	// public static function get_architect_ind($project_detail)
	// {
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as architect_record, users.id'))
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.id', $project_detail->architect)
	// 				->first();
	// }

	public static function s_get_applicator($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as applicator_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('applicator', 'applicator.applicator_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('applicator.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat(contacts.fullname," ","-"," ",contacts.contact_number) as applicator_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('applicator', 'applicator.applicator_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('applicator.project_id', $id)
					->union($withcompany)
					->get();

	}
	public static function s_get_sub_applicator($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as applicator_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_applicator', 'sub_applicator.sub_applicator_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('sub_applicator.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as applicator_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_applicator', 'sub_applicator.sub_applicator_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('sub_applicator.project_id', $id)
					->union($withcompany)
					->get();

	}

	// public static function get_applicator_ind($project_detail)
	// {
	// 	return DB::table('contacts')
	// 				->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as applicator_record, users.id'))
	// 				->join('users', 'users.id', '=', 'contacts.created_by')
	// 				->where('contacts.id', $project_detail->applicator)
	// 				->first();
	// }

	public static function s_get_dealersupplier($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as dealersupplier_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('dealer_supplier', 'dealer_supplier.dealer_supplier_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('dealer_supplier.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as dealersupplier_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('dealer_supplier', 'dealer_supplier.dealer_supplier_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('dealer_supplier.project_id', $id)
					->union($withcompany)
					->get();

	}
	public static function s_get_sub_dealersupplier($id)
	{
		$withcompany = DB::table('contacts')
					->select(DB::raw('concat(companies.company_name," ","-"," ",contacts.fullname," ","-"," ",companies.mobile_number) as dealersupplier_record, users.id, contacts.id as contact_id'))
					->join('companies', 'companies.id', '=', 'contacts.company')
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_dealer_supplier', 'sub_dealer_supplier.sub_dealer_supplier_id', '=', 'contacts.id')
					->where('contacts.category', 1)
					->where('sub_dealer_supplier.project_id', $id);
					// ->get();

		return DB::table('contacts')
					->select(DB::raw('concat("INDIVIDUAL"," ","-"," ",contacts.fullname," ","-"," ",contacts.contact_number) as dealersupplier_record, users.id, contacts.id as contact_id'))
					->join('users', 'users.id', '=', 'contacts.created_by')
					->join('sub_dealer_supplier', 'sub_dealer_supplier.sub_dealer_supplier_id', '=', 'contacts.id')
					->where('contacts.category', 2)
					->where('sub_dealer_supplier.project_id', $id)
					->union($withcompany)
					->get();

	}

	public static function requestProjectsList($filter,$search)
	{
		return DB::table('projects')
					->select('projects.*', 'bdo.first_name as bdo_fname', 'bdo.last_name as bdo_lname', 'prep.first_name as prep_fname', 'prep.last_name as prep_lname', 'areas.area_place')
					->join('users as bdo', 'bdo.id', '=', 'projects.bdo_id')
					->join('users as prep', 'prep.id', '=', 'projects.created_by')
					->join('areas', 'areas.id', '=', 'projects.area_id')
					// ->join('contacts', 'contacts.id', '=', 'projects.developer')	
					->where('projects.status', $filter)
					->where(function($query) use ($search){
					$query->where('projects.project_name', 'LIKE' ,"%$search%")
						->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
						->orwhere('bdo.first_name', 'LIKE' ,"%$search%")
						->orwhere('bdo.last_name', 'LIKE' ,"%$search%")
						->orwhere('areas.area_place', 'LIKE' ,"%$search%")
						->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
						->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
						// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
					})
					->orderBy('project_name', 'asc')
					->paginate(10);
					// ->get();
	}

	public static function selectnfo_fordetails($id)
	{
		return DB::table('projects')
					->select('projects.*', 'projects.status as current_stats', 'users.first_name', 'users.last_name', 'areas.area_place', 'classifications.classification', 'categories.category', 'stages.stage')
					->join('users', 'users.id', '=', 'projects.bdo_id')
					->join('areas', 'areas.id', '=', 'projects.area_id')
					->join('classifications', 'classifications.id', '=', 'projects.project_classification')
					->join('categories', 'categories.id', '=', 'projects.project_category')
					->join('stages', 'stages.id', '=', 'projects.project_stage')
					// ->join('statuses', 'statuses.id', '=', 'projects.project_status')
					->where('projects.id', $id)
					->first();
	}

	public static function selectsameinfo_fordetails($project)
	{
		return DB::table('projects')
				->select('projects.*', 'users.first_name', 'users.last_name')
				->join('users', 'users.id' , '=' , 'projects.bdo_id')
				->where('projects.status', 2)
				->where(function($query) use ($project){
					$projname_keys = explode(" ",$project->project_name);
					$projowner_keys = explode(" ",$project->project_owner);
					$projdtstart_keys = explode(" ",$project->painting_dtstart);
					$projdtend_keys = explode(" ",$project->painting_dtend);
					$dev_keys = explode(" ",$project->developer);
					$gencon_keys = explode(" ",$project->general_contractor);
					$projmgrdes_keys = explode(" ",$project->project_mgr_designer);
					$arch_keys = explode(" ",$project->architect);
					$app_keys = explode(" ",$project->applicator);
					$dealsupp_keys = explode(" ",$project->dealer_supplier);

					$query->where(function($subquery) use ($projname_keys){
						for( $i=0; $i<count($projname_keys); $i++){
							if($projname_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('project_name','LIKE', "%$projname_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('project_name', 'LIKE', "%$projname_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($projowner_keys){
						for( $i=0; $i<count($projowner_keys); $i++){
							if($projowner_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('project_owner','LIKE', "%$projowner_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('project_owner', 'LIKE', "%$projowner_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($projdtstart_keys){
						for( $i=0; $i<count($projdtstart_keys); $i++){
							if($projdtstart_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('painting_dtstart','LIKE', "%$projdtstart_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('painting_dtstart', 'LIKE', "%$projdtstart_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($projdtend_keys){
						for( $i=0; $i<count($projdtend_keys); $i++){
							if($projdtend_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('painting_dtend','LIKE', "%$projdtend_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('painting_dtend', 'LIKE', "%$projdtend_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($dev_keys){
						for( $i=0; $i<count($dev_keys); $i++){
							if($dev_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('developer','LIKE', "%$dev_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('developer', 'LIKE', "%$dev_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($gencon_keys){
						for( $i=0; $i<count($gencon_keys); $i++){
							if($gencon_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('general_contractor','LIKE', "%$gencon_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('general_contractor', 'LIKE', "%$gencon_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($projmgrdes_keys){
						for( $i=0; $i<count($projmgrdes_keys); $i++){
							if($projmgrdes_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('project_mgr_designer','LIKE', "%$projmgrdes_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('project_mgr_designer', 'LIKE', "%$projmgrdes_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($arch_keys){
						for( $i=0; $i<count($arch_keys); $i++){
							if($arch_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('architect','LIKE', "%$arch_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('architect', 'LIKE', "%$arch_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($app_keys){
						for( $i=0; $i<count($app_keys); $i++){
							if($app_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('applicator','LIKE', "%$app_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('applicator', 'LIKE', "%$app_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($dealsupp_keys){
						for( $i=0; $i<count($dealsupp_keys); $i++){
							if($dealsupp_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('dealer_supplier','LIKE', "%$dealsupp_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('dealer_supplier', 'LIKE', "%$dealsupp_keys[$i]%");
						   		}
							}
						}
					});


				})
				->get();
	}

	public static function get_allproject($filter,$search)
	{
		return DB::table('projects')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.*'))
				->join('users', 'users.id', '=', 'projects.created_by')
				->join('users as cc', 'cc.id', '=', 'projects.approved_by')
				// ->join('areas', 'areas.id', '=', 'projects.area_id')
				// ->join('contacts', 'contacts.id', '=', 'projects.developer')
				// ->where('projects.status', $filter)
				->where('projects.status_forthread', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('cc.first_name', 'LIKE' ,"%$search%")
					->orwhere('cc.last_name', 'LIKE' ,"%$search%")
					// ->orwhere('areas.area_place', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
					// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
				})
				->orderBy('id', 'desc')
				->paginate(20);
	}

	public static function get_allproject_count($filter,$search)
	{
		return DB::table('projects')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.*'))
				->join('users', 'users.id', '=', 'projects.created_by')
				->join('users as cc', 'cc.id', '=', 'projects.approved_by')
				// ->join('areas', 'areas.id', '=', 'projects.area_id')
				// ->join('contacts', 'contacts.id', '=', 'projects.developer')
				// ->where('projects.status', $filter)
				->where('projects.status_forthread', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('cc.first_name', 'LIKE' ,"%$search%")
					->orwhere('cc.last_name', 'LIKE' ,"%$search%")
					// ->orwhere('areas.area_place', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
					// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
				})
				->orderBy('id', 'desc')
				->get();
	}

	//--------------------------------//
	public static function get_allprojectclosed($search)
	{
		return DB::table('projects')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.*'))
				->join('users', 'users.id', '=', 'projects.created_by')
				->join('users as cc', 'cc.id', '=', 'projects.approved_by')
				// ->join('areas', 'areas.id', '=', 'projects.area_id')
				// ->join('contacts', 'contacts.id', '=', 'projects.developer')
				->where('projects.status', 0)
				->where('projects.status_forthread', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('cc.first_name', 'LIKE' ,"%$search%")
					->orwhere('cc.last_name', 'LIKE' ,"%$search%")
					// ->orwhere('areas.area_place', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
					// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
				})
				->orderBy('id', 'desc')
				->paginate(20);
	}

	public static function get_allprojectclosed_count($search)
	{
		return DB::table('projects')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.*'))
				->join('users', 'users.id', '=', 'projects.created_by')
				->join('users as cc', 'cc.id', '=', 'projects.approved_by')
				// ->join('areas', 'areas.id', '=', 'projects.area_id')
				// ->join('contacts', 'contacts.id', '=', 'projects.developer')
				->where('projects.status', 0)
				->where('projects.status_forthread', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('cc.first_name', 'LIKE' ,"%$search%")
					->orwhere('cc.last_name', 'LIKE' ,"%$search%")
					// ->orwhere('areas.area_place', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
					// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
				})
				->orderBy('id', 'desc')
				->get();
	}

	//--------------------------------//

	public static function get_allprojects($filter,$search)
	{
		return DB::table('projects')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.*'))
				->join('users', 'users.id', '=', 'projects.created_by')
				->join('users as cc', 'cc.id', '=', 'projects.approved_by')
				// ->where('projects.status', 2)
				// ->join('areas', 'areas.id', '=', 'projects.area_id')
				// ->join('contacts', 'contacts.id', '=', 'projects.developer')
				->where('projects.status', '<=', $filter)
				->where('projects.status_forthread', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('projects.street', 'LIKE' ,"%$search%")
					->orwhere('projects.country', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('cc.first_name', 'LIKE' ,"%$search%")
					->orwhere('cc.last_name', 'LIKE' ,"%$search%")
					// ->orwhere('areas.area_place', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
					// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
				})
				->orderBy('id', 'desc')
				->paginate(20);
	}

	public static function get_allproject_counts($filter,$search)
	{
		return DB::table('projects')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.*'))
				->join('users', 'users.id', '=', 'projects.created_by')
				->join('users as cc', 'cc.id', '=', 'projects.approved_by')
				// ->where('projects.status', 2)
				// ->join('areas', 'areas.id', '=', 'projects.area_id')
				// ->join('contacts', 'contacts.id', '=', 'projects.developer')
				->where('projects.status', '<=', $filter)
				->where('projects.status_forthread', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('projects.street', 'LIKE' ,"%$search%")
					->orwhere('projects.country', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('cc.first_name', 'LIKE' ,"%$search%")
					->orwhere('cc.last_name', 'LIKE' ,"%$search%")
					// ->orwhere('areas.area_place', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
					// ->orwhere('contacts.fullname', 'LIKE' ,"%$search%");
				})
				->orderBy('id', 'desc')
				->get();
	}

	//------------------------------------//

	public static function get_bdoproject($filter,$search,$id)
	{
		return DB::table('project_users')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, project_users.status, project_users.status_forthread'))
				->join('projects', 'projects.id', '=', 'project_users.project_id')
				->join('users', 'users.id', '=', 'project_users.created_by')
				->where('project_users.user_id', $id)
				->where('project_users.status', $filter)
				->where('project_users.status_forthread', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('projects.street', 'LIKE' ,"%$search%")
					->orwhere('projects.country', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
				})
				->distinct()
				->orderBy('id', 'desc')
				->paginate(20);

		// $from_project = DB::table('projects')
		// 		->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status'))
		// 		->join('users', 'users.id', '=', 'projects.created_by')
		// 		->where('projects.bdo_id', $id)
		// 		->where('projects.status', $filter)
		// 		->where('projects.status_forthread', 1)
		// 		->where(function($query) use ($search){
		// 		$query->where('projects.project_name', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.street', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.country', 'LIKE' ,"%$search%")
		// 			->orwhere('users.first_name', 'LIKE' ,"%$search%")
		// 			->orwhere('users.last_name', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
		// 		})
		// 		->distinct()
		// 		->orderBy('id', 'desc')
		// 		->paginate(20);		

		// if(count($from_projectusers) == 0)
		// {
		// 	return $from_project;
		// }else{
		// 	return $from_projectusers;
		// }

	}

	public static function get_bdoproject_count($filter,$search,$id)
	{
		return DB::table('project_users')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status, project_users.status_forthread'))
				->join('projects', 'projects.id', '=', 'project_users.project_id')
				->join('users', 'users.id', '=', 'project_users.created_by')
				->where('project_users.user_id', $id)
				->where('project_users.status', $filter)
				->where('project_users.status_forthread', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('projects.street', 'LIKE' ,"%$search%")
					->orwhere('projects.country', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
				})
				->distinct()
				->orderBy('id', 'desc')
				->get();

		// 	$from_project = DB::table('projects')
		// 		->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status'))
		// 		->join('users', 'users.id', '=', 'projects.created_by')
		// 		->where('projects.bdo_id', $id)
		// 		->where('projects.status', $filter)
		// 		->where('projects.status_forthread', 1)
		// 		->where(function($query) use ($search){
		// 		$query->where('projects.project_name', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.street', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.country', 'LIKE' ,"%$search%")
		// 			->orwhere('users.first_name', 'LIKE' ,"%$search%")
		// 			->orwhere('users.last_name', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
		// 		})
		// 		->distinct()
		// 		->orderBy('id', 'desc')
		// 		->get();		

		// if(count($from_projectusers) == 0)
		// {
		// 	return $from_project;
		// }else{
		// 	return $from_projectusers;
		// }	

	}

	//--------------------------------------//
	public static function get_bdoprojects($filter,$search,$id)
	{
		return DB::table('project_users')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status, project_users.status_forthread'))
				->join('projects', 'projects.id', '=', 'project_users.project_id')
				->join('users', 'users.id', '=', 'project_users.created_by')
				->where('project_users.user_id', $id)
				->where('project_users.status', '<=', $filter)
				->where('project_users.status_forthread', 1)
				->where('project_users.status', '<>', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('projects.street', 'LIKE' ,"%$search%")
					->orwhere('projects.country', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
				})
				->distinct()
				->orderBy('id', 'desc')
				->paginate(20);

		// $from_project = DB::table('projects')
		// 		->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status'))
		// 		->join('users', 'users.id', '=', 'projects.created_by')
		// 		->where('projects.bdo_id', $id)
		// 		->where('project_users.user_id', $id)
		// 		->where('project_users.status', '<=', $filter)
		// 		->where('project_users.status_forthread', 1)
		// 		->where('project_users.status', '<>', 1)
		// 		->where(function($query) use ($search){
		// 		$query->where('projects.project_name', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.street', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.country', 'LIKE' ,"%$search%")
		// 			->orwhere('users.first_name', 'LIKE' ,"%$search%")
		// 			->orwhere('users.last_name', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
		// 		})
		// 		->distinct()
		// 		->orderBy('id', 'desc')
		// 		->paginate(20);		

		// if(count($from_projectusers) == 0)
		// {
		// 	return $from_project;
		// }else{
		// 	return $from_projectusers;
		// }

	}

	public static function get_bdoproject_counts($filter,$search,$id)
	{
		return DB::table('project_users')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status, project_users.status_forthread'))
				->join('projects', 'projects.id', '=', 'project_users.project_id')
				->join('users', 'users.id', '=', 'project_users.created_by')
				->where('project_users.user_id', $id)
				->where('project_users.status', '<=', $filter)
				->where('project_users.status_forthread', 1)
				->where('project_users.status', '<>', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('projects.street', 'LIKE' ,"%$search%")
					->orwhere('projects.country', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
				})
				->distinct()
				->orderBy('id', 'desc')
				->get();

		// $from_project = DB::table('projects')
		// 		->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status'))
		// 		->join('users', 'users.id', '=', 'projects.created_by')
		// 		->where('projects.bdo_id', $id)
		// 		// ->where('projects.status', '<=', $filter)
		// 		->where('projects.status_forthread', 1)
		// 		->where('projects.status', '<>', 1)
		// 		->where(function($query) use ($search){
		// 		$query->where('projects.project_name', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.street', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.country', 'LIKE' ,"%$search%")
		// 			->orwhere('users.first_name', 'LIKE' ,"%$search%")
		// 			->orwhere('users.last_name', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
		// 			->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
		// 		})
		// 		->distinct()
		// 		->orderBy('id', 'desc')
		// 		->get();		

		// if(count($from_projectusers) == 0)
		// {
		// 	return $from_project;
		// }else{
		// 	return $from_projectusers;
		// }
	}
	//--------------------------------------------//

	public static function get_ccproject($filter,$search,$id)
	{
		return DB::table('project_users')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status, project_users.status_forthread'))
				->join('projects', 'projects.id', '=', 'project_users.project_id')
				->join('users', 'users.id', '=', 'project_users.created_by')
				->where('projects.approved_by', $id)
				->where('project_users.status', $filter)
				->where('project_users.status_forthread', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('projects.street', 'LIKE' ,"%$search%")
					->orwhere('projects.country', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
				})
				->distinct()
				->orderBy('id', 'desc')
				->paginate(20);

	}

	public static function get_ccproject_count($filter,$search,$id)
	{
		return DB::table('project_users')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status, project_users.status_forthread'))
				->join('projects', 'projects.id', '=', 'project_users.project_id')
				->join('users', 'users.id', '=', 'project_users.created_by')
				->where('projects.approved_by', $id)
				->where('project_users.status', $filter)
				->where('project_users.status_forthread', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('projects.street', 'LIKE' ,"%$search%")
					->orwhere('projects.country', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
				})
				->distinct()
				->orderBy('id', 'desc')
				->get();

	}
	//------------------------------------------------------//
	public static function get_ccprojects($filter,$search,$id)
	{
		return DB::table('project_users')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status, project_users.status_forthread'))
				->join('projects', 'projects.id', '=', 'project_users.project_id')
				->join('users', 'users.id', '=', 'project_users.created_by')
				->where('projects.approved_by', $id)
				->where('project_users.status', '<=', $filter)
				->where('project_users.status_forthread', 1)
				->where('project_users.status', '<>', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('projects.street', 'LIKE' ,"%$search%")
					->orwhere('projects.country', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
				})
				->distinct()
				->orderBy('id', 'desc')
				->paginate(20);

	}

	public static function get_ccproject_counts($filter,$search,$id)
	{
		return DB::table('project_users')
				->select(DB::raw('concat(users.first_name, " " ,users.last_name) as fullname, projects.id, projects.project_name, projects.project_owner, projects.painting_dtstart, projects.painting_dtend, projects.status, project_users.status_forthread'))
				->join('projects', 'projects.id', '=', 'project_users.project_id')
				->join('users', 'users.id', '=', 'project_users.created_by')
				->where('projects.approved_by', $id)
				->where('project_users.status', '<=', $filter)
				->where('project_users.status_forthread', 1)
				->where('project_users.status', '<>', 1)
				->where(function($query) use ($search){
				$query->where('projects.project_name', 'LIKE' ,"%$search%")
					->orwhere('projects.project_owner', 'LIKE' ,"%$search%")
					->orwhere('projects.street', 'LIKE' ,"%$search%")
					->orwhere('projects.country', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtstart', 'LIKE' ,"%$search%")
					->orwhere('projects.painting_dtend', 'LIKE' ,"%$search%");
				})
				->distinct()
				->orderBy('id', 'desc')
				->get();

	}
	//--------------------------------------------------------//
	public static function selectproject_info_details($id)
	{
		return DB::table('projects')
					->select('projects.*', 'projects.status as current_stats', 'users.first_name', 'users.last_name', 'areas.area_place', 'classifications.classification', 'categories.category', 'stages.stage', 'statuses.status')
					->join('users', 'users.id', '=', 'projects.bdo_id')
					->join('areas', 'areas.id', '=', 'projects.area_id')
					->join('classifications', 'classifications.id', '=', 'projects.project_classification')
					->join('categories', 'categories.id', '=', 'projects.project_category')
					->join('stages', 'stages.id', '=', 'projects.project_stage')
					->join('statuses', 'statuses.id', '=', 'projects.project_status')
					->where('projects.id', $id)
					->first();
	}

	public static function getFiles($thread_id)
	{
		return DB::table('project_thread_image')
				->where('proj_thread_id', $thread_id)
				->distinct()
				->get();			
	}

	public static function getFile($thread_id)
	{
		return DB::table('project_thread_file')
				->where('proj_thread_id', $thread_id)
				->distinct()
				->get();			
	}

	public static function get_allproject_thread($proj_id)
	{
		$thread = DB::table('project_thread')
					->select('project_thread.*', 'users.image', 'users.first_name', 'users.last_name')
					->join('users', 'users.id', '=', 'project_thread.user_id')
					->where('project_thread.proj_id', $proj_id)
					->where('project_thread.returned', 1)
					->orderBy('id', 'desc')
					->get();
		
		$data = array();
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->files = Project::getFiles($value->id);
		}
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->file = Project::getFile($value->id);
		}
		return $data;
	}

	public static function get_bdoproject_thread($cc_id,$proj_id)
	{
		// $thread = DB::table('project_thread')
		// 			->select('project_thread.*', 'users.image', 'users.first_name', 'users.last_name')
		// 			->join('users', 'users.id', '=', 'project_thread.user_id')
		// 			->where('project_thread.proj_id', $proj_id)
		// 			->where('project_thread.user_id', '!=', $cc_id)
		// 			->where('project_thread.returned', 1)
		// 			->orderBy('id', 'desc')
		// 			->get();

		$thread = DB::table('project_thread')
					->select('project_thread.*', 'users.image', 'users.first_name', 'users.last_name')
					->join('users', 'users.id', '=', 'project_thread.user_id')
					->where('project_thread.proj_id', $proj_id)
					->where('project_thread.returned', 1)
					->orderBy('id', 'desc')
					->get();
		
		$data = array();
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->files = Project::getFiles($value->id);
		}
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->file = Project::getFile($value->id);
		}
		return $data;
	}

	public static function get_ccproject_thread($proj_id,$bdo_id)
	{
		$thread = DB::table('project_thread')
					->select('project_thread.*', 'users.image', 'users.first_name', 'users.last_name')
					->join('users', 'users.id', '=', 'project_thread.user_id')
					->where('project_thread.proj_id', $proj_id)
					->where('project_thread.returned', 1)
					->orderBy('id', 'desc')
					->get();
		
		$data = array();
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->files = Project::getFiles($value->id);
		}
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->file = Project::getFile($value->id);
		}
		return $data;

	}

	//------------------------------ get close project thread-------------------------------------------//

	public static function getall_closedproject_thread($proj_id)
	{
		$thread = DB::table('project_thread')
					->select('project_thread.*', 'users.image', 'users.first_name', 'users.last_name')
					->join('users', 'users.id', '=', 'project_thread.user_id')
					->where('project_thread.proj_id', $proj_id)
					->where('project_thread.returned', 2)
					->orderBy('id', 'desc')
					->get();
		
		$data = array();
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->files = Project::getFiles($value->id);
		}
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->file = Project::getFile($value->id);
		}
		return $data;
	}

	public static function get_closed_bdoproject_thread($cc_id,$proj_id)
	{
		$thread = DB::table('project_thread')
					->select('project_thread.*', 'users.image', 'users.first_name', 'users.last_name')
					->join('users', 'users.id', '=', 'project_thread.user_id')
					->where('project_thread.proj_id', $proj_id)
					->where('project_thread.returned', 2)
					->orderBy('id', 'desc')
					->get();
		
		$data = array();
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->files = Project::getFiles($value->id);
		}
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->file = Project::getFile($value->id);
		}
		return $data;
	}

	public static function get_closed_ccproject_thread($proj_id,$bdo_id)
	{
		$thread = DB::table('project_thread')
					->select('project_thread.*', 'users.image', 'users.first_name', 'users.last_name')
					->join('users', 'users.id', '=', 'project_thread.user_id')
					->where('project_thread.proj_id', $proj_id)
					->where('project_thread.returned', 2)
					->orderBy('id', 'desc')
					->get();
		
		$data = array();
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->files = Project::getFiles($value->id);
		}
		foreach ($thread as $key => $value) {
			$data[$key] = $value;
			$data[$key]->file = Project::getFile($value->id);
		}
		return $data;

	}


}