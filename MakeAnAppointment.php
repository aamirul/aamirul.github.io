<?php
include("session.php");
require_once('bdd.php');
require('dbconn.php');

	$get_noti_qwr = "select * from temujanji where seenAR = 'u' AND namaTetamu = '$_SESSION[username]'";

	$qry = mysqli_query($conn,$get_noti_qwr);
	$count=mysqli_num_rows($qry);

    $get_noti_qwr1 = "select * from temujanji where seenMA = 'u' AND comment != 'There no comment yet!!' AND nama = '$_SESSION[username]'";

	$qry1 = mysqli_query($conn,$get_noti_qwr1);
	$count1=mysqli_num_rows($qry1);

    $countall = $count + $count1;

?>

<html>
<link href="css/nav.css" rel="stylesheet">
<link href="css/dropdown.css" rel="stylesheet">
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Consultation & Job Traking @KKBera/Make an appointment</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />
<style>
    table{
            width: auto;
            margin-left: auto;
            margin-right: auto;
            margin-top: 150px;
        }
    input[type="text"],
    input[type="date"],
    input[type="time"]{
        width: 350px;
    }
    .td{
        width: 100px;
    }
</style>
    <body style="background-image: url(blue-blur-background.jpg)">
    <div class="topnav">
            <a href="Calendar.php">Calendar</a>   
            <a href="MakeAnAppointment.php" class="active">Make an appointment</a>
            <div class="dropdown">
                <a onclick="myFunction()" class="dropbtn">Content View <span class="badge"><?php if($countall>0) { echo $countall; }  ?></span></a>
            <div id="myDropdown" class="dropdown-content">
                <a href="MyAppointment.php" onclick="readMA('s')">My Appointment <span class="badge"><?php if($count1>0) { echo $count1; }  ?></span></a>
                <a href="AppointmentRequest.php" onclick="readAR('s')">Appointment Request <span class="badge"><?php if($count>0) { echo $count; } ?></span></a>
            </div>
            </div>
            <a href="logout.php">logout</a>
            </div>
        
        <div class="container">
        <form action="addAppointment.php" method="POST">
            <table border="0">
                <tr>
                    <td class="td">Your Name</td>
                    <td>
                        <input type="text" name="nama" value="<?php echo $_SESSION["username"]?>" class="form-control" readonly>
                    </td>
                </tr>
                <tr>
                    <td><br>Name</td>
                    <td><br>
                        <select class="form-control" name="namaTetamu" style="width:350px" required>
                            <option value=""></option>
                            <option value="admin">Admin</option>
                            <option value="amirul">Amirul</option>
                            <option value="liza">Liza</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><br>Appointment Date</td>
                    <td><br><input type="date" name="tarikh" class="form-control"></td>
                </tr>
                <tr>
                    <td><br>Appointment Time</td>
                    <td><br><input type="time" name="masa" class="form-control"></td>
                </tr>
                <tr>
                    <td><br>Reason</td>
                    <td><br><textarea name="perkara" class="form-control" style="width:350px"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td><br><input type="reset" value="Reset" class="btn btn-default"> <input type="submit" value="Save" name="simpan" class="btn btn-primary"></td>
                </tr>
            </table>
        </form>
        </div>
        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            function readAR($seenAR){
                    $.ajax({
            //the url to send the data to
            url: "readedAR.php",
            //the data to send to
            data: {seenAR: $seenAR},
            //type. for eg: GET, POST
            type: "POST",
            //on success
            success: function(data){
                console.log("***********Success***************"); //You can remove here
                console.log(data); //You can remove here
            },
            //on error
            error: function(){
                    console.log("***********Error***************"); //You can remove here
                    console.log(data); //You can remove here
            }
        });
            
        }
                function readMA($seenMA){
                    $.ajax({
            //the url to send the data to
            url: "readedMA.php",
            //the data to send to
            data: {seenMA: $seenMA},
            //type. for eg: GET, POST
            type: "POST",
            //on success
            success: function(data){
                console.log("***********Success***************"); //You can remove here
                console.log(data); //You can remove here
            },
            //on error
            error: function(){
                    console.log("***********Error***************"); //You can remove here
                    console.log(data); //You can remove here
            }
        });
            
        }
</script>
<script src="js/dropdown.js"></script>

    </body>
</html>