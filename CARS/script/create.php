<?php

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['car'])) {

    require __DIR__ . '/library.php';

    $matricula = (isset($data['car']['matricula']) ? $data['car']['matricula'] : NULL);
    $marca = (isset($data['car']['marca']) ? $data['car']['marca'] : NULL);
    $modelo = (isset($data['car']['modelo']) ? $data['car']['modelo'] : NULL);
    $color = (isset($data['car']['color']) ? $data['car']['color'] : NULL);

    // validated the request
    if ($matricula == NULL) {
        http_response_code(400);
        echo json_encode(['errors' => ["La matrícula es obligatoria"]]);

    } else {

        // Add the task
        $car = new Car();

        echo $car->Create($matricula, $marca, $modelo, $color);
    }
}
?>
