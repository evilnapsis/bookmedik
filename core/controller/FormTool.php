<?php


/**
* Form.php
* Clase para crear inputs y selects de formularios
**/

class FormTool 
{
	
	public static function input($type="text",$name="",$value="",$place="",$extra="")
	{
		return "<input type=\"$type\" name=\"$name\" value=\"$value\" placeholder=\"$place\" class=\"form-control\" $extra>";
	}

	/* sin class-form, util para input hidden, file, checkbox, radio ...*/
	public static function input2($type="hidden",$name="",$value="",$extra="")
	{
		return "<input type=\"$type\" name=\"$name\" value=\"$value\" $extra>";
	}

	public static function submit($value="Submit",$c="default",$extra="")
	{
		return "<input type=\"submit\" value=\"$value\" class=\"btn btn-$c\" $extra>";
	}

	public static function select($name="",$data=array(),$value="",$extra="")
	{
		$select = "<select name=\"$name\" $extra class=\"form-control\">";
		$selected = "";
		foreach($data as $d){
			if($d["value"]==$value){ $selected="selected"; }else{ $selected=""; }
			$select .= "<option value=\"".$d["value"]."\" $selected>".$d["name"]."</option>";
		}
		$select.="</select>";
		return $select;
	}


	public static function addInput( $type, $name,$tag, $extra ){
		echo   "<div class='form-group'>
    <label for='exampleInputEmail1'>$tag</label>
    <input type='$type' name='$name' class='form-control' id='$name' placeholder='$tag' $extra>
  </div>";
	}
	public static function addInputVal( $type, $name,$value, $tag, $extra ){
		echo   "<div class='form-group'>
    <label for='exampleInputEmail1'>$tag</label>
    <input type='$type' name='$name' value='$value' class='form-control' id='$name' placeholder='$tag' $extra>
  </div>";
	}
}


?>