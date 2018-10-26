<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=Consultation Job Traking KKBera;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
