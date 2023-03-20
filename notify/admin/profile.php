<?php ob_start(); error_reporting(0);


require "config.php";
require "secure.php";
require "title.php";

extract($_GET);

extract($_POST);
$date = date('Y-m-d');




if(isset($_POST) && $_POST['Submit'] == 'Save') {



	$sth = $db->query("UPDATE `profile` SET `name`='$name',`email`='$email',`mobile`='$mobile',`date`='$date' WHERE `guid` = '".$_SESSION['subadmin']."' ");

	

		if($sth > 0) {  ?>
	
	 <script type="text/javascript">
  			  alert('Sub Admin details updated');
  			  window.location="profile.php";
  			</script>
	
	<?php

	} 
	 else { ?>
	
  	        <script type="text/javascript">
  			alert('Please try Again');
  			window.location="profile.php";
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
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="sub_home.php">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		
	<form role="form" method="POST" enctype="multipart/form-data" id="form">
        <div class="card card-default">
		
          <!-- left column -->
           <?php 
          
           $sth = $db->prepare("SELECT * FROM `sub_admins` WHERE `guid` = '".$_SESSION['subadmin']."' ");

			      $sth-> execute();

				  $row = $sth-> fetch(); ?>
		  
         <div class="card-body">
		 <div class="row">
		 
		 
	   
     
     
       <div class="form-group col-md-4">
             <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name" value="<?php echo $row['name'];?>" required>
        </div>
                  <div class="form-group col-md-4">
                    <label for="exampleInputEmail1">Email Address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="<?php echo $row['email'];?>" required>
                  </div>
            <div class="form-group col-md-4">
                  <label for="profile">Mobile Number</label>
                  <input type="text" class="form-control" required id="mobile" name="mobile" placeholder="Enter mobile number" onkeypress="return isNumber();" minlength="10" maxlength="10" name="mobile" value="<?php echo $row['mobile'];?>" >
                </div>
                
           
                  
           
               <div class="clearfix"></div>
                <!-- /.card-body -->


               
		  </div>
		  </div>
		   <div class="card-footer">
                  <button type="submit" name="Submit" value="Save" class="btn btn-primary">Submit</button>
                </div>
		   </div>
		   </form>
		   


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
</script>
<script type="text/javascript">
  


function delete1()

{

  if(window.confirm("Confirm delete?"))

  {

  return true;

   }

 else

   return false;

}

function isNumber(evt) 
{
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) 
  {
       
    //document.getElementById('mobile').focus();
    return false;
    }
    return true;
}
</script>

</body>
</html>
