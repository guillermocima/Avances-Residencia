
<?php
include_once("Conexion.php");
class Funciones extends Conexion{
	private $pdo;
    
	public function __construct(){
		$this->pdo = new Conexion();
	}
    
    public function obtenerIdUsuario($hash){
        $sql = $this->pdo->query("SELECT id FROM dash_usuarios WHERE hashUser = '".$hash."' LIMIT 1");
        $existe = $sql->rowCount();

        if($existe > 0){
            $info = $sql->fetch();
            return $info["id"];
        }
        else{
            return 0;
        }
    }

    public function obtenerUsuariosNormales(){
        $sql = $this->pdo->query("SELECT * FROM dash_usuarios WHERE tipo = 2");
        return $sql;
    }
}
?>

