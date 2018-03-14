<?php

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['incidence'])) {

    require __DIR__ . '/library.php';

    $matricula = (isset($data['incidence']['matricula']) ? $data['incidence']['matricula'] : NULL);
    $descripcion = (isset($data['incidence']['descripcion']) ? $data['incidence']['descripcion'] : NULL);
    $deposito = (isset($data['incidence']['deposito']) ? $data['incidence']['deposito'] : NULL);
    $fecha = (isset($data['incidence']['fecha']) ? $data['incidence']['fecha'] : NULL);
    $estado = (isset($data['incidence']['estado']) ? $data['incidence']['estado'] : NULL);

    // validated the request
    if ($matricula == NULL) {
        http_response_code(400);
        echo json_encode(['errors' => ["La matrícula es obligatoria"]]);

    } else {

        // Add the incidence
        $incidence = new Incidence();

        echo $incidence->Create($matricula, $descripcion, $deposito, $fecha, $estado);
    }
}
?>
