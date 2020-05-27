<?php
require_once("initBD.php"); //iniciando conexão com base de dados

extract($_POST);
$password = md5($password);
$sql = "INSERT INTO user (id, name, email, password, description, likes, role, timestamp) VALUES (NULL, '$name', '$email', '$password', '$description', NULL, '1', CURRENT_TIMESTAMP);";

$message = "";

try {
    $dbConn->beginTransaction();
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $dbConn->commit();
    $message = "ok";
} catch (Exception $e) {
    //Roll back and show error
    $sql .=  "Error: " . $e->getMessage();
    $dbConn->rollBack();
    $message = "error";
}
header("Location:cadastro.php?msg=$message");