<?php
include("session.php");
require_once('bdd.php');
require('dbconn.php');


$sql = "SELECT id, session, title, start, end, color FROM events ";

$req = $bdd->prepare($sql);
$req->execute();

$events = $req->fetchAll();

	$get_noti_qwr = "select * from temujanji where seenAR = 'u' AND namaTetamu = '$_SESSION[username]'";

	$qry = mysqli_query($conn,$get_noti_qwr);
	$count=mysqli_num_rows($qry);

    $get_noti_qwr1 = "select * from temujanji where seenMA = 'u' AND comment != 'There no comment yet!!' AND nama = '$_SESSION[username]'";

	$qry1 = mysqli_query($conn,$get_noti_qwr1);
	$count1=mysqli_num_rows($qry1);

    $countall = $count + $count1;
?>
<!DOCTYPE html>
<html>
<link href="CSS/nav.css" rel="stylesheet">
<link href="css/dropdown.css" rel="stylesheet">

     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Consultation & Job Traking @KKBera</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- FullCalendar -->
	<link href='css/fullcalendar.css' rel='stylesheet' />

<body style="background-image:url(blue-blur-background.jpg);">
    <div class="topnav">
            <a href="Calendar.php" class="active">Calendar</a>   
            <a href="MakeAnAppointment.php">Make an appointment</a>
            <div class="dropdown">
                <a onclick="myFunction()" class="dropbtn">Content View <span class="badge"><?php if($countall>0) { echo $countall; }  ?></span></a>
            <div id="myDropdown" class="dropdown-content">
                <a href="MyAppointment.php" onclick="readMA('s')">My Appointment <span class="badge"><?php if($count1>0) { echo $count1; }  ?></span></a>
                <a href="AppointmentRequest.php" onclick="readAR('s')">Appointment Request <span class="badge"><?php if($count>0) { echo $count; } ?></span></a>
            </div>
            </div>
            <a href="logout.php">logout</a>
    </div>
    
     <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12 text-center">
                <h1>Welcome <?php echo $_SESSION["username"];?>!</h1>
                <div id="calendar" class="col-centered" 
                     style="
                            border-radius: 4px;
                            margin: 50px;
                            text-align: center;
                            display: inline-block;
                            background-color: white;
                            border: 1px solid;
                            border-color: white;
                            box-shadow: 5px 5px 5px #888888;">
                </div>
            </div>
			
        </div>
        <!-- /.row -->
		
		<!-- Modal -->
		<div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="addEvent.php">
			
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Event</h4>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                      <input type="text" name="session" value="<?php echo $_SESSION["username"]?>" hidden>
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Color</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
						  <option value="">Choose</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
						  <option style="color:#008000;" value="#008000">&#9724; Green</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
						  <option style="color:#000;" value="#000">&#9724; Black</option>
						  
						</select>
					</div>
				  </div>
				  <div class="form-group">
					<label for="start" class="col-sm-2 control-label">Start date</label>
					<div class="col-sm-10">
					  <input type="text" name="start" class="form-control" id="start" readonly>
					</div>
				  </div>
				  <div class="form-group">
					<label for="end" class="col-sm-2 control-label">End date</label>
					<div class="col-sm-10">
					  <input type="text" name="end" class="form-control" id="end" readonly>
					</div>
				  </div>
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>
		
		
		
		<!-- Modal -->
		<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<form class="form-horizontal" method="POST" action="editEventTitle.php">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Event</h4>
			  </div>
			  <div class="modal-body">
				
				  <div class="form-group">
					<label for="title" class="col-sm-2 control-label">Title</label>
					<div class="col-sm-10">
					  <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                        <input type="text" name="session" value="<?php echo $_SESSION["username"]?>" hidden>
					</div>
				  </div>
				  <div class="form-group">
					<label for="color" class="col-sm-2 control-label">Color</label>
					<div class="col-sm-10">
					  <select name="color" class="form-control" id="color">
						  <option value="">Choose</option>
						  <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
						  <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
						  <option style="color:#008000;" value="#008000">&#9724; Green</option>						  
						  <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
						  <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
						  <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
						  <option style="color:#000;" value="#000">&#9724; Black</option>
						  
						</select>
					</div>
				  </div>
				    <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <div class="checkbox">
							<label class="text-danger"><input type="checkbox"  name="delete"> Delete event</label>
						  </div>
						</div>
					</div>
				  
				  <input type="hidden" name="id" class="form-control" id="id">
				
				
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			  </div>
			</form>
			</div>
		  </div>
		</div>

    </div>    
    <!-- /.container -->
    <script src="js/dropdown.js"></script>
    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- FullCalendar -->
	<script src='js/moment.min.js'></script>
	<script src='js/fullcalendar.min.js'></script>
	
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
		
		$(document).ready(function() {
     var date = new Date()
     var d    = date.getDate(),
         m    = date.getMonth(),
         y    = date.getFullYear()
    
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      defaultDate: new Date(y, m, d),
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			selectable: true,
			selectHelper: true,
			select: function(start, end) {
				
				$('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
				$('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
				$('#ModalAdd').modal('show');
			},
			eventRender: function(event, element) {
				element.bind('dblclick', function() {
					$('#ModalEdit #id').val(event.id);
					$('#ModalEdit #title').val(event.title);
					$('#ModalEdit #color').val(event.color);
					$('#ModalEdit').modal('show');
				});
			},
			eventDrop: function(event, delta, revertFunc) { // si changement de position

				edit(event);

			},
			eventResize: function(event,dayDelta,minuteDelta,revertFunc) { // si changement de longueur

				edit(event);

			},
			events: [
			<?php foreach($events as $event):
                             
                if($event['session'] == $_SESSION["username"]){
			
				/*$start = explode(" ", $event['start']);
				$end = explode(" ", $event['end']);
				if($start[1] == '00:00:00'){
					$start = $start[0];
				}else{
					$start = $event['start'];
				}
				if($end[1] == '00:00:00'){
					$end = $end[0];
				}else{
					$end = $event['end'];
				}*/
			?>
				{
					id: '<?php echo $event['id']; ?>',
					title: '<?php echo $event['title']; ?>',
					start: '<?php echo $event['start']; ?>',
					end: '<?php echo $event['end']; ?>',
					color: '<?php echo $event['color']; ?>',
				},
			<?php } endforeach;?>
			]
		});
		
		function edit(event){
			start = event.start.format('YYYY-MM-DD HH:mm:ss');
			if(event.end){
				end = event.end.format('YYYY-MM-DD HH:mm:ss');
			}else{
				end = start;
			}
			
			id =  event.id;
			
			Event = [];
			Event[0] = id;
			Event[1] = start;
			Event[2] = end;
			
			$.ajax({
			 url: 'editEventDate.php',
			 type: "POST",
			 data: {Event:Event},
			 success: function(rep) {
					if(rep == 'OK'){
						alert('Saved');
					}else{
						alert('Could not be saved. try again.'); 
					}
				}
			});
		}
		
	});


</script>

</body>

</html>