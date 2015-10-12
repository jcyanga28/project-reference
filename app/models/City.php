<?php

class City extends \Eloquent {
	protected $fillable = [];

	public static function selectCity()
	{
		return DB::table('cities')->select(DB::raw('concat(ucase(city)," - ",ucase(provinces.province)) as city,cities.id'))
			->join('provinces', 'provinces.id', '=', 'cities.province_id')
			->orderBy('city')
			->lists('city', 'id');
	}
}