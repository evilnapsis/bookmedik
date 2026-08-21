<?php

class CategoryData extends LbModel {
	public static $tablename = "category";

	public $id;
	public $name;

	public function __construct(){
		$this->name = "";
	}

	public static function getById($id){
		return static::find($id);
	}

	public static function getAll(): array {
		return static::all();
	}

	public static function getLike(string $q): array {
		$db = static::getDb();
		$stmt = $db->prepare("SELECT * FROM " . static::$tablename . " WHERE name LIKE :q ORDER BY id DESC");
		$stmt->execute(['q' => "%{$q}%"]);
		return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
	}
}
?>
