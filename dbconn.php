<?php

define("DATABASE_HOST", "localhost");
define("DATABASE_USER", "root");

$conn = mysqli_connect(DATABASE_HOST, DATABASE_USER);

// If connection failed then display mysql error
if (mysqli_connect_error())
	{
	echo "Failed to connect to MySql: " .mysqli_connect_error();
	}

// To select one particular database to be used
mysqli_select_db($conn,"Consultation Job Traking KKBera") or die("Could not open products database");

//set the default time zone to use in Malaysia
date_default_timezone_set('Asia/Kuala_Lumpur');
?>