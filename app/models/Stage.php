<?php

class Stage extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'project_stage' => 'required|unique:stages,stage',
			'description' => 'required',
		);

	public static $update_rules = array(
			'project_stage' => 'required',
			'description' => 'required',
		);

}