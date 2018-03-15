<?php 
	$mysqli = new mysqli("localhost","cars","123456","cars");
	//require __DIR__ . '/database_connection.php';
	$salida = "";
	$query = "SELECT * FROM cars";

	if(isset($_POST['consulta'])){
		$q = $mysqli->real_escape_string($POST['consulta']);
		$query = "SELECT matricula FROM cars
		WHERE matricula like '%".$q."%' ";
	}

	$resultado = $mysqli->query($query);

	if($resultado->num_rows>0){
		$salida.="<table class='tabla_de_datos'>
						<thead>
							<td>Matrícula</td>
							<td>Marca</td>
							<td>Modelo</td>
							<td>Color</td>
						</thead>
						<tbody>
					";

		while($fila = $resultado->fetch_assoc()){
			$saida.= "
				<tr>
				<td>".$fila['matricula']."</td>
				<td>".$fila['marca']."</td>
				<td>".$fila['modelo']."</td>
				<td>".$fila['color']."</td>
				</tr>
			";
		}

		$salida.="</tbody></table>";
	}else{
		$salida.="esa matricula no la tenemos:´(";
	}

	echo $salida;

	$mysqli->close();
?>