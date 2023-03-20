<?php ob_start(); error_reporting(0);


require "lib/config.php";
require "lib/secure.php";
require "lib/title.php";
require "lib/path.php";

extract($_GET);

extract($_POST);
$date = date('Y-m-d');


if(isset($_POST) && $_POST['Submit'] == 'Add') {

  $r = $db->query ("SELECT * FROM `users` where email = '$email'")->rowCount();
  if($r ==0){
			

$sth = $db->query("INSERT INTO `users` (`name`,`email`,`mobile`, `password`,`status`,`date`) VALUES ('$name','$email','$mobile','$password','Active','$date')");
			
$ins=$db->lastInsertId();


	if($sth > 0) {  ?>
	
	 <script type="text/javascript">
  			  alert('User added successfully');
  			  window.location="users.php";
  			</script>
	
	<?php

	} else { ?>
	
  	        <script type="text/javascript">
  			alert('Please try Again');
  			window.location="users.php";
  			</script>
			
  	<?php 
	
	} 
		}else { ?>
<script type="text/javascript">
  			alert('User already added with email <?php echo $username;?>');
  			window.location="users.php";
  			</script>

	<?php  }
	 
 
	//}
}

if(isset($_POST) && $_POST['Submit'] == 'Save') {

 $r = $db->query ("SELECT * FROM `users` where email = '$email'  and guid!='$guid' ")->rowCount();
  if($r ==0){

	$sth = $db->query("UPDATE `users` SET `name`='$name',`email`='$email',`mobile`='$mobile',`password`='$password',`date`='$date' WHERE `guid`=$guid");

	

		if($sth > 0) {  ?>
	
	 <script type="text/javascript">
  			  alert('User details updated');
  			  window.location="users.php";
  			</script>
	
	<?php

	} 
	 else { ?>
	
  	        <script type="text/javascript">
  			alert('Please try Again');
  			window.location="users.php";
  			</script>
			
  	<?php 
	
	} }else { ?>
<script type="text/javascript">
  			alert('User already added with email <?php echo $username;?>');
  			window.location="users.php";
  			</script>

	<?php  }

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
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		 <?php 	if(isset($_GET['action'])) {

			     $action =  $_GET['action']; 

			} if($action == 'addNew') { ?>
			 
     <a href="users.php" class="btn btn-info" >Back</a> 
        <!-- SELECT2 EXAMPLE -->
		 <form role="form" method="POST" enctype="multipart/form-data" id="form">
        <div class="card card-default">
		
          <!-- left column -->
          
		  
         <div class="card-body">
		 <div class="row">
		 
		 
	   
            
	  
             
             <div class="form-group col-md-3">
             <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name" required>
             </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Email Address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" required>
                  </div>
            <div class="form-group col-md-3">
                  <label for="users">Mobile Number</label>
                  <input type="text" class="form-control" required id="mobile" name="mobile" placeholder="Enter Mobile No" onkeypress="return isNumber();" minlength="10" maxlength="10" name="mobile"  >
                </div>
                
          
                  <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter password" name="password" required>
                  </div>
			
                 

               
		  </div>
		  </div>
		   <div class="card-footer">
                  <button type="submit" name="Submit" value="Add" class="btn btn-primary">Submit</button>
                </div>
		   </div>
		   </form>
		  
	 <?php } else if($action == 'editData') { 

	$guid = $_GET['guid'];  ?>
	<a href="users.php" class="btn btn-info" >Back</a> 
	<form role="form" method="POST" enctype="multipart/form-data" id="form">
        <div class="card card-default">
		
          <!-- left column -->
           <?php $sth = $db->prepare ("SELECT * FROM `users` WHERE `guid` = '$guid'");

			      $sth-> execute();

				  $row = $sth-> fetch(); ?>
		  
         <div class="card-body">
		 <div class="row">
		 
		
           <div class="form-group col-md-3">
             <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter name" name="name" value="<?php echo $row['name'];?>" required>
             </div>
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Email Address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="<?php echo $row['email'];?>" required>
                  </div>
            <div class="form-group col-md-3">
                  <label for="users">Mobile Number</label>
                  <input type="text" class="form-control"  id="mobile" name="mobile" placeholder="Enter mobile number" onkeypress="return isNumber();" minlength="10" maxlength="10" name="mobile" value="<?php echo $row['mobile'];?>" >
                </div>
                
          
             
                  <div class="form-group col-md-3">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter password" name="password" value="<?php echo $row['password'];?>" required>
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
		   

<?php }else if($action == 'deleteData') {

    $guid = $_GET['guid'];

    $sth = $db->query ("DELETE FROM `users` WHERE `guid`='$guid'");

    //$sth->execute();

    header('location:users.php'); 

  } else {
	 ?>	  
      <div class="row">
        <div class="col-12">
         <?php $sth = $db->query ("SELECT * FROM `users` order by guid DESC");
			$count = $sth->rowCount(); ?>

          <div class="card">
            <div class="card-header">
              <!--h3 class="card-title">DataTable with default features</h3-->
            </div>
		<div class="col-3"><a href="users.php?action=addNew" class="btn btn-info" >Add User</a>
        <p><?php echo $_GET[post_msg];?></p></div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>S.No</th>
				 
                  <th>Name</th>
                 
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Date</th>
                  <th>Status</th>
				  <th>Edit/Delete</th>
                </tr>
                </thead>
                <tbody>
               <?php if($count > 0) { 

						$m = 1;
						while($row = $sth->fetch()){ ?>
                <tr>
                  <td><?php echo $m; ?></td>

                  <td><?php echo $row['name']; ?></a></td>
				  <td><?php echo $row['email']; ?></td>
				   <td><?php echo $row['mobile']; ?></td>
				  <td><?php echo date('d-m-Y',strtotime($row['date'])); ?></td>
				   
				         <td class="update-st-<?php echo $row[0] ?>">
                         <select name="st_update" class="statusChange" data-guid="<?php echo $row[0] ?>" style="background:none">
             <option value="">Select Status</option>
                        <option <?php if($row['status']=='Active') { ?> selected<?php } ?> value="Active">Active</option>
                        <option <?php if($row['status']=='Inactive') { ?> selected<?php } ?> value="Inactive">Inactive</option>
                       

                         </select>
                        </td>   
				

                  <td><div class="btn-group btn-group-sm"> <a href="users.php?action=editData&guid=<?php echo $row[0]; ?>" class="btn btn-inverse"><i class="fa fa-edit icon-only"></i></a> <?php if($_SESSION['loginRole']=='superadmin'){ ?><a href="users.php?action=deleteData&guid=<?php echo $row[0]; ?>" class="btn btn-danger" onClick="return delete1();"><i class="fa fa-trash icon-only"></i></a><?php } ?></div></td>
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
<script type="text/javascript">
$("body").on("change",".statusChange",function(){
    var guid = $(this).data('guid'); //alert(guid);
    var ld = ".update-st-"+guid;     //alert(ld);
  var value = $(this).val();//alert(value);
  
  $.ajax({
    type:"post",
    url:"updatestatus.php",
    beforeSend: function(){
      $(ld).html('<div id="image" align="center"><img src="images/ajax_loader.gif" alt="" height="32" width="32"></div>');
    },          
    data:"guid="+guid+"&status="+value+"&Submit=UpdateUser",
    success:function(data){
      //alert(data);
     
     
          location.reload();
      
             

        }
  });
      
});

</script>
</body>
</html>
