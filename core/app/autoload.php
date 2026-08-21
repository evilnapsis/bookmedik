<?php
/**
 * BookMedik v5 - Autoloader para Modelos, Controladores y Servicios
 * Basado en la arquitectura LegoBox v5 (lb-min-5)
 */

function my_autoload($className){
	// 1. Carga automática de Modelos en core/app/model/
	$modelPath = __DIR__ . "/model/" . $className . ".php";
	if (file_exists($modelPath)) {
		include $modelPath;
		return;
	} 

	// 2. Carga automática PSR-4 para namespaces App\Controller\ y App\Service\
	if (strpos($className, 'App\\') === 0) {
		$parts = explode('\\', $className);
		if (count($parts) >= 3) {
			$subfolder = strtolower($parts[1]); // 'controller' o 'service'
			$classname = $parts[2];
			$fullpath = __DIR__ . "/" . $subfolder . "/" . $classname . ".php";
			if (file_exists($fullpath)) {
				include $fullpath;
			}
		}
	}
}

spl_autoload_register("my_autoload");
?>