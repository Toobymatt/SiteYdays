<?php

$titre = "";

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=projetphp;charset=utf8', 'projetphp', 'afd08c189c8abf33e798fd1e8a96d6e1709c4f6521d5f352');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
$admin = 1;
$keys = '$2a$07$usesomesillystringforsalt$';