<?php
include("session.php");
require_once('bdd.php');
require('dbconn.php');

$seen = $_GET['seenMA'];

$sql = "UPDATE temujanji SET seenMA='s' WHERE seenMA = 'u' AND comment != 'There no comment yet!!' AND nama = '$_SESSION[username]'";

if ($conn->query($sql) === TRUE) {
    echo "New record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>