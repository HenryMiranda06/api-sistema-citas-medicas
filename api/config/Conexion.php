<?php


class Conexion
{

    private $host = "localhost";
    private $dbname = "bd_sistema_citas";
    private $user = "root";
    private $password = "";

    public function Conectar()
    {
        try {
            $conexion = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->user,
                $this->password
            );

            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conexion;
        } catch (PDOException $th) {
            die($th->getMessage());
        }
    }
}
