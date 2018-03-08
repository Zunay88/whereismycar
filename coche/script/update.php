<?php

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['coche'])) {

    require __DIR__ . '/library.php';

    $matricula = (isset($data['coche']['matricula']) ? $data['coche']['matricula'] : NULL);
    $marca = (isset($data['coche']['marca']) ? $data['coche']['marca'] : NULL);
    $model = (isset($data['coche']['model']) ? $data['coche']['model'] : NULL);
    $color = (isset($data['coche']['color']) ? $data['coche']['color'] : NULL);

    // validations
    if ($matricula == NULL) {
        http_response_code(400);
        echo json_encode(['errors' => ["El campo es obligatorio"]]);

    } else {

        // Update the Coche
        $coche = new Coche();

        $coche->Update($matricula, $marca, $model, $color);
    }
}

?>
