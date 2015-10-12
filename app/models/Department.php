<?php

class Department extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'department' => 'required|unique:departments,department',
		);

}