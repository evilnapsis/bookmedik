<?php



class TableTool {

	public static $table_header;

	public static function setHeader($thead){
		self::$table_header = $thead;

	}

	public static function render($data=array(), $extra=""){
		$table = "<table class=\"table table-bordered\">";
		$table .= "<thead>";
		foreach($data["header"] as $h){
			$table .= "<th>$h</th>";
		}
		$table .="</thead>";
		foreach($data["body"] as $b){
			$table.="<tr>";
			foreach($b as $d){
				$table .= "<td>".$d."</td>";
			}
			$table.="</tr>";
		}
		$table .="</table>";
		return $table;
	}

		public static function getHeader(){
		echo "<thead>";
		for($i=0; $i<count(self::$table_header);$i++){
			echo "<th>".self::$table_header[$i]."</th>";
		}
		echo "</thead>";
	}


}


?>