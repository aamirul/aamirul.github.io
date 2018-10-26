<?php

// Connexion à la base de données
require('dbconn.php');
require('bdd.php');
include("session.php");

if (isset($_POST['nama']) && isset($_POST['namaTetamu']) && isset($_POST['tarikh']) && isset($_POST['masa']) && isset($_POST['perkara'])){
	
	$nama = $_POST['nama'];
    $namaTetamu = $_POST['namaTetamu'];
	$tarikh = $_POST['tarikh'];
	$masa = $_POST['masa'];
	$perkara = $_POST['perkara'];
    $status = 'New';
    $comment = 'There no comment yet!!';
    $seenAR = 'u';
    $seenMA = 'u';
    
    $data = mysqli_query($conn,"SELECT * FROM events");
    while($row = mysqli_fetch_assoc($data)){
    
    $id = $row["id"];
    $session = $row["session"];
	$title = $row["title"];
	$color = $row["color"];
    $start = $row["start"];
	$end = $row["end"];
        
    }
    
    if($namaTetamu == $_SESSION["username"]){
        
        echo "<script type='text/javascript'>alert('you cannot make an appointment with yourself!')</script>";
    
    }
    else{
    
        	$query = "INSERT into `temujanji` (nama, namaTetamu, tarikh, masa, perkara, status, comment, seenAR, seenMA) VALUES ('$nama', '$namaTetamu', '$tarikh', '$masa', '$perkara', '$status', '$comment', '$seenAR', '$seenMA')";
    
            $result = mysqli_query($conn,$query);
    
            if($result){
            header("Location: MyAppointment.php");
            }
    }
}


	
?>
