<?php
include_once("Conexion.php");
class Usuario{
	private $pdo;
    public $nombre;
    public $apellidos;
    public $email;
    public $password;
    public $fechaRegistro;
    
	public function __construct($idUsuario){
		$this->pdo = new Conexion();
		$this->idUsuario = $idUsuario;

		$sql = $this->pdo->query("SELECT * FROM dash_usuarios WHERE id = ".$this->idUsuario." LIMIT 1");
		$datos = $sql->fetch();

		$this->nombre = $datos["nombre"];
		$this->apellidos = $datos["apellidos"];
		$this->email = $datos["email"];
		$this->password = $datos["password"];
		$this->fechaRegistro = $datos["fechaRegistro"];
		$this->tipo = $datos["tipo"];
	}

}
?>