<?php

class Extra {

	public $extra_fields;
	public $extra_fields_strings;

	public function __construct(){
		$this->extra_fields = array();
	}

	public function addExtraField($name, $value ){
		$extra = $this->extra_fields;

		$data = array("name"=>$name, "value"=> $value);
		
		$extra[] = $data;
		//array_push($extra, $data);

		$this->extra_fields[] = $extra;

	}

	public function addExtraFieldString($name, $value ){

		$extra = $this->extra_fields_strings;

		$data = array("name"=>$name, "value"=> "\"$value\"");
		$extra[] = $data;
//		array_push($extra, $data);

		$this->extra_fields_strings = $extra;

	}

	public function getExtraFieldNames(){
		$extra_names = array();
		$extra = $this->extra_fields;

		foreach($this->extra_fields as $k){

			$extra_names[] = $v["name"];
		}
		$extra = $this->extra_fields_strings;
		
		foreach($this->extra_fields_strings as $k=>$v){
			$extra_names[] = $v["name"];
		}
		return implode(",", $extra_names);
	}

	public function getExtraFieldValues(){
		$extra_values = array();
		$extra = $this->extra_fields;

		foreach($this->extra_fields as $k){

			$extra_values[] = $v["value"];
		}
		$extra = $this->extra_fields_strings;
		
		foreach($this->extra_fields_strings as $k=>$v){
			$extra_values[] = $v["value"];
		}
		return implode(",", $extra_values);
	}

	public function getExtraFieldforUpdate(){
		$extra_values = array();
		$extra = $this->extra_fields;

		foreach($this->extra_fields as $k){
			$extra_values[] = "$v[name] = $v[value]";
		}
		$extra = $this->extra_fields_strings;
		
		foreach($this->extra_fields_strings as $k=>$v){
			$extra_values[] = "$v[name]=$v[value]";
		}
		return implode(",", $extra_values);
	}


}


?>