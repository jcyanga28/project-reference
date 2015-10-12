<?php

class Province extends \Eloquent {
	protected $fillable = [];

	public static function selectProvince()
	{
		return DB::table('provinces')->select(DB::raw('concat(ucase(province)," - ",ucase(states.state)) as province,provinces.id'))
			->join('states', 'states.id', '=', 'provinces.state_id')
			->orderBy('province')
			->lists('province', 'id');
	}

	public static function selectProvince_forproject()
	{
		return DB::table('provinces')->select(DB::raw('concat(ucase(province)," - ",ucase(states.state)) as province,provinces.id'))
			->join('states', 'states.id', '=', 'provinces.state_id')
			->where('provinces.id', '>', '0')
			->orderBy('province')
			->lists('province', 'id');
	}

}