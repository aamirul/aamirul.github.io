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
    <div class="container">
    <?php
include("session.php");
require('dbconn.php');
if(isset($_GET['id'])){
$idURL = $_GET['id'];

$query = "SELECT * FROM temujanji WHERE id = '$idURL'";
$result = mysqli_query($conn,$query) or die("Could not execute query in ubah.php");
$row = mysqli_fetch_assoc($result);

$namaTetamu = $row ['namaTetamu'];
$tarikh = $row['tarikh'];
$masa = $row['masa'];
$perkara= $row['perkara'];
$status = $row["status"];

?>
        <body style="background-image: url(blue-blur-background.jpg)">
        <form action="updated.php" method="POST">
            <table border="0">
                <tr>
                    <td class="td">Your Name</td>
                    <td><input type="text" name="nama" value="<?php echo $_SESSION["username"]?>" class="form-control" readonly></td>
                </tr>
                <tr>
                    <td><br>Name</td>
                    <td><br>
                        <select class="form-control" name="namaTetamu" style="width:350px" required>
                            <option value="<?php echo $namaTetamu?>"><?php echo $namaTetamu?></option>
                            <option value="admin">Admin</option>
                            <option value="amirul">Amirul</option>
                            <option value=""></option>
                            <option value=""></option>
                            <option value=""></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><br>Date</td>
                    <td><br><input type="date" name="tarikh" class="form-control" value="<?php echo $tarikh?>"></td>
                </tr>
                <tr>
                    <td><br>Time</td>
                    <td><br><input type="time" name="masa" class="form-control" value="<?php echo $masa?>"></td>
                </tr>
                <tr>
                    <td><br>Status</td>
                    <td><br>
                        <select class="form-control" name="status" style="width:350px" required>
                            <option value="<?php echo $status?>"><?php echo $status?></option>
                            <option value="Done">Done</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Need to be referred again">Need to be referred again</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><br>Reason</td>
                    <td><br><textarea name="perkara" class="form-control" style="width:350px"><?php echo $perkara?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">
                        <input class="button" type="hidden" name="id" value="<?php echo $idURL; ?>">
                        <br><input type="submit" value="Save" name="simpan" class="btn btn-primary"> <input type="reset" value="Reset" class="btn btn-default"> 
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center"><br><a href="main3page.php"><input type="button" value="Cancel" class="btn btn-default"></a></td>
                </tr>
            </table>
        </form>
            </body>
        </div>
        <?php }?>
        
</html>