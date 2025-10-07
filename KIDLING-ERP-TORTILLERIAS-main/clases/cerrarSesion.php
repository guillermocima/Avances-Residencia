<?php
$nombre_sesion = "inventario";
session_name($nombre_sesion);
session_start();
session_destroy();
unset($_SESSION['usuario_login']);
unset($_SESSION['usuario_password']);
unset($_SESSION['usuario_id']);
setcookie("cDash", "system", time()-100,"/");
setcookie("cDashExpiration", "system", time()-100,"/");
Header ("Location: ../login.html");
exit;
?>