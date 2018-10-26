<!-- buang.php -->
<!-- To delete one particular data. -->

<?php 

include ("dbconn.php");

$idURL = $_GET['id'];

$query = "DELETE FROM temujanji WHERE id = '$idURL'";
$result = mysqli_query($conn,$query) or die ("Could not execute query in ubah.php");

if($result){
echo "<script type= 'text/javascript'> window.location='MyAppointment.php'</script>";
}?>