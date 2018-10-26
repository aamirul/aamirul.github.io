<?php
require('dbconn.php');
session_start();
if(isset($_SESSION['username'])){
    header('location:mainPage.php');
}
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($conn,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `userdata` WHERE username='".$username."'
and password='".$password."'";
	$result = mysqli_query($conn,$query) or die(mysqli_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
            // Redirect user to index.php
	    header("Location: Calendar.php");
         }else{
	echo("Your Login Name or Password is invalid Click here to <a href='login.php'>Login</a>");
	}
    }else{
?>

<html>
 <link href="nav.css" rel="stylesheet">
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Consultation & Job Traking @KKBera</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    header{
        text-align: center;
    }
    footer{
        margin-top: 50%;
        text-align: center;
        font-size: 20px;
        color: white;
    }
    table{
        width: 50%;
        margin-left: auto;
        margin-right: auto;
        margin-top: auto;
    }
    label{
        font-size: 25px;
    }
    .td{
         text-align: center;
    }
</style>
<div class="container">   
<header>
    <br><h1>Consultation & Job Traking @KKBera</h1>
</header>
    
<body style="background-image: url(blue-blur-background.jpg)">
    
    <form method = "post" action="">
    <table border="0" align="center">
        <tr>
            <td colspan="4" style="text-align:center"><img src="KK%20bera.png" width="300px" height="200px"></td>
        </tr>
        <tr>
            <td></td>
            <td><input class="form-control" type="text" name="username" placeholder="Username" required></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td><br><input class="form-control" type="password" name="password" placeholder="Password" required></td>
            <td></td>
        </tr>
        <tr>         
            <td colspan="3" class="td"><br><input type="reset" name="clear" value="Clear" class="btn btn-default"> <input type="submit" name="submit" value="Login" class="btn btn-primary"></td>
        </tr>
    </table>
    </form>
</body>
    <footer>&copy; Copyright 2018. Kolej Komuniti Bera</footer>
</div> 
</html>
<?php } ?>