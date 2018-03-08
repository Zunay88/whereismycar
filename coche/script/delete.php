<?php

$data = json_decode(file_get_contents('php://input'), TRUE);

if (isset($data['coche'])) {

    require __DIR__ . '/library.php';

    $matricula = (isset($data['coche']['matricula']) ? $data['coche']['matricula'] : NULL);

    // Delete Coche
    $coche = new Coche();

    $coche->Delete($matricula);
}

?>
