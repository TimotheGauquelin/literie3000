<?php

$dsn = "mysql:host=localhost;dbname=literie";
$db = new PDO($dsn, "root", "");

$nom = $_GET['nomLit'];
var_dump($nom);
$query = $db->prepare("DELETE FROM lit WHERE nom = :nom");
$query->bindParam(":nom", $_GET['nomLit']);
$query->execute();

header("Location:index.php");
