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
<link href="popup.css" rel="stylesheet">
<link href="css/dropdown.css" rel="stylesheet">
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Consultation & Job Traking @KKBera/Content View/My Appointment</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
        body{
            text-align: center;
            background-image: url(blue-blur-background.jpg);
            background-size:     cover;                      
            background-repeat:   no-repeat;
            background-position: center center;  
        }
        table{
            margin: 10px;
            width: 480px;
            border-collapse: separate;
            border-spacing: 8px;
        }
        .td{
            width: 200px;
        }
        .form{
            border-radius: 10px;
            margin: 50px;
            text-align: center;
            display: inline-block;
            background-color: white;
            width: 500px;
            border: 1px solid;
            border-color: white;
            padding: 10px;
            box-shadow: 5px 5px 5px #888888;
        }
        .form2{
            text-align: center;
            width: 25%;
            margin-left: 422px;
        }
    </style>
	
    <body>
    <div class="topnav">
            <a href="Calendar.php">Calendar</a>   
            <a href="MakeAnAppointment.php">Make an appointment</a>
            <div class="dropdown">
                <a onclick="myFunction()" class="dropbtn active">Content View <span class="badge"><?php if($countall>0) { echo $countall; }  ?></span></a>
            <div id="myDropdown" class="dropdown-content">
                <a href="MyAppointment.php" onclick="readMA('s')" class="active">My Appointment <span class="badge"><?php if($count1>0) { echo $count1; }  ?></span></a>
                <a href="AppointmentRequest.php" onclick="readAR('s')">Appointment Request <span class="badge"><?php if($count>0) { echo $count; } ?></span></a>
            </div>
            </div>
            <a href="logout.php">logout</a>
            </div>
           
        <div class="container">
            <h1>My Appointment</h1>
<br><form action="main3page.php" method="post" class="form2">
    <input type="search" name="search" placeholder="Type name to search" class="form-control" required>
    <input type="submit" value="Search" class="btn btn-default">
</form>
<?php
        if(isset($_POST['search']))
    {
        $searchkey = $_POST['search'];
        $searchkey = preg_replace("#[^0-9a-z]#i","",$searchkey);
        
        $query = mysqli_query($conn,"SELECT * FROM temujanji WHERE nama LIKE '%$searchkey%' AND nama = '$_SESSION[username]'") or die("Could not search!");
        $count = mysqli_num_rows($query);
        
     if($count == 0){
        $output="There was no search result!";
    }
     }
    else{
            $query = mysqli_query($conn,"SELECT * FROM temujanji WHERE nama = '$_SESSION[username]' ORDER BY tarikh DESC");
    }

while($row = mysqli_fetch_assoc($query)){
    
    $id = $row["id"];
    $nama = $row["nama"];
	$namaTetamu = $row["namaTetamu"];
	$tarikh = $row["tarikh"];
    $masa = $row["masa"];
	$perkara = $row["perkara"];
    $status = $row["status"];
    $comment = $row["comment"];
?>
<form class="form" action="main3page.php" method="post">
    <table border="0">
        <tr>
            <td class="td"><br>Your Nama</td>
            <td><br><?php echo $nama?></td>
        </tr>
        <tr>
            <td class="td"><br>Nama</td>
            <td><br><?php echo $namaTetamu?></td>
        </tr>
        <tr>
            <td class="td"><br>Appointment Date</td>
            <td><br><?php echo $tarikh?></td>
        </tr>
        <tr>
            <td class="td"><br>Appointment Time</td>
            <td><br><?php echo $masa?></td>
        </tr>
        <tr>
            <td class="td"><br>Appointment Status</td>
            <td><br><?php echo $status?></td>
        </tr>
        <tr>
            <td class="td"><br>Reason</td>
            <td><br><?php echo wordwrap($perkara,1000,"\n",TRUE)?></td>
        </tr>
        <tr>
            <td class="td"><br>Response</td>
            <td><br><?php echo $comment; ?></td>
        </tr>
        <tr>
            <td style="text-align:right"><a href="delete.php?id=<?php echo $id; ?>"><input type="button" class="btn btn-default" style="background-color:red; color:white" value="Delete"></a></td>
            <td><a href="update.php?id=<?php echo $id?>"><input id="input" type="button" class="btn btn-default" value="Update"></a></td>
        </tr>
    </table>
</form>
    <?php } ?>
            </div>
        

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="js/dropdown.js"></script>
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
    </body>
</html>

