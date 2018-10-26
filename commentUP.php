<?php

// Connexion à la base de données
require('dbconn.php');
require('bdd.php');
include("session.php");

if (isset($_POST['comment'])&& isset($_POST['id'])&& isset($_POST['u'])){
	
	$comment = $_POST['comment'];
    $id = $_POST['id'];
    $u = $_POST['u'];
    
    
        	$query = "update temujanji SET comment='$comment', seenMA='$u' WHERE id = $id ";
    
            $result = mysqli_query($conn,$query);
    
            if($result){
            header("Location: AppointmentRequest.php");
            }
    
}


	
?>
