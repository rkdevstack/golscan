<?php ob_start(); error_reporting(0);


require "config.php";
require "secure.php";
require "title.php";

extract($_GET);

extract($_POST);
$date = date('Y-m-d');
$datetime = date('Y-m-d h:i:s');

define( 'API_ACCESS_KEY', 'AAAAVVzX-7Q:APA91bE-TFFSKkJOOhbg9ce3dg6x9TgW8TvxThSwpKvKoB5rH1ZefZhVECaN23gw-eonUIO1hBrmnFr3vINwYOtJh5tVZNPBn4n-Mnu6RkJFd4AU-mdt5A9t2SLlFHgJ20XPPuXqmBSF' );


if(isset($_POST) && $_POST['Submit'] == 'Add') {

//echo "INSERT INTO `push` (`title`,`message`,`date`) VALUES ('$title','$message','$datetime')";exit;
  
$sth = $db->query("INSERT INTO `push` (`title`,`message`,`date`) VALUES ('$title','$message','$datetime')");
			
$ins=$db->lastInsertId();
			//print_r($area);exit;
	

if($sth > 0) { 

$sql = $db->query("SELECT * FROM `register`  where approval_status = 'Approved' ");
while($row = $sql->fetch()){
  
$postad = $db->query("INSERT INTO customer_notif(`transid`,`userid`,`message`,`date`,`datetime`,`status`) VALUES ('$ins','".$row['guid']."','$message','$date','$datetime','0')");
  
$singleID = $row['regid']; 
    $fcmMsg = array(
    	'body' => $message,
    	'title' => $title,
    	'sound' => "default",
        'color' => "#203E78" 
    );
    $fcmFields = array(
    	'to' => $singleID,
        'priority' => 'high',
    	'notification' => $fcmMsg
    );
    $headers = array(
    	'Authorization: key=' . API_ACCESS_KEY,
    	'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
    $result = curl_exec($ch );
    //curl_close( $ch );	
}
	?>
	
	 <script type="text/javascript">
  			  alert('Message Successfully Sent');
  			  window.location="push.php";
  			</script>
	
	<?php

	} else { ?>
	
  	        <script type="text/javascript">
  			alert('Please try Again');
  			window.location="push.php";
  			</script>
			
  	<?php 
	
	} 
	
}



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title><?php echo TITLE;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include "header.php";?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include "side_nav.php";?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 586px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Notifications</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Notifications</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		
	 <?php if($action == 'deleteData') {

    $guid = $_GET['guid'];

    $sth = $db->query ("DELETE FROM `push` WHERE `guid`='$guid'");

    //$sth->execute();

    header('location:push.php'); 

  } else { ?>  
      <div class="row">
        <div class="col-12">
         <?php $sth = $db->query ("SELECT * FROM `push` order by guid DESC");
			   $count = $sth->rowCount(); ?>

          <div class="card">
            <div class="card-header">
              <!--h3 class="card-title">DataTable with default features</h3-->
            </div>
		<div class="col-3"><a href="#"  data-toggle="modal" data-target="#modal-add" class="btn btn-info" >Send</a>
        <p><?php echo $_GET[post_msg];?></p></div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				          <th>S.no</th>
				          <th>Title</th>
                          <th>Message</th>
                          <th>Date</th>
				          <th>Delete</th>
                </tr>
                </thead>
                <tbody>
               <?php if($count > 0) { 

						$m = 1;
						while($row = $sth->fetch()){ ?>
                <tr>
                  <td><?php echo $m; ?></td>
				
                  <td><?php echo $row['title']; ?></td>
				  <td><?php echo $row['message']; ?></td>
				  <td><?php echo date('d-m-Y',strtotime($row['date'])); ?></td>
                  <td><div class="btn-group btn-group-sm"> <?php if($_SESSION['loginRole']=='superadmin'){ ?><a href="push.php?action=deleteData&guid=<?php echo $row[0]; ?>" class="btn btn-danger" onClick="return delete1();"><i class="fa fa-trash icon-only"></i></a><?php } ?></div></td>
                </tr>


                <?php $m++; } }else{ echo '<tr><td>No Data Found</td></tr>';}  ?>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
	<?php } ?>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include "footer.php"; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

 <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data" id="form">
            <div class="modal-header">
              <h4 class="modal-title">Send notification</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                
             <div class="form-group">
                  <label for="merchants">Title</label>
                  <input type="text" class="form-control" required id="title" name="title" placeholder="Title">
                </div>
                
                <div class="form-group">
                  <label for="merchants">Message</label>
                  <input type="text" class="form-control" required id="message" name="message" placeholder="Message">
                </div>
                
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="Submit" value="Add" class="btn btn-primary">Send</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
  
  function delete1()

{

  if(window.confirm("Confirm delete"))

  {

  return true;

   }

 else

   return false;

}
</script>
</body>
</html>
