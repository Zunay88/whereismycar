<?php

require __DIR__ . '/database_connection.php';

/**
 * Class Coche
 */
class Coche
{

    /**
     * @var mysqli|PDO|string
     */
    protected $db;

    /**
     * Coche constructor.
     */
    public function __construct()
    {
        $this->db = DB();
    }

    /**
     * Add new Coche
     *
     * @param $name
     * @param $description
     *
     * @return string
     */
    public function Create($matricula, $marca, $model, $color)
    {
        $query = $this->db->prepare("INSERT INTO coches(matricula, marca, model, color) VALUES (:matricula,:marca,:model,:color)");
        $query->bindParam("matricula", $matricula, PDO::PARAM_STR);
        $query->bindParam("marca", $marca, PDO::PARAM_STR);
        $query->bindParam("model", $model, PDO::PARAM_STR);
        $query->bindParam("color", $color, PDO::PARAM_STR);
        $query->execute();

        return json_encode(['coche' => [
            'matricula'          => $this->db->lastInsertMatricula(),
            'marca'        => $marca,
            'model' => $model,
            'color' => $color
        ]]);
    }

    /**
     * List Coches
     *
     * @return string
     */
    public function Read()
    {
        $query = $this->db->prepare("SELECT * FROM coches");
        $query->execute();
        $data = array();
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return json_encode(['coches' => $data]);
    }


    /**
     * Update Coche
     *
     * @param $marca
     * @param $model
     * @param $matricula
     */
    public function Update($matricula, $marca, $model, $color)
    {
        $query = $this->db->prepare("UPDATE coches SET marca = :marca, model = :model, color = :color WHERE matricula = :matricula");
        $query->bindParam("matricula", $matricula, PDO::PARAM_STR);
        $query->bindParam("marca", $marca, PDO::PARAM_STR);
        $query->bindParam("model", $model, PDO::PARAM_STR);
        $query->bindParam("color", $color, PDO::PARAM_STR);
        $query->execute();
    }

    /**
     * Delete Coche
     *
     * @param $matricula
     */
    public function Delete($matricula)
    {
        $query = $this->db->prepare("DELETE FROM coches WHERE matricula = :matricula");
        $query->bindParam("matricula", $matricula, PDO::PARAM_STR);
        $query->execute();
    }
}
