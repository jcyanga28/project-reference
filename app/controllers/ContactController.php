<?php

class ContactController extends \BaseController {

	// --------------------------- BDO -------------------------------------------- //

	/**
	 * Display a listing of the resource.
	 * GET /contact
	 *
	 * @return Response
	 */
	public function index()
	{
		$pagetitle = "Contact Person";
		Input::flash();

		if(Input::get('status') > 1)
		{
			if(Input::get('s') != '')
			{
				DB::table('contacts')->where('fullname', Input::get('s'))->update(array('notif' => 2));
			}

			if(Session::get('role') == 1 || Session::get('role') == 2)
			{
				$contact = Contact::processcontactlists_all(Input::get('status', 1),Input::get('s'));	
				$contact->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();

				$contact_individual = Contact::processcontactlists_allindividual(Input::get('status', 1),Input::get('s'));
				$contact_individual->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();
				$contact_status = DB::table('contact_status')->orderBy('id', 'desc')->get();

			}else{
				$contact = Contact::processcontactlists(Auth::id(),Input::get('status', 1),Input::get('s'));	
				$contact->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();

				$contact_individual = Contact::processcontactlists_individual(Auth::id(),Input::get('status', 1),Input::get('s'));	
				$contact_individual->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();
				$contact_status = DB::table('contact_status')->where('created_by', Auth::id())->orderBy('id', 'desc')->get();
			}

			return View::make('contact.index', compact('pagetitle','contact', 'contact_status', 'contact_individual'));

		}else{

			if(Session::get('role') == 1 || Session::get('role') == 2)
			{
				$contact = Contact::processcontactlists_all(Input::get('status', 1),Input::get('s'));	
				$contact->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();

				$contact_individual = Contact::processcontactlists_allindividual(Input::get('status', 1),Input::get('s'));
				$contact_individual->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();
				$contact_status = DB::table('contact_status')->orderBy('id', 'desc')->get();

			}else{
				$contact = Contact::processcontactlists(Auth::id(),Input::get('status', 1),Input::get('s'));
				$contact->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();	

				$contact_individual = Contact::processcontactlists_individual(Auth::id(),Input::get('status', 1),Input::get('s'));	
				$contact_individual->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();
				$contact_status = DB::table('contact_status')->where('created_by', Auth::id())->orderBy('id', 'desc')->get();

			}

			return View::make('contact.index', compact('pagetitle','contact', 'contact_status', 'contact_individual'));

		}
		
	}

	public function process()
	{
		$pagetitle = "Contact Person";
		Input::flash();

		$contact = Contact::processcontactlists(Auth::id(),1,'asd');	
		$contact_status = DB::table('contact_status')->get();
		return View::make('contact.show', compact('pagetitle','contact', 'contact_status'));
	}

	public function getcompanyinfo()
	{
		$company_id = Input::get('comp_name');
		$company = DB::table('companies')
							->select('companies.street', 'cities.city', 'companies.country', 'provinces.province', 'companies.zip_code')
							->join('cities', 'cities.id', '=', 'companies.city_id')
							->join('provinces', 'provinces.id', '=', 'companies.province_id')
							->where('companies.id', $company_id)
							->first();
							
		return Response::json($company,200);					
	}
	/**
	 * Show the form for creating a new resource.
	 * GET /contact/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$pagetitle = "Create Contact";
		
		$position = Contact::select_position();
		$companies = Contact::select_approvedcompanies();
		$cities = City::selectCity();	
		return View::make('contact.create', compact('pagetitle', 'position', 'companies', 'cities'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /contact
	 *
	 * @return Response
	 */
	public function store()
	{
		
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Contact::$rules);

		$gettime = time() - 14400;
     	$datetime_now = date("H:i:s", $gettime);

		if(Input::get('fullname') == 'No record found.')
		{
		   return Redirect::route('contact.create')
								->withInput()
								->with('class', 'error')
								->with('message', 'Input proper fullname.');
		
		}


