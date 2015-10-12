<?php

class Area extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
		'area_number' => 'required|integer|between:1,100|unique:areas,area_no',
		'area_place' => 'required|unique:areas,area_place',
		); 

	public static $update_rules = array(
		'area_number' => 'required|integer|between:1,100',
		'area_place' => 'required',
		); 

	public static function checkif_recordexist($area)
	{
		return DB::table('areas')
					->where('area_no', $area->area_no)
					->where('area_place', $area->area_place)
					->first();
	}

	public static function selectrecord($search)
	{
		return DB::table('assigned_areas')
						->select('assigned_areas.id', 'areas.area_no', 'areas.area_place', 'users.first_name', 'users.last_name')
						->join('areas', 'areas.id', '=', 'assigned_areas.area_id')
						->join('users', 'users.id', '=', 'assigned_areas.user_id')
						->where(function($query) use ($search){
						$query->where('areas.area_place', 'LIKE' ,"%$search%")
							->orwhere('users.first_name', 'LIKE' ,"%$search%")
							->orwhere('users.last_name', 'LIKE' ,"%$search%");
						})
						->orderBy('last_name', 'asc')
						->orderBy('first_name', 'asc')
						->paginate(10);
						// ->get();

	}
	
	public static function checkif_alreadyexistinrecord($area_id,$bdo_id)
	{
		return DB::table('assigned_areas')
						->where('area_id', $area_id)
						->where('user_id', $bdo_id)
						->first();
	}

}