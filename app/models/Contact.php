<?php

class Contact extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'profession' => 'required',
			'fullname' => 'required',
			'contact_number' => 'required|min:7|max:13',
			'2nd_contact_number' => 'min:9|max:13',
			'3rd_contact_number' => 'min:9|max:13',
		);

	public static function processcontactlists_all($filter,$search)
	{
		return DB::table('contacts')
				->select('contacts.*', 'companies.company_name')
				->join('companies', 'companies.id', '=' , 'contacts.company')
				->where('contacts.category', 1)
				->where('contacts.status', $filter)
				->where(function($query) use ($search){
				$query->where('contacts.fullname', 'LIKE' ,"%$search%")
					->orwhere('contacts.street', 'LIKE' ,"%$search%")
					->orwhere('contacts.city', 'LIKE' ,"%$search%")
					->orWhere('contacts.country', 'LIKE' ,"%$search%")
					->orWhere('companies.company_name', 'LIKE', "%$search%");
				})
				->paginate(10);
				// ->get();
	}

	public static function processcontactlists_allindividual($filter,$search)
	{
		return DB::table('contacts')
				->where('category', 2)
				->where('status', $filter)
				->where(function($query) use ($search){
				$query->where('fullname', 'LIKE' ,"%$search%")
					->orwhere('street', 'LIKE' ,"%$search%")
					->orwhere('city', 'LIKE' ,"%$search%")
					->orWhere('country', 'LIKE' ,"%$search%");
				})
				->paginate(10);
				// ->get();
	}

	public static function processcontactlists($id,$filter,$search)
	{
		return DB::table('contacts')
				->select('contacts.*', 'companies.company_name')
				->join('companies', 'companies.id', '=' , 'contacts.company')
				->where('contacts.category', 1)
				->where('contacts.created_by', $id)
				->where('contacts.status', $filter)
				->where(function($query) use ($search){
				$query->where('contacts.fullname', 'LIKE' ,"%$search%")
					->orwhere('contacts.street', 'LIKE' ,"%$search%")
					->orwhere('contacts.city', 'LIKE' ,"%$search%")
					->orWhere('contacts.country', 'LIKE' ,"%$search%")
					->orWhere('companies.company_name', 'LIKE', "%$search%");
				})
				->paginate(10);
				// ->get();
	}

	public static function processcontactlists_individual($id,$filter,$search)
	{
		return DB::table('contacts')
				->where('category', 2)
				->where('created_by', $id)
				->where('status', $filter)
				->where(function($query) use ($search){
				$query->where('fullname', 'LIKE' ,"%$search%")
					->orwhere('street', 'LIKE' ,"%$search%")
					->orwhere('city', 'LIKE' ,"%$search%")
					->orWhere('country', 'LIKE' ,"%$search%");
				})
				->paginate(10);
				// ->get();
	}

	public static function select_position()
	{
		return DB::table('positions')
				->orderBy('position', 'asc')
				->lists('position', 'id');	
	}	
	public static function select_approvedcompanies()
	{
		return DB::table('companies')
					->where('status', '=', 2)
					->orderBy('company_name', 'asc')
					->lists('company_name', 'id');
	}
	// public static function processcontactlists($id,$filter,$search)
	// {
	// 	return DB::table('contacts')
	// 			->select('contacts.*', 'cities.city')
	// 			->join('cities', 'cities.id', '=' , 'contacts.city')
	// 			->where('contacts.created_by', $id)
	// 			->where('contacts.status', $filter)
	// 			->where('contacts.fullname', 'LIKE', "%$search%")
	// 			->get();
	// }

	public static function contactinfoExist($contact)
	{
		return DB::table('contacts')
					->where('fullname', $contact->fullname)
					->where('company', $contact->company)
				    ->first();	
	}

	public static function selectContact_forupdate($id)
	{
		return DB::table('contacts')
					->select('contacts.*', 'companies.company_name')
					->join('companies', 'companies.id', '=', 'contacts.company')
					->where('contacts.id', $id)
					->first();
	}

	public static function selectContact_forupdate_individual($id)
	{
		return DB::table('contacts')
					->where('contacts.id', $id)
					->first();
	}

	public static function check_ifcontactinfoExist($contact)
	{
		return DB::table('contacts')
					->where('fullname', $contact->fullname)
				    ->where('company', $contact->company)
				    ->first();		
	}

	public static function requestcontactlists($filter,$search)
	{
		return DB::table('contacts')
				->select('contacts.*', 'companies.company_name', 'users.first_name', 'users.middle_initial', 'users.last_name')
				->join('users', 'users.id', '=' , 'contacts.created_by')
				->join('companies', 'companies.id', '=' , 'contacts.company')
				->where('contacts.category', 1)
				->where('contacts.status', $filter)
				->where(function($query) use ($search){
				$query->where('contacts.fullname', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('contacts.street', 'LIKE' ,"%$search%")
					->orwhere('contacts.city', 'LIKE' ,"%$search%")
					->orwhere('contacts.country', 'LIKE' ,"%$search%")
					->orwhere('contacts.contact_number', 'LIKE' ,"%$search%")
					->orwhere('companies.company_name', 'LIKE' ,"%$search%");
				})
				->orderBy('fullname', 'asc')
				->paginate(10);
				// ->get();
	}

	public static function requestcontactlists_individual($filter,$search)
	{
		return DB::table('contacts')
				->select('contacts.*', 'users.first_name', 'users.middle_initial', 'users.last_name')
				->join('users', 'users.id', '=' , 'contacts.created_by')
				->where('contacts.category', 2)
				->where('contacts.status', $filter)
				->where(function($query) use ($search){
				$query->where('contacts.fullname', 'LIKE' ,"%$search%")
					->orwhere('users.first_name', 'LIKE' ,"%$search%")
					->orwhere('users.last_name', 'LIKE' ,"%$search%")
					->orwhere('contacts.street', 'LIKE' ,"%$search%")
					->orwhere('contacts.city', 'LIKE' ,"%$search%")
					->orwhere('contacts.country', 'LIKE' ,"%$search%")
					->orwhere('contacts.contact_number', 'LIKE' ,"%$search%");
				})
				->orderBy('fullname', 'asc')
				->paginate(10);
				// ->get();
	}

	public static function selectnfo_fordetails($id)
	{
		return DB::table('contacts')
				->select('contacts.*', 'positions.id as posid', 'positions.position', 'in_company.position as incompany_position', 'companies.company_name', 'users.first_name', 'users.middle_initial', 'users.last_name')
				->join('users', 'users.id', '=' , 'contacts.created_by')
				->join('companies', 'companies.id', '=' , 'contacts.company')
				->join('positions', 'positions.id', '=' , 'contacts.position')
				->join('positions as in_company', 'in_company.id', '=' , 'contacts.in_company_position')
				->where('contacts.id', $id)
				->first();

	}

	public static function selectnfo_fordetails_individual($id)
	{
		return DB::table('contacts')
				->select('contacts.*', 'positions.id as posid', 'positions.position', 'users.first_name', 'users.middle_initial', 'users.last_name')
				->join('users', 'users.id', '=' , 'contacts.created_by')
				->join('positions', 'positions.id', '=' , 'contacts.position')
				->where('contacts.id', $id)
				->first();

	}

	public static function almostsame_contact($contact)
	{
		return DB::table('contacts')
				->select('contacts.*', 'positions.position', 'users.first_name', 'users.middle_initial', 'users.last_name')
				->join('users', 'users.id', '=' , 'contacts.created_by')
				// ->join('companies', 'companies.id', '=' , 'contacts.company')
				->join('positions', 'positions.id', '=' , 'contacts.position')
				->where('contacts.status', 2)
				->where(function($query) use ($contact){
					$name_keys = explode(" ",$contact->fullname);
					$position_keys = explode(" ",$contact->posid);
					// $company_keys = explode(" ",$contact->company);
					$street_keys = explode(" ",$contact->street);
					$city_keys = explode(" ",$contact->city);
					$country_keys = explode(" ",$contact->country);
					$contact1_keys = explode(" ",$contact->contact_number);
					$contact2_keys = explode(" ",$contact->contact_number2);
					$contact3_keys = explode(" ",$contact->contact_number3);

					$query->where(function($subquery) use ($name_keys){
						for( $i=0; $i<count($name_keys); $i++){
							if($name_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('fullname','LIKE', "%$name_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('fullname', 'LIKE', "%$name_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($position_keys){
						for( $i=0; $i<count($position_keys); $i++){
							if($position_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('contacts.position','LIKE', "%$position_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('contacts.position', 'LIKE', "%$position_keys[$i]%");
						   		}
							}
						}
					})

					// ->orwhere(function($subquery) use ($company_keys){
					// 	for( $i=0; $i<count($company_keys); $i++){
					// 		if($company_keys[$i] != ''){
					// 			if($i==0){
					// 		  		$subquery->where('company','LIKE', "%$company_keys[$i]%");
					// 	   		}else{
					// 		  		$subquery->orWhere('company', 'LIKE', "%$company_keys[$i]%");
					// 	   		}
					// 		}
					// 	}
					// })

					->orwhere(function($subquery) use ($street_keys){
						for( $i=0; $i<count($street_keys); $i++){
							if($street_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('street','LIKE', "%$street_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('street', 'LIKE', "%$street_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($city_keys){
						for( $i=0; $i<count($city_keys); $i++){
							if($city_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('city','LIKE', "%$city_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('city', 'LIKE', "%$city_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($country_keys){
						for( $i=0; $i<count($country_keys); $i++){
							if($country_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('country','LIKE', "%$country_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('country', 'LIKE', "%$country_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($contact1_keys){
						for( $i=0; $i<count($contact1_keys); $i++){
							if($contact1_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('contact_number','LIKE', "%$contact1_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('contact_number', 'LIKE', "%$contact1_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($contact2_keys){
						for( $i=0; $i<count($contact2_keys); $i++){
							if($contact2_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('contact_number2','LIKE', "%$contact2_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('contact_number2', 'LIKE', "%$contact2_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($contact3_keys){
						for( $i=0; $i<count($contact3_keys); $i++){
							if($contact3_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('contact_number3','LIKE', "%$contact3_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('contact_number3', 'LIKE', "%$contact3_keys[$i]%");
						   		}
							}
						}
					});

			})
			->orderBy('fullname', 'asc')
			->get();	
	}

}