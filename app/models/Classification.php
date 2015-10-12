<?php

class Classification extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'project_classification' => 'required|unique:classifications,classification',
		);

	public static $update_rules = array(
			'project_classification' => 'required',
		);

}