<?php

class Company extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'company_name' => 'required',
			'client_type' => 'required',
			'street' => 'required',	
			'city' => 'required',
			'region' => 'required',
			'country' => 'required',
			'2nd_region' => 'alpha',
			'2nd_country' => 'alpha',
			'3rd_region' => 'alpha',
			'3rd_country' => 'alpha',
			'telephone_number' => 'required|max:13',
			'mobile_number' => 'required|numeric',
			'email' => 'required|email',
			'2nd_telephone_number' => 'max:13',
			'2nd_mobile_number' => 'numeric',
			'2nd_email' => 'email',
			'3rd_telephone_number' => 'max:13',
			'3rd_mobile_number' => 'numeric',
			'3rd_email' => 'email',
		);

	public static $update_rules = array(
			'company_name' => 'required',
			'client_type' => 'required',
			'street' => 'required',	
			'city' => 'required',
			'region' => 'required',
			'country' => 'required',
			'2nd_region' => 'alpha',
			'2nd_country' => 'alpha',
			'3rd_region' => 'alpha',
			'3rd_country' => 'alpha',
			'telephone_number' => 'required|max:13',
			'mobile_number' => 'required|numeric',
			'email' => 'required|email',
			'2nd_telephone_number' => 'max:13',
			'2nd_mobile_number' => 'numeric',
			'2nd_email' => 'email',
			'3rd_telephone_number' => 'max:13',
			'3rd_mobile_number' => 'numeric',
			'3rd_email' => 'email',
		);

	public static function selectrecord_all($filter,$search)
	{
		return DB::table('companies')
					->select('companies.*', 'cities.city', 'cities2.city as city2', 'cities3.city as city3', 'users.first_name', 'users.last_name')
					->join('users', 'users.id', '=', 'companies.created_by')
					->join('cities', 'cities.id', '=', 'companies.city_id')
					->join('cities as cities2', 'cities2.id', '=', 'companies.city_id2')
					->join('cities as cities3', 'cities3.id', '=', 'companies.city_id3')
					->where('companies.status', $filter)
					->where(function($query) use ($search){
					$query->where('companies.company_name', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%");
					})
					->orderBy('company_name', 'asc')
					->paginate(10);
					// ->get();
	}

	public static function selectrecord($id,$filter,$search)
	{
		return DB::table('companies')
					->select('companies.*', 'cities.city', 'users.first_name', 'users.last_name')
					->join('users', 'users.id', '=', 'companies.created_by')
					->join('cities', 'cities.id', '=', 'companies.city_id')
					->where('companies.created_by', $id)
					->where('companies.status', $filter)
					->where(function($query) use ($search){
					$query->where('companies.company_name', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%");
					})
					->orderBy('company_name', 'asc')
					->paginate(10);
					// ->get();

	}


	public static function selecttype()
	{
		return DB::table('types')
			->select('id', 'client_type')
			->orderBy('client_type')
			->lists('client_type', 'id');
	}

	public static function selectcity()
	{
		return DB::table('cities')
			->select(DB::raw('concat(ucase(city)," - ",ucase(provinces.province)) as city,cities.id'))
			->join('provinces', 'provinces.id', '=', 'cities.province_id')
			->orderBy('city')
			->lists('city', 'id');
	}

	public static function selectprovince()
	{
		return DB::table('provinces')
			->select(DB::raw('concat(ucase(province)," - ",ucase(states.state)) as province,provinces.id'))
			->join('states', 'states.id', '=', 'provinces.state_id')
			->where('provinces.id', '>' , '0')
			->orderBy('province')
			->lists('province', 'id');
	}

	public static function select_ifexist($company)
	{
		return DB::table('companies')
				->where('company_name', $company->company_name)
				->where('status', 2)
				->first();	
	}

	public static function selectrecord_forupdate($id)
	{
		return DB::table('companies')
				->select('companies.*', 'types.client_type', 'cities.city', 'c2.city as city2', 'c3.city as city3', 'provinces.province', 'p2.province as province2', 'p3.province as province3', 'users.first_name', 'users.middle_initial', 'users.last_name')	
				->join('types', 'types.id' , '=' , 'companies.type_id')
				->join('cities', 'cities.id' , '=' , 'companies.city_id')
				->join('cities as c2', 'c2.id' , '=' , 'companies.city_id2')
				->join('cities as c3', 'c3.id' , '=' , 'companies.city_id3')
				->join('provinces', 'provinces.id' , '=' , 'companies.province_id')
				->join('provinces as p2', 'p2.id' , '=' , 'companies.province_id2')
				->join('provinces as p3', 'p3.id' , '=' , 'companies.province_id3')
				->join('users', 'users.id' , '=' , 'companies.created_by')
				->where('companies.id', $id)
				->first();		
	}

	public static function selectinfo_forupdate($company)
	{
		return DB::table('companies')
				->where('company_name', $company->company_name)
				->where('contact_id', $company->contact_id)
				->first();
	}

	public static function selectnfo_fordetails($id)
	{
		return DB::table('companies')
				->select('companies.*', 'types.client_type', 'cities.city', 'c2.city as city2', 'c3.city as city3', 'provinces.province', 'p2.province as province2', 'p3.province as province3', 'users.first_name', 'users.middle_initial', 'users.last_name')	
				->join('types', 'types.id' , '=' , 'companies.type_id')
				->join('cities', 'cities.id' , '=' , 'companies.city_id')
				->join('cities as c2', 'c2.id' , '=' , 'companies.city_id2')
				->join('cities as c3', 'c3.id' , '=' , 'companies.city_id3')
				->join('provinces', 'provinces.id' , '=' , 'companies.province_id')
				->join('provinces as p2', 'p2.id' , '=' , 'companies.province_id2')
				->join('provinces as p3', 'p3.id' , '=' , 'companies.province_id3')
				->join('users', 'users.id' , '=' , 'companies.created_by')
				->where('companies.id', $id)
				->first();
	}

	public static function selectsameinfo_fordetails($company)
	{
		return DB::table('companies')
				->select('companies.company_name', 'users.first_name', 'users.last_name')	
				->join('users', 'users.id' , '=' , 'companies.created_by')
				->where('companies.status', 2)
				->where(function($query) use ($company){
					$compname_keys = explode(" ",$company->company_name);
					$clienttype_keys = explode(" ", $company->type_id);
					$street_keys = explode(" ", $company->street);
					$city_keys = explode(" ", $company->city_id);
					$region_keys = explode(" ", $company->region);
					$country_keys = explode(" ", $company->country);
					$city2_keys = explode(" ", $company->city_id2);
					$region2_keys = explode(" ", $company->region2);
					$country2_keys = explode(" ", $company->country2);
					$telephone_keys = explode(" ", $company->telephone_number);
					$mobile_keys = explode(" ", $company->mobile_number);
					$telephone2_keys = explode(" ", $company->telephone_number2);
					$mobile2_keys = explode(" ", $company->mobile_number2);

					$query->where(function($subquery) use ($compname_keys){
						for( $i=0; $i<count($compname_keys); $i++){
							if($compname_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('company_name','LIKE', "%$compname_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('company_name', 'LIKE', "%$compname_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($clienttype_keys){
						for( $i=0; $i<count($clienttype_keys); $i++){
							if($clienttype_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('type_id','LIKE', "%$clienttype_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('type_id', 'LIKE', "%$clienttype_keys[$i]%");
						   		}
							}
						}
					})

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
							  		$subquery->where('city_id','LIKE', "%$city_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('city_id', 'LIKE', "%$city_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($region_keys){
						for( $i=0; $i<count($region_keys); $i++){
							if($region_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('region','LIKE', "%$region_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('region', 'LIKE', "%$region_keys[$i]%");
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

					->orwhere(function($subquery) use ($city2_keys){
						for( $i=0; $i<count($city2_keys); $i++){
							if($city2_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('city_id2','LIKE', "%$city2_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('city_id2', 'LIKE', "%$city2_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($region2_keys){
						for( $i=0; $i<count($region2_keys); $i++){
							if($region2_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('region2','LIKE', "%$region2_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('region2', 'LIKE', "%$region2_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($country2_keys){
						for( $i=0; $i<count($country2_keys); $i++){
							if($country2_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('country2','LIKE', "%$country2_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('country2', 'LIKE', "%$country2_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($telephone_keys){
						for( $i=0; $i<count($telephone_keys); $i++){
							if($telephone_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('telephone_number','LIKE', "%$telephone_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('telephone_number', 'LIKE', "%$telephone_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($mobile_keys){
						for( $i=0; $i<count($mobile_keys); $i++){
							if($mobile_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('mobile_number','LIKE', "%$mobile_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('mobile_number', 'LIKE', "%$mobile_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($telephone2_keys){
						for( $i=0; $i<count($telephone2_keys); $i++){
							if($telephone2_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('telephone_number2','LIKE', "%$telephone2_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('telephone_number2', 'LIKE', "%$telephone2_keys[$i]%");
						   		}
							}
						}
					})

					->orwhere(function($subquery) use ($mobile2_keys){
						for( $i=0; $i<count($mobile2_keys); $i++){
							if($mobile2_keys[$i] != ''){
								if($i==0){
							  		$subquery->where('mobile_number2','LIKE', "%$mobile2_keys[$i]%");
						   		}else{
							  		$subquery->orWhere('mobile_number2', 'LIKE', "%$mobile2_keys[$i]%");
						   		}
							}
						}
					});


					
				})
				->get();
	}

	public static function requestcompanylist($filter,$search)
	{
		return DB::table('companies')
					->select('companies.*', 'cities.city', 'users.first_name', 'users.last_name')
					->join('users', 'users.id', '=', 'companies.created_by')
					->join('cities', 'cities.id', '=', 'companies.city_id')
					// ->join('types', 'types.id', '=', 'companies.type_id')
					// ->join('provinces', 'provinces.id', '=', 'companies.province_id')
					->where('companies.status', $filter)
					->where(function($query) use ($search){
					$query->where('companies.company_name', 'LIKE' ,"%$search%")
						->orwhere('users.first_name', 'LIKE' ,"%$search%")
						->orwhere('users.last_name', 'LIKE' ,"%$search%")
						->orwhere('companies.street', 'LIKE' ,"%$search%")
						->orwhere('companies.street2', 'LIKE' ,"%$search%")
						->orwhere('cities.city', 'LIKE' ,"%$search%")
						->orwhere('companies.country', 'LIKE' ,"%$search%");
					})
					->orderBy('company_name', 'asc')
					->paginate(10);
					// ->get();
	}

}