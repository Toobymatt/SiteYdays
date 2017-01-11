<?php

$titre = "";

try
{
	$bdd = new PDO('mysql:host=51.254.142.19;dbname=Ydays;charset=utf8', 'Ydays', 'ydays1617');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
$admin = 1;
$keys = '$2a$07$usesomesillystringforsalt$';