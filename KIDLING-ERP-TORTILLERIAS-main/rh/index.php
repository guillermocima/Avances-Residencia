<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
    header("Location: ../login.html?error=" . urlencode("Acceso no autorizado"));
    exit();
}
?>
<!DOCTYPE html>