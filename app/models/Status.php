<?php

class Status extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'project_status' => 'required|unique:statuses,status',
			'description' => 'required',
		);

	public static $update_rules = array(
			'project_status' => 'required',
			'description' => 'required',
		);

}