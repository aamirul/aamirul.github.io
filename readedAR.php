<?php
include("session.php");
require_once('bdd.php');
require('dbconn.php');

$seen = $_GET['seenAR'];

$sql = "UPDATE temujanji SET seenAR='s' WHERE seenAR = 'u' AND namaTetamu = '$_SESSION[username]'";

if ($conn->query($sql) === TRUE) {
    echo "New record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>