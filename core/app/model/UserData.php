<?php

class UserData extends LbModel {
	public static $tablename = "user";

	public $id;
	public $username;
	public $name;
	public $lastname;
	public $email;
	public $password;
	public $is_active;
	public $is_admin;
	public $kind;
	public $created_at;

	public function __construct(){
		$this->username = "";
		$this->name = "";
		$this->lastname = "";
		$this->email = "";
		$this->password = "";
		$this->is_active = 1;
		$this->is_admin = 0;
		$this->kind = 2;
		$this->created_at = date('Y-m-d H:i:s');
	}

	public static function getById($id){
		return static::find($id);
	}

	public static function getByUsernameOrEmail(string $username) {
		$db = static::getDb();
		$stmt = $db->prepare("SELECT * FROM " . static::$tablename . " WHERE (username = :u OR email = :u) AND (is_active = 1 OR is_active IS NULL) LIMIT 1");
		$stmt->execute(['u' => $username]);
		$stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
		return $stmt->fetch() ?: null;
	}

	public static function getLogin(string $username, string $password) {
		$user = static::getByUsernameOrEmail($username);
		if (!$user) {
			return null;
		}

		// 1. Verificar si la contraseña usa Bcrypt estándar (password_verify)
		if (password_verify($password, $user->password)) {
			return $user;
		}

		// 2. Verificar hash legacy BookMedik: sha1(md5($password)) o md5($password)
		$legacySha1Md5 = sha1(md5($password));
		$legacyMd5 = md5($password);

		if ($user->password === $legacySha1Md5 || $user->password === $legacyMd5 || $user->password === $password) {
			// Auto-actualizar el hash del usuario a Bcrypt de manera transparente
			$user->password = password_hash($password, PASSWORD_DEFAULT);
			$user->save();
			return $user;
		}

		return null;
	}

	public static function getAll(): array {
		$db = static::getDb();
		$stmt = $db->query("SELECT * FROM " . static::$tablename . " ORDER BY id DESC");
		return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
	}
}
?>