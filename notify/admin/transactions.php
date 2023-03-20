<?php ob_start(); error_reporting(0);


require "lib/config.php";
require "lib/secure.php";
require "lib/title.php";

extract($_GET);

extract($_POST);
$date = date('Y-m-d');

require '../phpmailler/PHPMailerAutoload.php';

if(isset($_POST) && $_POST['Submit'] == 'Add') {

$t = $db->query("SELECT * FROM `transactions` where email = '".$email."' ")->rowCount();

if($t == 0){

$sth = $db->query("INSERT INTO `transactions` (`user`,`email`,`address`, `hash`,`date`) VALUES ('$user','$email','$address','$hash','$date')");
			
$lastid=$db->lastInsertId();


	if($sth > 0) { 
	
	include "mail.php";
	?>
	
	 <script type="text/javascript">
  			  alert('Transaction added successfully');
  			  window.location="transactions.php";
  			</script>
	
	<?php

	} else { ?>
	
  	        <script type="text/javascript">
  			alert('Please try Again');
  			window.location="transactions.php";
  			</script>
			
  	<?php 
	
	} }else{ ?>
	
	  <script type="text/javascript">
  			alert('Email already registered');
  			window.location="transactions.php";
  			</script>
	
<?php } }

if(isset($_POST) && $_POST['Submit'] == 'Uploadexcel') {

//echo "hai"; exit;

          $file = $_FILES['file']['tmp_name'];
          $handle = fopen($file, "r");
          $c = 0;
          while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
                    {
          $email = $filesop[1];
          $address = $filesop[2];
          $hash = $filesop[3];
          //$sql = "insert into excel(fname,lname) values ('$fname','$lname')";
          
if($email !='' && $email !='Email'){

$t = $db->query("SELECT * FROM `transactions` where email = '".$email."' ")->rowCount();

if($t == 0){  
    
$sql = $db->query("INSERT INTO `users` (`email`,`password`,`address`,`status`,`date`) VALUES ('$email','12345678','$address','Active','$date')");
			
$ins=$db->lastInsertId();

         $sth = $db->query("INSERT INTO `transactions` (`user`,`email`,`address`, `hash`,`status`,`date`) VALUES ('$ins','$email','$address','$hash','Pending','$date')");
         
         $lastid=$db->lastInsertId();

	   include "mail.php";

}
          }

         $c = $c + 1;
         

           }

		
 
	

	if($sth > 0) {
	
 
	?>
	
	 <script type="text/javascript">
  			  alert('Data added successfully');
  			  window.location="transactions.php";
  			</script>
	
	<?php

	} else { ?>
	
  	        <script type="text/javascript">
  			alert('Please try Again');
  			window.location="transactions.php";
  			</script>
			
 <?php } 
  
 

}

