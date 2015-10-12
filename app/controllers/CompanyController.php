<?php

class CompanyController extends \BaseController {

// ------------------------------------------------ bdo ----------------------------------------- //

	/**
	 * Display a listing of the resource.
	 * GET /company
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = 'Company';
		Input::flash();

		if(Input::get('status') > 1)
		{
			if(Input::get('s') != '')
			{
				DB::table('companies')->where('company_name', Input::get('s'))->update(array('notif' => 2));
			}

			if(Session::get('role') == 1 || Session::get('role') == 2)
			{
				$company = Company::selectrecord_all(Input::get('status', 1),Input::get('s'));
				$company->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();		
				$company_status = DB::table('company_status')->orderBy('id', 'desc')->get();

			}else{
				$company = Company::selectrecord(Auth::id(),Input::get('status', 1),Input::get('s'));
				$company->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();
				$company_status = DB::table('company_status')->where('created_by', Auth::id())->orderBy('id', 'desc')->get();				
			}

			return View::make('company.index', compact('pagetitle','company', 'company_status'));

		}else{	
			
			if(Session::get('role') == 1 || Session::get('role') == 2)
			{
				$company = Company::selectrecord_all(Input::get('status', 1),Input::get('s'));
				$company->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();	
				$company_status = DB::table('company_status')->orderBy('id', 'desc')->get();		

			}else{
				$company = Company::selectrecord(Auth::id(),Input::get('status', 1),Input::get('s'));	
				$company->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();
				$company_status = DB::table('company_status')->where('created_by', Auth::id())->orderBy('id', 'desc')->get();		
			}

			return View::make('company.index', compact('pagetitle','company', 'company_status'));

		}	
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /company/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = 'Create Company';

		$type = Company::selecttype();
		$cities = Company::selectcity();
		$provinces = Company::selectprovince();
		return View::make('company.create', compact('pagetitle', 'type', 'cities', 'provinces'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /company
	 *
	 * @return Response
	 */
	public function store()
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Company::$rules);

		$gettime = time() - 14400;
     	$datetime_now = date("H:i:s", $gettime);

		if($validation->passes())
		{	
			$company = new Company();
			$company->company_name = strtoupper(Input::get('company_name'));
			$company->type_id = Input::get('client_type');
			$company->street = strtoupper(Input::get('street'));
			$company->city_id = Input::get('city');
			$company->province_id = Input::get('province');
			$company->region = strtoupper(Input::get('region'));
			$company->country = strtoupper(Input::get('country'));
			$company->zip_code = strtoupper(Input::get('zip_code'));

			$company->street2 = strtoupper(Input::get('2nd_street'));
			$company->city_id2 = Input::get('2nd_city');
			$company->province_id2 = Input::get('2nd_province');
			$company->region2 = strtoupper(Input::get('2nd_region'));
			$company->country2 = strtoupper(Input::get('2nd_country'));
			$company->zip_code2 = strtoupper(Input::get('2nd_zip_code'));

			$company->street3 = strtoupper(Input::get('3rd_street'));
			$company->city_id3 = Input::get('3rd_city');
			$company->province_id3 = Input::get('3rd_province');
			$company->region3 = strtoupper(Input::get('3rd_region'));
			$company->country3 = strtoupper(Input::get('3rd_country'));
			$company->zip_code3 = strtoupper(Input::get('3rd_zip_code'));

			$company->telephone_number = Input::get('telephone_number');
			$company->fax_number = strtoupper(Input::get('fax_number'));
			$company->mobile_number = Input::get('mobile_number');
			$company->email = strtoupper(Input::get('email'));

			$company->telephone_number2 = Input::get('2nd_telephone_number');
			$company->fax_number2 = strtoupper(Input::get('2nd_fax_number'));
			$company->mobile_number2 = Input::get('2nd_mobile_number');
			$company->email2 = strtoupper(Input::get('2nd_email'));

			$company->telephone_number3 = Input::get('3rd_telephone_number');
			$company->fax_number3 = strtoupper(Input::get('3rd_fax_number'));
			$company->mobile_number3 = Input::get('3rd_mobile_number');
			$company->email3 = strtoupper(Input::get('3rd_email'));

			$company->status = 1;
			$company->created_by = Auth::id();
			
			if(Company::select_ifexist($company))
			{
				return Redirect::route('company.create')
								->withInput()
								->withErrors($validation)
								->with('class', 'error')
								->with('message', 'Company name already exist.');	
			}

			$company->save();
			DB::table('company_status')->insert(array([
      	 			'company_id' => $company->id,
      	 			'user_id' => Auth::id(),
      	 			'update' => 'CREATE' . ' ' . strtoupper(Input::get('company_name')) . ' ' . 'IN COMPANY RECORD',
      	 			'created_by' => Auth::id(),
      	 			'created_at' => date("Y-m-d") . ' ' . $datetime_now,
      	 		]));

			return Redirect::route('company.index')
								->with('class', 'success')
								->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('company.create')
								->withInput()
								->withErrors($validation)
								->with('class', 'error')
								->with('message', 'There were validation errors.');

		}

	}

	/**
	 * Display the specified resource.
	 * GET /company/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /company/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = "Update Company";
		
		$companies = Company::selectrecord_forupdate($id);
		
		$mytype = DB::table('types')
					->select('id', 'client_type')
					->where('id', $companies->type_id)
					->first();

		$type = DB::table('types')
					->select('id', 'client_type')
					->where('id', '!=', $mytype->id)
					->orderBy('client_type')
					->lists('client_type', 'id');

		$mycity = DB::table('cities')
					->select(DB::raw('concat(ucase(city)," - ",ucase(provinces.province)) as city,cities.id'))
					->join('provinces', 'provinces.id', '=', 'cities.province_id')
					->where('cities.id', $companies->city_id)
					->first();

		if(count($mycity->city) > 0)
		{
			$mycity->id = $companies->city_id;
			$mycity->city = $mycity->city;
		}else{
			$mycity->id = 0;
			$mycity->city = "CHOOSE CITY HERE";
		}

		$cities = DB::table('cities')
					->select(DB::raw('concat(ucase(city)," - ",ucase(provinces.province)) as city,cities.id'))
					->join('provinces', 'provinces.id', '=', 'cities.province_id')
					->where('cities.id', '!=', $mycity->id)
					->orderBy('city')
					->lists('city', 'id');

		$mycity2 = DB::table('cities')
					->select(DB::raw('concat(ucase(city)," - ",ucase(provinces.province)) as city,cities.id'))
					->join('provinces', 'provinces.id', '=', 'cities.province_id')
					->where('cities.id', $companies->city_id2)
					->first();
		
		if(count($mycity2->city) > 0)
		{
			$mycity2->id = $companies->city_id2;
			$mycity2->city = $mycity2->city;
		}else{
			$mycity2->id = 0;
			$mycity2->city = "CHOOSE CITY HERE";
		}
					
		$cities2 = DB::table('cities')
					->select(DB::raw('concat(ucase(city)," - ",ucase(provinces.province)) as city,cities.id'))
					->join('provinces', 'provinces.id', '=', 'cities.province_id')
					->where('cities.id', '!=', $mycity2->id)
					->orderBy('city')
					->lists('city', 'id');	

		$mycity3 = DB::table('cities')
					->select(DB::raw('concat(ucase(city)," - ",ucase(provinces.province)) as city,cities.id'))
					->join('provinces', 'provinces.id', '=', 'cities.province_id')
					->where('cities.id', $companies->city_id3)
					->first();

		if(count($mycity3->city) > 0)
		{
			$mycity3->id = $companies->city_id3;
			$mycity3->city = $mycity3->city;
		}else{
			$mycity3->id = 0;
			$mycity3->city = "CHOOSE CITY HERE";
		}			

		$cities3 = DB::table('cities')
					->select(DB::raw('concat(ucase(city)," - ",ucase(provinces.province)) as city,cities.id'))
					->join('provinces', 'provinces.id', '=', 'cities.province_id')
					->where('cities.id', '!=', $mycity3->id)
					->orderBy('city')
					->lists('city', 'id');									

		$myprovince = DB::table('provinces')
					->select(DB::raw('concat(ucase(province)," - ",ucase(states.state)) as province,provinces.id'))
					->join('states', 'states.id', '=', 'provinces.state_id')
					->where('provinces.id', $companies->province_id)
					->first();

		if($companies->province_id == 0)
		{
			$myprovince->id = 0;
			$myprovince->province = "CHOOSE PROVINCE HERE";
		}	

		$provinces = DB::table('provinces')
					->select(DB::raw('concat(ucase(province)," - ",ucase(states.state)) as province,provinces.id'))
					->join('states', 'states.id', '=', 'provinces.state_id')
					->where('provinces.id', '!=', $myprovince->id)
					->orderBy('province')
					->lists('province', 'id');

		$myprovince2 = DB::table('provinces')
					->select(DB::raw('concat(ucase(province)," - ",ucase(states.state)) as province,provinces.id'))
					->join('states', 'states.id', '=', 'provinces.state_id')
					->where('provinces.id', $companies->province_id2)
					->first();

		if($companies->province_id2 == 0)
		{
			$myprovince2->id = 0;
			$myprovince2->province = "CHOOSE PROVINCE HERE";
		}	

		$provinces2 = DB::table('provinces')
					->select(DB::raw('concat(ucase(province)," - ",ucase(states.state)) as province,provinces.id'))
					->join('states', 'states.id', '=', 'provinces.state_id')
					->where('provinces.id', '!=', $myprovince2->id)
					->orderBy('province')
					->lists('province', 'id');	

		$myprovince3 = DB::table('provinces')
					->select(DB::raw('concat(ucase(province)," - ",ucase(states.state)) as province,provinces.id'))
					->join('states', 'states.id', '=', 'provinces.state_id')
					->where('provinces.id', $companies->province_id3)
					->first();

		if($companies->province_id3 == 0)
		{
			$myprovince3->id = 0;
			$myprovince3->province = "CHOOSE PROVINCE HERE";
		}	

		$provinces3 = DB::table('provinces')
					->select(DB::raw('concat(ucase(province)," - ",ucase(states.state)) as province,provinces.id'))
					->join('states', 'states.id', '=', 'provinces.state_id')
					->where('provinces.id', '!=', $myprovince3->id)
					->orderBy('province')
					->lists('province', 'id');									
		
		return View::make('company.edit', compact('pagetitle', 'companies', 'mytype', 'type', 'mycity', 'cities', 'mycity2', 'cities2', 'mycity3', 'cities3', 'myprovince', 'provinces', 'myprovince2', 'provinces2', 'myprovince3', 'provinces3'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /company/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Company::$update_rules);

		$gettime = time() - 14400;
     	$datetime_now = date("H:i:s", $gettime);

		if($validation->passes())
		{
			$company = Company::find($id);

			if(is_null($company))
			{
				return Redirect::route('company.index')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Company information not exist.');
			}

			$company->company_name = strtoupper(Input::get('company_name'));
			$company->type_id = Input::get('client_type');
			$company->street = strtoupper(Input::get('street'));
			$company->city_id = Input::get('city');
			$company->province_id = Input::get('province');
			$company->region = Input::get('region');
			$company->country = strtoupper(Input::get('country'));
			$company->zip_code = Input::get('zip_code');

			$company->street2 = strtoupper(Input::get('2nd_street'));
			$company->city_id2 = Input::get('2nd_city');
			$company->province_id2 = Input::get('2nd_province');
			$company->region2 = strtoupper(Input::get('2nd_region'));
			$company->country2 = strtoupper(Input::get('2nd_country'));
			$company->zip_code2 = strtoupper(Input::get('2nd_zip_code'));

			$company->street3 = strtoupper(Input::get('3rd_street'));
			$company->city_id3 = Input::get('3rd_city');
			$company->province_id3 = Input::get('3rd_province');
			$company->region3 = strtoupper(Input::get('3rd_region'));
			$company->country3 = strtoupper(Input::get('3rd_country'));
			$company->zip_code3 = strtoupper(Input::get('3rd_zip_code'));

			$company->telephone_number = Input::get('telephone_number');
			$company->fax_number = strtoupper(Input::get('fax_number'));
			$company->mobile_number = Input::get('mobile_number');
			$company->email = strtoupper(Input::get('email'));

			$company->telephone_number2 = Input::get('2nd_telephone_number');
			$company->fax_number2 = strtoupper(Input::get('2nd_fax_number'));
			$company->mobile_number2 = Input::get('2nd_mobile_number');
			$company->email2 = strtoupper(Input::get('2nd_email'));

			$company->telephone_number3 = Input::get('3rd_telephone_number');
			$company->fax_number3 = strtoupper(Input::get('3rd_fax_number'));
			$company->mobile_number3 = Input::get('3rd_mobile_number');
			$company->email3 = strtoupper(Input::get('3rd_email'));
			$company->status = 1;
			// if(Company::selectinfo_forupdate($company))
			// {
			// 	return Redirect::route('company.edit', $id)
			// 						->withInput()
			// 						->withErrors($validation)
			// 						->with('class', 'warning')
			// 						->with('message', 'Record was already added by Business Development Officer.');
			
			// }

			$company_information = DB::table('companies')
									->select('companies.*', 'cities.city', 'provinces.province', 'types.client_type')
									->join('types', 'types.id', '=', 'companies.type_id')
									->join('cities', 'cities.id', '=', 'companies.city_id')
									->join('provinces', 'provinces.id', '=', 'companies.province_id')
									->where('companies.id', $id)
									->first();	
			$clienttype = DB::table('types')->where('id', Input::get('client_type'))->first();
									
			if(Company::where('company_name', Input::get('company_name'))->where('id', $id)->count() > 0)
			{
				$company_name = "";
			}else{
				$company_name = "COMPANY NAME : " . $company_information->company_name . " INTO " . strtoupper(Input::get('company_name')) . ", ";
			}
			if(Company::where('type_id', Input::get('client_type'))->where('id', $id)->count() > 0)
			{
				$client_type = "";
			}else{
				$client_type = "CLIENT TYPE : " . $company_information->client_type . " INTO " . strtoupper($clienttype->client_type) . ", ";
			}
			if(Company::where('street', Input::get('street'))->where('city_id', Input::get('city'))->where('province_id', Input::get('province'))->where('region', Input::get('region'))->where('country', Input::get('country'))->where('zip_code', Input::get('zip_code'))->where('id', $id)->count() > 0)
			{
				$company_address1 = "";
			}else{
				$company_address1 = "COMPANY ADDRESS : " . $company_information->street . " " . $company_information->city . ", " . $company_information->country . " " . $company_information->zip_code . " INTO " . strtoupper(Input::get('street')) . " " . strtoupper(Input::get('city')) . ", " . strtoupper(Input::get('country')) . " " . strtoupper(Input::get('zip_code')) . ", ";
			}
			if(Company::where('street2', Input::get('2nd_street'))->where('city_id2', Input::get('2nd_city'))->where('province_id2', Input::get('2nd_province'))->where('region2', Input::get('2nd_region'))->where('country2', Input::get('2nd_country'))->where('zip_code2', Input::get('2nd_zip_code'))->where('id', $id)->count() > 0)
			{
				$company_address2 = "";
			}else{
				$company_address2 = "2nd COMPANY ADDRESS : " . $company_information->street2 . " " . $company_information->city2 . ", " . $company_information->country2 . " " . $company_information->zip_code2 . " INTO " . strtoupper(Input::get('2nd_street')) . " " . strtoupper(Input::get('2nd_city')) . ", " . strtoupper(Input::get('2nd_country')) . " " . strtoupper(Input::get('2nd_zip_code')) . ", ";
			}
			if(Company::where('street3', Input::get('3rd_street'))->where('city_id3', Input::get('3rd_city'))->where('province_id3', Input::get('3rd_province'))->where('region3', Input::get('3rd_region'))->where('country3', Input::get('3rd_country'))->where('zip_code3', Input::get('3rd_zip_code'))->where('id', $id)->count() > 0)
			{
				$company_address3 = "";
			}else{
				$company_address3 = "3rd COMPANY ADDRESS : " . $company_information->street3 . " " . $company_information->city3 . ", " . $company_information->country3 . " " . $company_information->zip_code3 . " INTO " . strtoupper(Input::get('3rd_street')) . " " . strtoupper(Input::get('3rd_city')) . ", " . strtoupper(Input::get('3rd_country')) . " " . strtoupper(Input::get('3rd_zip_code')) . ", ";
			}
			if(Company::where('telephone_number', Input::get('telephone_number'))->where('fax_number', Input::get('fax_number'))->where('mobile_number', Input::get('mobile_number'))->where('email', Input::get('email'))->where('id', $id)->count() > 0)
			{
				$contact = "";
			}else{
				$contact = "CONTACT INFORMATION : " . $company_information->telephone_number . " / " . $company_information->fax_number . " / " . $company_information->mobile_number . " / " . $company_information->email . " INTO " . strtoupper(Input::get('telephone_number')) . " / " . strtoupper(Input::get('fax_number')) . " / " . strtoupper(Input::get('mobile_number')) . " / " . strtoupper(Input::get('email')) . ", ";
			}
			if(Company::where('telephone_number2', Input::get('2nd_telephone_number'))->where('fax_number2', Input::get('2nd_fax_number'))->where('mobile_number2', Input::get('2nd_mobile_number'))->where('email2', Input::get('2nd_email'))->where('id', $id)->count() > 0)
			{
				$contact2 = "";
			}else{
				$contact2 = "2nd CONTACT INFORMATION : " . $company_information->telephone_number2 . " / " . $company_information->fax_number2 . " / " . $company_information->mobile_number2 . " / " . $company_information->email2 . " INTO " . strtoupper(Input::get('2nd_telephone_number')) . " / " . strtoupper(Input::get('2nd_fax_number')) . " / " . strtoupper(Input::get('2nd_mobile_number')) . " / " . strtoupper(Input::get('2nd_email')) . ", ";
			}
			if(Company::where('telephone_number3', Input::get('3rd_telephone_number'))->where('fax_number3', Input::get('3rd_fax_number'))->where('mobile_number3', Input::get('3rd_mobile_number'))->where('email3', Input::get('3rd_email'))->where('id', $id)->count() > 0)
			{
				$contact3 = "";
			}else{
				$contact3 = "3rd CONTACT INFORMATION : " . $company_information->telephone_number3 . " / " . $company_information->fax_number3 . " / " . $company_information->mobile_number3 . " / " . $company_information->email3 . " INTO " . strtoupper(Input::get('3rd_telephone_number')) . " / " . strtoupper(Input::get('3rd_fax_number')) . " / " . strtoupper(Input::get('3rd_mobile_number')) . " / " . strtoupper(Input::get('3rd_email')) . ", ";
			}

			$company->save();

			DB::table('company_status')->insert(array([
      	 			'company_id' => $company->id,
      	 			'user_id' => Auth::id(),
      	 			'update' => 'CHANGE ' . $company_information->company_name . ' IN COMPANY RECORD ' . ' | ' . $company_name . $client_type . $company_address1 . $company_address2 . $company_address3 . $contact . $contact2 . $contact3,
      	 			'created_by' => Auth::id(),
      	 			'created_at' => date('Y-m-d') . ' ' . $datetime_now,
      	 			'access' => 1,
      	 		]));

			return Redirect::route('company.index')
									->with('class', 'success')
									->with('message', 'Record successfully updated.');
		
		}else{
			return Redirect::route('company.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'error')
									->with('message', 'There were validation errors.');

		}

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /company/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$company_name = DB::table('companies')->select('id','company_name','created_by')->where('id', $id)->first();

		$company = Company::find($id)->delete();

		$gettime = time() - 14400;
     	$datetime_now = date("H:i:s", $gettime);

		if(is_null($company)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

			DB::table('company_status')->where('company_id', $id)->where('access', '<=', 3)->update(array('access' => 0));
			DB::table('company_status')->insert(array([
	  	 			'company_id' => $company_name->id,
	  	 			'user_id' => Auth::id(),
	  	 			'update' => 'REMOVE' . ' ' . $company_name->company_name . ' ' . 'IN COMPANY RECORD',
	  	 			'created_by' => $company_name->created_by,
	  	 			'created_at' => date('Y-m-d') . ' ' . $datetime_now,
	  	 		]));

		}

		return Redirect::route('company.index')
								->with('class', $class)
								->with('message', $message);
	
	}

	public function details($id)
	{
		$pagetitle = 'Company Details';

		$company = Company::selectnfo_fordetails($id);
		return View::make('company.details', compact('pagetitle', 'company'));
	}


// --------------------------------------------------- cc ----------------------------------------------------- //

	public function ra()
	{
		$pagetitle = "Company List/s";
		Input::flash();

		$company = Company::requestcompanylist(Input::get('status', 1),Input::get('s'));	
		$company->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();	
		
		$company_status = DB::table('company_status')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name, " " ,company_status.update) as history, company_status.id, company_status.created_at, company_status.access'))
					->join('users', 'users.id', '=', 'company_status.user_id')
					->where('company_status.access', '<', 3)
					->orderBy('id', 'desc')->get();

		return View::make('company.ra', compact('pagetitle','company', 'company_status'));
	
	}

	public function a($id)
	{
		$company = Company::find($id);

		$gettime = time() - 14400;
     	$datetime_now = date("H:i:s", $gettime);

		if(is_null($company)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$company->status = 2;
			$company->notif = 1;
			$company->notif_dt = date('Y-m-d') . ' ' . $datetime_now;
			$company->approved_by = Auth::id();
			$company->save();

			$company_name = DB::table('companies')->select('company_name','created_by')->where('id', $id)->first();

			DB::table('company_status')->where('company_id', $id)->where('access', 1)->update(array('access' => 2));
			DB::table('company_status')->insert(array([
      	 			'company_id' => $id,
      	 			'user_id' => Auth::id(),
      	 			'update' => 'APPROVED THE REQUEST FOR' . ' ' . $company_name->company_name,
      	 			'created_by' => $company_name->created_by,
      	 			'created_at' => date('Y-m-d') . ' ' . $datetime_now,
      	 			'access' => 3,
      	 		]));

			$class = 'success';
			$message = 'Record successfully Approved.';

		}

		return Redirect::route('company.ra')
								->with('class', $class)
								->with('message', $message);
	}

	public function d($id)
	{	
		if(Input::get('remarks_hid') == "" || Input::get('remarks_hid') == "Write remarks here.")
		{
			return Redirect::route('ra.company.dt', $id)
								->withInput()
								->with('class', 'error')
								->with('message', 'Write a *remarks first.');
		}

		$company = Company::find($id);

		$gettime = time() - 14400;
     	$datetime_now = date("H:i:s", $gettime);

		if(is_null($company)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$company->remarks = strtoupper(Input::get('remarks_hid'));
			$company->status = 3;
			$company->notif = 1;
			$company->notif_dt = date('Y-m-d') . ' ' . $datetime_now;
			$company->approved_by = Auth::id();
			$company->save();

			$company_name = DB::table('companies')->select('company_name','created_by')->where('id', $id)->first();

			DB::table('company_status')->where('company_id', $id)->where('access', 1)->update(array('access' => 2));
			DB::table('company_status')->insert(array([
      	 			'company_id' => $id,
      	 			'user_id' => Auth::id(),
      	 			'update' => 'DENIED THE REQUEST FOR' . ' ' . $company_name->company_name,
      	 			'created_by' => $company_name->created_by,
      	 			'created_at' => date('Y-m-d') . ' ' . $datetime_now,
      	 			'access' => 3,
      	 		]));

			$class = 'success';
			$message = 'Record successfully Denied.';

		}

		return Redirect::route('company.ra')
								->with('class', $class)
								->with('message', $message);
	}

	public function ra_details($id)
	{
		$pagetitle = 'Company Details';

		$company = Company::selectnfo_fordetails($id);
		$almost_samecomp = Company::selectsameinfo_fordetails($company);

		return View::make('company.ra_details', compact('pagetitle', 'company', 'almost_samecomp'));
	}

}