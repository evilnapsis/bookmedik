<?php

class SettingData extends LbModel {
	public static $tablename = "setting";

	public $id;
	public $name;
	public $label;
	public $kind;
	public $val;
	public $cfg_id;

	public static function getById($id){
		return static::find($id);
	}

	public static function getByName(string $name) {
		self::ensureTableExists();
		return static::whereOne('name', $name);
	}

	public static function updateValFromName(string $name, string $val): bool {
		self::ensureTableExists();
		$db = static::getDb();
		$stmt = $db->prepare("UPDATE " . static::$tablename . " SET val = :val WHERE name = :name");
		return $stmt->execute(['val' => $val, 'name' => $name]);
	}

	public static function ensureTableExists(): void {
		$db = static::getDb();
		$db->exec("CREATE TABLE IF NOT EXISTS setting (
			id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(100) NOT NULL UNIQUE,
			label VARCHAR(255) NOT NULL,
			kind INT DEFAULT 1,
			val TEXT,
			cfg_id INT DEFAULT 1
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

		$stmt = $db->query("SELECT COUNT(*) FROM setting");
		if ($stmt->fetchColumn() == 0) {
			$db->exec("INSERT INTO setting (name, label, val) VALUES 
				('title', 'Título del Sistema', 'BookMedik v5'),
				('admin_email', 'Correo Administrador', 'admin@bookmedik.com')
			;");
		}
	}

	public static function getAll(): array {
		self::ensureTableExists();
		return static::all();
	}
}
?>