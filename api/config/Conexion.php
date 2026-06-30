<?php
class Conexion
{
    private $host = "zephyr.proxy.rlwy.net";
    private $port = "13809";
    private $dbname = "db_sistema_citas";
    private $user = "root";
    private $password = "WbRNpaUVwBWsTdOsCLqIOunVFpRtPaHV";

    public function Conectar()
    {
        try {
            $conexion = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}",
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