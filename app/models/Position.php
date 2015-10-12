<?php

class Position extends \Eloquent {
	protected $fillable = [];

	public static $rules = array(
			'position' => 'required|unique:positions,position',
		);
}