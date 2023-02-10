<?php
session_start();
$cbdd = new PDO('mysql:host=192.168.64.140;dbname=td_BDD', 'root', 'root');
$cbdd->exec('INSERT INTO client (nom, prenom) VALUES("'.$_POST['nom'].'", "'.$_POST['prenom'].'")');
header('location: index.php');
?> 