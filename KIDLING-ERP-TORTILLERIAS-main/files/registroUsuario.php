<?php
include("../clases/Conexion.php");

$db = new Conexion();

//obtener las variables de la funcion js
$nombre = htmlentities($_POST['nombre'],ENT_NOQUOTES,"UTF-8");
$apellidos = htmlentities($_POST['apellidos'],ENT_NOQUOTES,"UTF-8");
$email = $_POST['email'];
// aqui encripta la contraseña
$password1 = hash("sha256", $_POST['password1']);
$fechaRegistro = date("Y-m-d");

//indicar que se usaran transacciones
$db->beginTransaction();

//verificar que el correo no exista en la BD
$sql = $db->prepare("SELECT email FROM dash_usuarios WHERE email = :email LIMIT 1");
$sql->bindParam(':email', $email, PDO::PARAM_STR);
$sql->execute();

if($sql && $sql->rowCount() == 0){

    //crear una clave
    $hashUser = time();
    $hashUser = md5($hashUser);
    $hashUser = substr($hashUser, 1, 25);
    $hashUser = str_pad($hashUser, 25, "0", STR_PAD_RIGHT);

    //preparar la consulta
    $sql = $db->prepare("INSERT INTO dash_usuarios (nombre, apellidos, email, password, hashUser, fechaRegistro) VALUES (:nombre, :apellidos, :email, :password, :hashUser, :fechaRegistro)");
    $sql->bindParam(':nombre', $nombre, PDO::PARAM_STR);
    $sql->bindParam(':apellidos', $apellidos, PDO::PARAM_STR);
    $sql->bindParam(':email', $email, PDO::PARAM_STR);
    $sql->bindParam(':password', $password1, PDO::PARAM_STR);
    $sql->bindParam(':hashUser', $hashUser, PDO::PARAM_STR);
    $sql->bindParam(':fechaRegistro', $fechaRegistro, PDO::PARAM_STR);
    
    $sql->execute();
    
    if($sql){
        $db->commit();
        $jsondata = array("success" => true, 
                        "mensaje" => "registro correcto :3");
    }
    else{
        $db->rollBack();
        $jsondata = array("success" => false, 
                        "mensaje" => "Ocurrió un error al intentar guardar los datos");
    }

}
else{
    $db->rollBack();
        $jsondata = array("success" => false, 
                        "mensaje" => "Este correo electrónico ya está registrado");
}


header('Content-type: application/json; charset=utf-8');
echo json_encode($jsondata);
exit();
?>