if(isset($_POST) && $_POST['Submit'] == 'Save') {



	$sth = $db->query("UPDATE `transactions` SET `user`='$user',`email`='$email',`address`='$address',`hash`='$hash',`date`='$date' WHERE `guid`=$guid");

	

		if($sth > 0) {  ?>
	
	 <script type="text/javascript">
  			  alert('Transaction details updated');
  			  window.location="transactions.php";
  			</script>
	
	<?php

	} 
	 else { ?>
	
  	        <script type="text/javascript">
  			alert('Please try Again');
  			window.location="transactions.php";
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
            <h1>Transactions</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Transactions</li>
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
			 
     <a href="transactions.php" class="btn btn-info" >Back</a> 
        <!-- SELECT2 EXAMPLE -->
		 <form role="form" method="POST" enctype="multipart/form-data" id="form">
        <div class="card card-default">
		
          <!-- left column -->
          
		  
         <div class="card-body">
		 <div class="row">
		 
		 
	   
        <div class="form-group col-md-3">
            <label for="zones">User</label>
          <select class="form-control" required id="user" name="user">
          <option value="">Select</option>
          <?php  $sth = $db->query ("SELECT * FROM `users` order by name asc");
            while($srow = $sth->fetch()){?>
      <option value="<?php echo $srow[guid];?>"><?php echo $srow[name];?></option><?php }?>
          </select>
        </div>
	  
             
         
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Email Address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" required>
                  </div>
                  
                   <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Meta mask Address</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Meta mask Address" name="address" required>
                  </div>
               
			         <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Txn hash details</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Txn hash details" name="hash" >
                  </div>
                 

               
		  </div>
		  </div>
		   <div class="card-footer">
                  <button type="submit" name="Submit" value="Add" class="btn btn-primary">Submit</button>
                </div>
		   </div>
		   </form>
		  	 <?php 	}else if($action == 'addNewexcel') { ?>
			 
     <a href="transactions.php" class="btn btn-info" >Back</a> 
        <!-- SELECT2 EXAMPLE -->
		 <form role="form" method="POST" enctype="multipart/form-data" id="form">
        <div class="card card-default">
		
          <!-- left column -->
          
		  
         <div class="card-body">
		 <div class="row">
		 
		 
             
             <div class="form-group col-md-3">
             <label for="exampleInputEmail1">File</label>
              <input type="file" class="form-control" id="exampleInputEmail1" accept=".csv" name="file" required><br>
             <!--a href="txn.xls" download="txn.xls">Download For Sample</a-->

             </div>
                
			
                 
                  
                <!-- /.card-body -->

               
		  </div>
		  </div>
		   <div class="card-footer">
                  <button type="submit" name="Submit" value="Uploadexcel" class="btn btn-primary">Submit</button>
                </div>
		   </div>
		   </form>
		  
	 <?php } else if($action == 'editData') { 

	$guid = $_GET['guid'];  ?>
	<a href="transactions.php" class="btn btn-info" >Back</a> 
	<form role="form" method="POST" enctype="multipart/form-data" id="form">
        <div class="card card-default">
		
          <!-- left column -->
           <?php $sth = $db->prepare ("SELECT * FROM `transactions` WHERE `guid` = '$guid'");

			      $sth-> execute();

				  $row = $sth-> fetch(); ?>
		  
         <div class="card-body">
		 <div class="row">
		 
		
           <div class="form-group col-md-3">
            <label for="zones">User</label>
          <select class="form-control" required id="user" name="user">
          <option value="">Select</option>
          <?php  $sth = $db->query ("SELECT * FROM `users` order by name asc");
            while($srow = $sth->fetch()){?>
      <option value="<?php echo $srow[guid];?>" <?php if($srow['guid']==$row['user']){ echo "selected";} ?>><?php echo $srow[name];?></option><?php }?>
          </select>
        </div>
	  
             
         
                  <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Email Address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email" value="<?php echo $row['email'];?>" required>
                  </div>
                  
                   <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Meta mask Address</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Meta mask Address" name="address" value="<?php echo $row['address'];?>" required>
                  </div>
               
			         <div class="form-group col-md-3">
                    <label for="exampleInputEmail1">Txn hash details</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Txn hash details" name="hash" value="<?php echo $row['hash'];?>" >
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

    $sth = $db->query ("DELETE FROM `transactions` WHERE `guid`='$guid'");

    //$sth->execute();

    header('location:transactions.php'); 

  } else {
	 ?>	  
      <div class="row">
        <div class="col-12">
         <?php $sth = $db->query("SELECT * FROM `transactions` order by guid DESC");
			$count = $sth->rowCount(); ?>

          <div class="card">
            <div class="card-header">
              <!--h3 class="card-title">DataTable with default features</h3-->
            </div>
		<div class="col-3"><a href="transactions.php?action=addNew" class="btn btn-info" >New transaction</a>
		
		<a href="transactions.php?action=addNewexcel" class="btn btn-success" >Bulk upload</a>
        <p><?php echo $_GET[post_msg];?></p></div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				  <th>S.No</th>
				 
                  <th>User</th>
                 
                  <th>Email</th>
                  <th>Meta mask address</th>
                  <th>Hash details</th>
                  <th>Date</th>
                  <th>Status</th>
				  <th>Edit/Delete</th>
                </tr>
                </thead>
                <tbody>
               <?php if($count > 0) { 

						$m = 1;
						while($row = $sth->fetch()){
						$reg = $db->query ("SELECT * FROM `users` where guid = '".$row['user']."' ")->fetch();?>
                <tr>
                  <td><?php echo $m; ?></td>

                  <td><?php echo $reg['name']; ?></a></td>
				  <td><?php echo $row['email']; ?></td>
				   <td><?php echo $row['address']; ?></td>
				   <td><?php echo $row['hash']; ?></td>
				  <td><?php echo date('d-m-Y',strtotime($row['date'])); ?></td>
				   
				       <td class="update-st-<?php echo $row[0] ?>">
                         <select name="st_update" class="statusChange" data-guid="<?php echo $row[0] ?>" style="background:none">
             <option value="">Select Status</option>
                        <option <?php if($row['status']=='Pending') { ?> selected<?php } ?> value="Pending">Pending</option>
                        <option <?php if($row['status']=='Sent') { ?> selected<?php } ?> value="Sent">Sent</option>
                        <option <?php if($row['status']=='Failed') { ?> selected<?php } ?> value="Failed">Failed</option>
                       

                         </select>
                        </td>   
				

                  <td><div class="btn-group btn-group-sm"> <a href="transactions.php?action=editData&guid=<?php echo $row[0]; ?>" class="btn btn-inverse"><i class="fa fa-edit icon-only"></i></a> <?php if($_SESSION['loginRole']=='superadmin'){ ?><a href="transactions.php?action=deleteData&guid=<?php echo $row[0]; ?>" class="btn btn-danger" onClick="return delete1();"><i class="fa fa-trash icon-only"></i></a><?php } ?></div></td>
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
    data:"guid="+guid+"&status="+value+"&Submit=Updatetxn",
    success:function(data){
      //alert(data);
     
     
          location.reload();
      
             

        }
  });
      
});

</script>
</body>
</html>
