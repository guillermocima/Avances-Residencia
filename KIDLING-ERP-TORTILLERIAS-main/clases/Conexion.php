<?php
// Archivo: clases/Conexion.php

class Conexion {
    private $host = "localhost";
    private $dbname = "bd_tortilleria"; // Corregido sin la 's'
    private $user = "root";
    private $password = "";
    private $charset = "utf8mb4";
    private $pdo;

    public function conectar() {
        // Si ya existe una conexión, la retornamos para no crear múltiples.
        if ($this->pdo != null) {
            return $this->pdo;
        }

        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=" . $this->charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
            $this->pdo->exec("SET time_zone = '-05:00'");
            return $this->pdo;

        } catch (PDOException $e) {
            // En un entorno de producción, nunca muestres el error detallado.
            // Regístralo en un archivo de logs.
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
?>