		if($validation->passes())
		{

			if(Input::get('category') == '1')
			{
				$street = Input::get('street_hid');
				$city = Input::get('city_hid');
				$province = Input::get('province_hid');
				$country = Input::get('country_hid');
				$zip_code = Input::get('zip_code_hid');

				$street_2 = "";
				$city_2 = "";
				$province_2 = "";
				$country_2 = "";
				$zip_code_2 = "";

			}else{
				$street = Input::get('i_street');
				$city = Input::get('i_city');
				$province = Input::get('i_province');
				$country = Input::get('i_country');
				$zip_code = Input::get('i_zip_code');

				$street_2 = Input::get('i_street');
				$city_2 = Input::get('i_city');
				$province_2 = Input::get('i_province');
				$country_2 = Input::get('i_country');
				$zip_code_2 = Input::get('i_zip_code');

			}

			if($street == "" || $city == "" || $country == "" || $zip_code == "")
			{
				return Redirect::route('contact.create')
									->withInput()
									->with('class', 'error')
									->with('message', 'Make sure to fill-up company/personal address.');

			}

			$contact = new Contact();
			$contact->position = strtoupper(Input::get('profession'));
			$contact->in_company_position = strtoupper(Input::get('position'));
			$contact->fullname = strtoupper(Input::get('fullname'));
			$contact->gender = strtoupper(Input::get('gender'));
			$contact->category = Input::get('category');
			$contact->company = Input::get('company');	
			$contact->street = strtoupper($street);
			$contact->city = strtoupper($city);
			$contact->province = strtoupper($province);
			$contact->country = strtoupper($country);
			$contact->zip_code = strtoupper($zip_code);

			$contact->street_2 = strtoupper($street_2);
			$contact->city_2 = strtoupper($city_2);
			$contact->province_2 = strtoupper($province_2);
			$contact->country_2 = strtoupper($country_2);
			$contact->zip_code_2 = strtoupper($zip_code_2);

			$contact->contact_number = Input::get('contact_number');
			
			$contact->contact_number2 = Input::get('2nd_contact_number');
			$contact->contact_number3 = Input::get('3rd_contact_number');
			
			$contact->status = 1;
			$contact->created_by =  Auth::id();

			if(Input::get('category') == '1'){
				if(Contact::contactinfoExist($contact))
				{
					return Redirect::route('contact.create')
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Record was already added by BDO.');
				}
			}

			$contact->save();
			DB::table('contact_status')->insert(array([
      	 			'contact_id' => $contact->id,
      	 			'user_id' => Auth::id(),
      	 			'update' => 'CREATE' . ' ' . strtoupper(Input::get('fullname')) . ' ' . 'IN CONTACTS RECORD',
      	 			'created_by' => Auth::id(),
      	 			'created_at' => date('Y-m-d') . ' ' . $datetime_now,
      	 		]));

			return Redirect::route('contact.index')
								->with('class', 'success')
								->with('message', 'Record successfully created.');

		}else{
			return Redirect::route('contact.create')
								->withInput()
								->withErrors($validation)
								->with('class', 'error')
								->with('message', 'There were validation errors.');

		}
	}

	/**
	 * Display the specified resource.
	 * GET /contact/{id}
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
	 * GET /contact/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$pagetitle = "Update Contact";
		
		$getcategory = DB::table('contacts')
					->where('id', $id)
					->first();

		if($getcategory->category == 1)
		{
			$contact = Contact::selectContact_forupdate($id);
			$mycompany = DB::table('companies')
					->where('status', '=', 2)
					->where('id', $contact->company)
					->first();
		
			$companies = DB::table('companies')
					->where('status', '=', 2)
					->where('id', '!=', $mycompany->id)
					->orderBy('company_name', 'asc')
					->lists('company_name', 'id');

			$myposition = DB::table('positions')
					->where('id', $contact->in_company_position)
					->orderBy('position', 'asc')
					->first();

			$positions = DB::table('positions')
					->where('id', '!=', $myposition->id)
					->orderBy('position', 'asc')
					->lists('position', 'id');		

		}else{

			$contact = Contact::selectContact_forupdate_individual($id);
			
			$mycompany = array('1','2');
			$myposition = array('1','2');	
		
			$companies = DB::table('companies')
					->where('status', '=', 2)
					->orderBy('company_name', 'asc')
					->lists('company_name', 'id');

			$positions = DB::table('positions')
					->orderBy('position', 'asc')
					->orderBy('position', 'asc')
					->lists('position', 'id');		
		}			
		
		
		$myprofession = DB::table('positions')
					->where('id', $contact->position)
					->orderBy('position', 'asc')
					->first();

		$professions = DB::table('positions')
					->where('id', '!=', $myprofession->id)
					->orderBy('position', 'asc')
					->lists('position', 'id');			

		if($contact->category == 1)
		{
			$category_id = "1";
			$category = "IN-COMPANY";
		}else{
			$category_id = "2";
			$category = "INDIVIDUAL";
		}
		
		return View::make('contact.edit', compact('pagetitle', 'myprofession', 'professions', 'myposition', 'positions', 'mycompany', 'companies', 'contact', 'category_id', 'category'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /contact/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		Input::merge(array_map('trim', Input::all()));
		$input = Input::all();

		$validation = Validator::make($input, Contact::$rules);

		$gettime = time() - 14400;
     	$datetime_now = date("H:i:s", $gettime);

		if(Input::get('fullname') == 'No record found.')
		{
		   return Redirect::route('contact.edit')
								->withInput()
								->with('class', 'error')
								->with('message', 'Input proper fullname.');
		
		}


		if($validation->passes())
		{

			if(Input::get('category') == '1')
			{
				$street = Input::get('street_hid');
				$city = Input::get('city_hid');
				$province = Input::get('province_hid');
				$country = Input::get('country_hid');
				$zip_code = Input::get('zip_code_hid');

				$street_2 = Input::get('street_2');
				$city_2 = Input::get('city_2');
				$province_2 = Input::get('province_2');
				$country_2 = Input::get('country_2');
				$zip_code_2 = Input::get('zip_code_2');

			}else{
				$street = Input::get('i_street');
				$city = Input::get('i_city');
				$province = Input::get('i_province');
				$country = Input::get('i_country');
				$zip_code = Input::get('i_zip_code');

				$street_2 = Input::get('street_2');
				$city_2 = Input::get('city_2');
				$province_2 = Input::get('province_2');
				$country_2 = Input::get('country_2');
				$zip_code_2 = Input::get('zip_code_2');

			}

			if($street == "" || $city == "" || $country == "")
			{
				return Redirect::route('contact.edit', $id)
									->withInput()
									->with('class', 'error')
									->with('message', 'Make sure to fill-up company address.');

			}

			$contact = Contact::find($id);

			if(is_null($contact))
			{
				return Redirect::route('contact.edit', $id)
									->withInput()
									->withErrors($validation)
									->with('class', 'warning')
									->with('message', 'Contact information not exist.');

			}

			$contact->position = Input::get('profession');
			$contact->fullname = strtoupper(Input::get('fullname'));
			$contact->gender = strtoupper(Input::get('gender'));
			$contact->category = Input::get('category');
			$contact->company = Input::get('company');
			$contact->in_company_position = Input::get('position');
			$contact->street = strtoupper($street);
			$contact->city = strtoupper($city);
			$contact->province = strtoupper($province);
			$contact->country = strtoupper($country);
			$contact->zip_code = strtoupper($zip_code);

			$contact->street_2 = strtoupper($street_2);
			$contact->city_2 = strtoupper($city_2);
			$contact->province_2 = strtoupper($province_2);
			$contact->country_2 = strtoupper($country_2);
			$contact->zip_code_2 = strtoupper($zip_code_2);

			$contact->contact_number = Input::get('contact_number');

			$contact->contact_number2 = Input::get('2nd_contact_number');
			$contact->contact_number3 = Input::get('3rd_contact_number');
			$contact->status = 1;
			// if(Contact::check_ifcontactinfoExist($contact))
			// {
			// 	return Redirect::route('contact.edit', $id)
			// 					->withInput()
			// 					->withErrors($validation)
			// 					->with('class', 'warning')
			// 					->with('message', 'Record was already added by BDO.');
			
			// }

			$contactinformation = DB::table('contacts')
									->select('contacts.*', 'positions.position as cp_position')
									->join('positions', 'positions.id', '=', 'contacts.position')
									->where('contacts.id', $id)
									->first();
			
			$pos = DB::table('positions')->where('id', Input::get('position'))->first();

			if($contactinformation->company != '0')
			{
				$comp = Company::where('id', $contactinformation->company)->first();
				$companyname = $comp->company_name;
				$new_comp = Company::where('id', Input::get('company'))->first();
				$new_companyname = $new_comp->company_name;

			}else{
				$companyname = 'N/A';
				$new_companyname = 'N/A';
		
			}

			if(Contact::where('position', Input::get('position'))->where('id', $id)->count() > 0)
			{
				$position = "";
			}else{
				$position = "POSITION : " . $contactinformation->cp_position . " INTO " . strtoupper($pos->position) . ", ";
			}
			if(Contact::where('fullname', strtoupper(Input::get('fullname')))->where('id', $id)->count() > 0)
			{
				$fullname = "";
			}else{
				$fullname = "FULLNAME : " . $contactinformation->fullname . " INTO " . strtoupper(Input::get('fullname')) . ", ";
			}
			if(Contact::where('gender', strtoupper(Input::get('gender')))->where('id', $id)->count() > 0)
			{
				$gender = "";
			}else{
				$gender = "GENDER : " . $contactinformation->gender . " INTO " . strtoupper(Input::get('gender')) . ", ";
			}
			if(Contact::where('company', Input::get('company'))->where('id', $id)->count() > 0)
			{
				$company = "";
			}else{
				$company = "COMPANY : " . $companyname . " INTO " . strtoupper($new_companyname) . ", ";
			}

			if(Input::get('category') == '1')
			{
				if(Contact::where('street', Input::get('street_hid'))->where('city', Input::get('city_hid'))->where('province', Input::get('province_hid'))->where('country', Input::get('country_hid'))->where('zip_code', Input::get('zip_code_hid'))->where('id', $id)->count() > 0)
				{
					$address = "";
				}else{
					$address = "COMPANY ADDRESS : " . $contactinformation->street . " " . $contactinformation->city . ", " . $contactinformation->country . " " . $contactinformation->zip_code . " INTO " . strtoupper(Input::get('street_hid')) . " " . strtoupper(Input::get('city_hid')) . ", " . strtoupper(Input::get('country_hid')) . " " . strtoupper(Input::get('zip_code_hid')) . ", ";
				}

			}else{

				if(Contact::where('street', Input::get('i_street'))->where('city', Input::get('i_city'))->where('province', Input::get('i_province'))->where('country', Input::get('i_country'))->where('zip_code', Input::get('i_zip_code'))->where('id', $id)->count() > 0)
				{
					$address = "";
				}else{
					$address = "PERSONAL ADDRESS : " . $contactinformation->street . " " . $contactinformation->city . ", " . $contactinformation->country . " " . $contactinformation->zip_code . " INTO " . strtoupper(Input::get('i_street')) . " " . strtoupper(Input::get('i_city')) . ", " . strtoupper(Input::get('i_country')) . " " . strtoupper(Input::get('i_zip_code')) . ", ";
				}

			}

			if(Contact::where('contact_number', Input::get('contact_number'))->where('id', $id)->count() > 0)
			{
				$contact1 = "";
			}else{
				$contact1 = "CONTACT NUMBER : " . $contactinformation->contact_number . " INTO " . strtoupper(Input::get('contact_number')) . ", ";
			}
			if(Contact::where('contact_number2', Input::get('2nd_contact_number'))->where('id', $id)->count() > 0)
			{
				$contact2 = "";
			}else{
				$contact2 = "2nd CONTACT NUMBER : " . $contactinformation->contact_number2 . " INTO " . strtoupper(Input::get('2nd_contact_number')) . ", ";
			}
			if(Contact::where('contact_number3', Input::get('3rd_contact_number'))->where('id', $id)->count() > 0)
			{
				$contact3 = "";
			}else{
				$contact3 = "3rd CONTACT NUMBER : " . $contactinformation->contact_number3 . " INTO " . strtoupper(Input::get('3rd_contact_number')) . ", ";
			}

			$contact->save();

			DB::table('contact_status')->insert(array([
      	 			'contact_id' => $contact->id,
      	 			'user_id' => Auth::id(),
      	 			'update' => 'CHANGE ' . $contactinformation->fullname . ' IN CONTACT PERSON RECORD ' . ' | ' . $position . $fullname . $gender . $company . $address . $contact1 . $contact2 . $contact3,
      	 			'created_by' => Auth::id(),
      	 			'created_at' => date('Y-m-d') . ' ' . $datetime_now,
      	 			'access' => 1,
      	 		]));

			return Redirect::route('contact.index')
								->with('class', 'success')
								->with('message', 'Record successfully updated.');

		}else{
			return Redirect::route('contact.edit', $id)
								->withInput()
								->withErrors($validation)
								->with('class', 'error')
								->with('message', 'There were validation errors.');

			
		}

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /contact/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$contact_person = DB::table('contacts')->select('id','fullname','created_by')->where('id', $id)->first();
		$contact = Contact::find($id)->delete();

		$gettime = time() - 14400;
     	$datetime_now = date("H:i:s", $gettime);

		if(is_null($contact)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$class = 'success';
			$message = 'Record successfully deleted.';

			DB::table('contact_status')->insert(array([
	  	 			'contact_id' => $contact_person->id,
	  	 			'user_id' => Auth::id(),
	  	 			'update' => 'REMOVE' . ' ' . $contact_person->fullname . ' ' . 'IN CONTACTS RECORD',
	  	 			'created_by' => $contact_person->created_by,
	  	 			'created_at' => date('Y-m-d') . ' ' . $datetime_now,
	  	 		]));

		}

		return Redirect::route('contact.index')
								->with('class', $class)
								->with('message', $message);
	}

	// ------------------------CC--------------------------------- //

	public function ra()
	{
		$pagetitle = "Contact Person List/s";
		Input::flash();

		$contact = Contact::requestcontactlists(Input::get('status', 1),Input::get('s'));	
		$contact->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();

		$contact_individual = Contact::requestcontactlists_individual(Input::get('status', 1),Input::get('s'));	
		$contact_individual->appends(array('status' => Input::get('status', 1), 's' => Input::get('s')))->links();

		$count_incompany = count(DB::table('contacts')->where('category', 1)->where('status', 1)->get());
		$count_individual = count(DB::table('contacts')->where('category', 2)->where('status', 1)->get());

		$contact_status = DB::table('contact_status')
					->select(DB::raw('concat(users.first_name, " " ,users.last_name, " " ,contact_status.update) as history, contact_status.id, contact_status.created_at, contact_status.access'))
					->join('users', 'users.id', '=', 'contact_status.user_id')
					->where('contact_status.access', '<', 3)
					->orderBy('id', 'desc')->get();

		return View::make('contact.ra', compact('pagetitle','contact', 'contact_status', 'stats', 'contact_individual', 'count_incompany', 'count_individual'));
	}

	public function a($id)
	{
		$contact = Contact::find($id);

		$gettime = time() - 14400;
     	$datetime_now = date("H:i:s", $gettime);

		if(is_null($contact)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$contact->status = 2;
			$contact->notif = 1;
			$contact->notif_dt = date('Y-m-d') . ' ' . $datetime_now;
			$contact->approved_by = Auth::id();
			$contact->save();

			$contact_person = DB::table('contacts')->select('id','fullname','created_by')->where('id', $id)->first();

			DB::table('contact_status')->where('contact_id', $id)->where('access', 1)->update(array('access' => 2));
			DB::table('contact_status')->insert(array([
	  	 			'contact_id' => $contact_person->id,
	  	 			'user_id' => Auth::id(),
	  	 			'update' => 'APPROVED THE REQUEST FOR' . ' ' . $contact_person->fullname,
	  	 			'created_by' => $contact_person->created_by,
	  	 			'created_at' => date('Y-m-d') . ' ' . $datetime_now,
	  	 			'access' => 3,
	  	 		]));

			$class = 'success';
			$message = 'Record successfully Approved.';

		}

		return Redirect::route('contact.ra')
								->with('class', $class)
								->with('message', $message);
	}

	public function d($id)
	{	
		if(Input::get('remarks_hid') == "" || Input::get('remarks_hid') == "Write remarks here.")
		{
			return Redirect::route('contact.dt', $id)
								->withInput()
								->with('class', 'error')
								->with('message', 'Write a *remarks first.');
		}

		$contact = Contact::find($id);

		$gettime = time() - 14400;
     	$datetime_now = date("H:i:s", $gettime);

		if(is_null($contact)){

			$class = 'error';
			$message = 'Record does not exist.';

		}else{

			$contact->remarks = strtoupper(Input::get('remarks_hid'));
			$contact->status = 3;
			$contact->notif = 1;
			$contact->notif_dt = date('Y-m-d') . ' ' . $datetime_now;
			$contact->approved_by = Auth::id();
			$contact->save();

			$contact_person = DB::table('contacts')->select('id','fullname','created_by')->where('id', $id)->first();

			DB::table('contact_status')->where('contact_id', $id)->where('access', 1)->update(array('access' => 2));
			DB::table('contact_status')->insert(array([
	  	 			'contact_id' => $contact_person->id,
	  	 			'user_id' => Auth::id(),
	  	 			'update' => 'DENIED THE REQUEST FOR' . ' ' . $contact_person->fullname,
	  	 			'created_by' => $contact_person->created_by,
	  	 			'created_at' => date('Y-m-d') . ' ' . $datetime_now,
	  	 			'access' => 3,
	  	 		]));

			$class = 'success';
			$message = 'Record successfully Denied.';

		}

		return Redirect::route('contact.ra')
								->with('class', $class)
								->with('message', $message);
	}

	public function details($id)
	{
		$pagetitle = 'Contact Person Details';

		$getcategory = DB::table('contacts')
							->where('id', $id)
							->first();
		
		if($getcategory->category == 1)
		{
			$contact = Contact::selectnfo_fordetails($id);
		}else{
			$contact = Contact::selectnfo_fordetails_individual($id);
		}							

		$almostsame_contact = Contact::almostsame_contact($contact);

		return View::make('contact.details', compact('pagetitle', 'contact', 'getcategory', 'almostsame_contact'));
	}

}