<?php
class SettingData {
	public static $tablename = "setting";


	public function __construct(){
		$this->title = "";
		$this->content = "";
		$this->image = "";
		$this->user_id = "";
		$this->is_public = "0";
		$this->created_at = "NOW()";
	}

	public function add(){
		$sql = "insert into ".self::$tablename." (name,label,val) ";
		$sql .= "value (\"$this->name\",\"$this->label\",\"$this->val\")";
		Executor::doit($sql);
	}

	public static function delById($id){
		$sql = "delete from ".self::$tablename." where id=$id";
		Executor::doit($sql);
	}
	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

// partiendo de que ya tenemos creado un objecto SettingData previamente utilizamos el contexto
	public function update(){
		$sql = "update ".self::$tablename." set name=\"$this->name\",label=\"$this->label\",is_active=\"$this->is_active\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function updateValFromName($name,$val){
		$sql = "update ".self::$tablename." set val=\"$val\" where name=\"$name\"";		
		Executor::doit($sql);
	}

	public static function getById($id){
		$sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SettingData());
	}

	public static function getByPreffix($id){
		$sql = "select * from ".self::$tablename." where name=\"$id\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new SettingData());
	}


	public static function getAll(){
		$sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new SettingData());
	}

	public static function getPublics(){
		$sql = "select * from ".self::$tablename." where is_active=1";
		$query = Executor::doit($sql);
		return Model::many($query[0],new SettingData());
	}

}

?>