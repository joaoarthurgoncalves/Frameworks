<?php
include "criaClasses.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);
try{
    $server=$_POST["servidor"];
    $banco=$_POST["banco"];
    $usuario=$_POST["usuario"];
    $senha=$_POST["senha"];
    $conn= new PDO("mysql:host=".$server.";dbname=$banco","$usuario","$senha");
    criaClasses::criar($conn,$banco, $usuario, $senha);
    header("Location:frameworkMVC.php?msg=0");
 }catch(PDOException $e){
	echo "erro".$e->getMessage();
    header("Location:frameworkMVC.php?msg=1");
}
?>
