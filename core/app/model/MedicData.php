<?php

class MedicData extends LbModel {
	public static $tablename = "medic";

	public $id;
	public $no;
	public $name;
	public $lastname;
	public $gender;
	public $day_of_birth;
	public $email;
	public $address;
	public $phone;
	public $image;
	public $is_active;
	public $created_at;
	public $category_id;

	public function __construct(){
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->address = "";
		$this->phone = "";
		$this->is_active = 1;
		$this->created_at = date('Y-m-d H:i:s');
	}

	public function getCategory() {
		return $this->category_id ? CategoryData::find($this->category_id) : null;
	}

	public static function getById($id){
		return static::find($id);
	}

	public static function getAll(): array {
		$db = static::getDb();
		$stmt = $db->query("SELECT * FROM " . static::$tablename . " ORDER BY created_at DESC");
		return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
	}

	public static function getLike(string $q): array {
		$db = static::getDb();
		$stmt = $db->prepare("SELECT * FROM " . static::$tablename . " WHERE name LIKE :q OR lastname LIKE :q OR email LIKE :q ORDER BY id DESC");
		$stmt->execute(['q' => "%{$q}%"]);
		return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
	}
}
?>
