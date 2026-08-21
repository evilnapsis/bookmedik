<?php

class StatusData extends LbModel {
	public static $tablename = "status";

	public $id;
	public $name;

	public static function getById($id){
		return static::find($id);
	}

	public static function getAll(): array {
		return static::all();
	}
}
?>
