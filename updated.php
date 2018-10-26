<!-- kemaskini.php -->
<!-- To update data of ubah.php into database. -->
<?php
require('dbconn.php');
require('bdd.php');
include("session.php");

    $data = mysqli_query($conn,"SELECT * FROM events");
    while($row = mysqli_fetch_assoc($data)){
    
    $id = $row["id"];
    $session = $row["session"];
	$title = $row["title"];
	$color = $row["color"];
    $start = $row["start"];
	$end = $row["end"];
        
    } 

extract ($_POST);   

if($namaTetamu == $_SESSION["username"])
    {
         echo "<script type='text/javascript'>alert('you cannot make an appointment with yourself!')</script>";
    }

else if(($tarikh == $start)&&($namaTetamu == $session))
    {
        echo "<script type='text/javascript'>alert('This person is busy that day')</script>";
    }
else
    {
        $query = "UPDATE temujanji SET namaTetamu='$namaTetamu',tarikh='$tarikh',masa='$masa',perkara='$perkara',status='$status' WHERE id = '$id'";

        $result = mysqli_query($conn,$query) or die ("Could not execute changes");
        if ($result){
            echo "<script type = 'text/javascript'> window.location='MyAppointment.php' </script>";
        }
    }
?>