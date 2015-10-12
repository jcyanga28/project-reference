<?php

class Type extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'client' => 'required|unique:types,client_type',
			'description' => 'unique:types,client_type',
		);

	public static $update_rules = array(
			'client' => 'required',
		);

	public static function checkif_exist($client)
	{
		return DB::table('types')
					->where('client_type', $client->client_type)
					->where('desc', $client->desc)
					->first();
	}
}