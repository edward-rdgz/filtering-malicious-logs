<?php
/*
 * Author: Edward - econtreras@topmre.com
 * Date: 2017/03/07
 */
// aumenta el tiempo maximo de ejecución.
ini_set('max_execution_time', 30000);
// ruta del archivo
$path = 'server-logs.txt';
// declaración del arreglo.
$group_lines = [];
// transifere un archivo completo a un arreglo.
$lines = file($path);
// recorre el arreglo de lineas.
foreach ($lines as $num_line => $line) {
	// divide la cadena en pezados y los almacena en un arreglo.
	$group_lines[$num_line] = explode(' ', $line);
}
// contador
$counter = 0;
// recorre el arreglo con lineas agrupadas.
foreach ($group_lines as $num_group => $group) {
	// asgina el valor de la posición actual.
	$date = $group[3];
	// remplaza los caracteres innecesarios.
	$date = str_replace(['[', '/', ':'], '', $date);
	// crea la fecha.
	$date = date_create($date);
	// formatea la fecha.
	$date = date_format($date, 'Y-m-d H:i:s');
	// reasigna el nuevo valor en la posición actual.
	$group[3] = $date;
	// remplaza valor innecesario, convierte a minuscula, decodifica a estilo url y remplaza nuevamente valor innecesario para limpiar la cadena.  
	$group6 =  str_replace('/**/', ' ', 
			strtolower(
				rawurldecode(
					str_replace('+', ' ', 
						$group[6]
					)
				)
			)
		 ) . "<br><br>";

	$group10 = str_replace('/**/', ' ', 
			strtolower(
				rawurldecode(
					str_replace('+', ' ', 
						$group[10]
					)
				)
			)
		 ) . "<br><br>";
	// encuenta la posición de la primera ocurrencia de una subcadena en una cadena.
	$res6 = strpos($group6, 'select');
	// comprueba existencia.
	if ($res6 !== false) {
		// encuentra la primera aparición de una cadena y muestra el resto a partir de ahí.
		$group6 = strstr($group6, 'propid');
		// remplaza los caracteres.
		$group6 = str_replace('. ', '.', $group6);
		// imprime el valor final
		echo $group6;
		// aumenta el contador.
		$counter++;
	}

	$res10 =  strpos($group10, 'select');
	if ($res10 !== false) {
		$group10 = strstr($group10, 'propid=');
		$group10 = str_replace('. ', '.', $group10);
		echo $group10;
		$counter++;
	}
}
// imprime el total.
echo 'Cantidad de inyeciones: '.$counter;