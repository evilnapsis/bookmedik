<?php

class ReservationData extends LbModel {
	public static $tablename = "reservation";

	public $id;
	public $title;
	public $note;
	public $message;
	public $date_at;
	public $time_at;
	public $created_at;
	public $pacient_id;
	public $symtoms;
	public $sick;
	public $medicaments;
	public $user_id;
	public $medic_id;
	public $price;
	public $is_web;
	public $payment_id;
	public $status_id;

	public function __construct(){
		$this->title = "";
		$this->note = "";
		$this->message = "";
		$this->date_at = date('Y-m-d');
		$this->time_at = date('H:i');
		$this->created_at = date('Y-m-d H:i:s');
		$this->price = 0.0;
		$this->is_web = 0;
		$this->payment_id = 1;
		$this->status_id = 1;
	}

	public function getPacient() {
		return $this->pacient_id ? PacientData::find($this->pacient_id) : null;
	}

	public function getMedic() {
		return $this->medic_id ? MedicData::find($this->medic_id) : null;
	}

	public function getStatus() {
		return $this->status_id ? StatusData::find($this->status_id) : null;
	}

	public function getPayment() {
		return $this->payment_id ? PaymentData::find($this->payment_id) : null;
	}

	public static function getById($id){
		return static::find($id);
	}

	public static function getEvery(): array {
		$db = static::getDb();
		$stmt = $db->query("SELECT * FROM " . static::$tablename . " ORDER BY date_at DESC, time_at DESC");
		return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
	}

	public static function getAll(): array {
		$db = static::getDb();
		$stmt = $db->query("SELECT * FROM " . static::$tablename . " WHERE DATE(date_at) >= CURDATE() ORDER BY date_at ASC, time_at ASC");
		return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
	}

	public static function getAllPendings(): array {
		$db = static::getDb();
		$stmt = $db->query("SELECT * FROM " . static::$tablename . " WHERE DATE(date_at) >= CURDATE() AND status_id = 1 ORDER BY date_at ASC, time_at ASC");
		return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
	}

	public static function getOld(): array {
		$db = static::getDb();
		$stmt = $db->query("SELECT * FROM " . static::$tablename . " WHERE DATE(date_at) < CURDATE() ORDER BY date_at DESC, time_at DESC");
		return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
	}

	public static function getAllByPacientId(int $id): array {
		$db = static::getDb();
		$stmt = $db->prepare("SELECT * FROM " . static::$tablename . " WHERE pacient_id = :id ORDER BY date_at DESC, time_at DESC");
		$stmt->execute(['id' => $id]);
		return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
	}

	public static function getAllByMedicId(int $id): array {
		$db = static::getDb();
		$stmt = $db->prepare("SELECT * FROM " . static::$tablename . " WHERE medic_id = :id ORDER BY date_at DESC, time_at DESC");
		$stmt->execute(['id' => $id]);
		return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
	}

	public static function getRepeated(int $pacientId, int $medicId, string $dateAt, string $timeAt) {
		$db = static::getDb();
		$stmt = $db->prepare("SELECT * FROM " . static::$tablename . " WHERE pacient_id = :pid AND medic_id = :mid AND date_at = :d AND time_at = :t LIMIT 1");
		$stmt->execute(['pid' => $pacientId, 'mid' => $medicId, 'd' => $dateAt, 't' => $timeAt]);
		$stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
		return $stmt->fetch() ?: null;
	}

	public static function getByFilter(array $filters): array {
		$db = static::getDb();
		$sql = "SELECT * FROM " . static::$tablename . " WHERE 1=1";
		$params = [];

		if (!empty($filters['medic_id'])) {
			$sql .= " AND medic_id = :medic_id";
			$params['medic_id'] = $filters['medic_id'];
		}
		if (!empty($filters['pacient_id'])) {
			$sql .= " AND pacient_id = :pacient_id";
			$params['pacient_id'] = $filters['pacient_id'];
		}
		if (!empty($filters['status_id'])) {
			$sql .= " AND status_id = :status_id";
			$params['status_id'] = $filters['status_id'];
		}
		if (!empty($filters['start_at'])) {
			$sql .= " AND date_at >= :start_at";
			$params['start_at'] = $filters['start_at'];
		}
		if (!empty($filters['finish_at'])) {
			$sql .= " AND date_at <= :finish_at";
			$params['finish_at'] = $filters['finish_at'];
		}

		$sql .= " ORDER BY date_at DESC, time_at DESC";
		$stmt = $db->prepare($sql);
		$stmt->execute($params);
		return $stmt->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, static::class);
	}
}
?>
