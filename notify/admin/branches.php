<?php ob_start(); error_reporting(0);


require "config.php";
require "secure.php";
require "title.php";

extract($_GET);

extract($_POST);
$date = date('Y-m-d');


if(isset($_POST) && $_POST['Submit'] == 'Add') {

$r = $db->query ("SELECT * FROM branches where name = '$name' ")->rowCount();
           
if($r ==0){
			
    
$sth = $db->query("INSERT INTO branches (`name`) VALUES ('$name')");
			
$ins=$db->lastInsertId();
			//print_r($area);exit;
	

	if($sth > 0) {  ?>
	
	 <script type="text/javascript">
  			  alert('Data Successfully Updated');
  			  window.location="branches.php";
  			</script>
	
	<?php

	} else { ?>
	
  	        <script type="text/javascript">
  			alert('Please try Again');
  			window.location="branches.php";
  			</script>
			
  	<?php 
	
	} 
		}else { ?>
<script type="text/javascript">
  			alert('Branch already added');
  			window.location="branches.php";
  			</script>

	<?php  }
	 
 
	//}
}

if(isset($_POST) && $_POST['Submit'] == 'Save') {




	$sth = $db->query("UPDATE branches SET `name`='$name' WHERE `guid`=$guid");

	

		if($sth > 0) {  ?>
	
	 <script type="text/javascript">
  			  alert('Data Successfully Updated');
  			  window.location="branches.php";
  			</script>
	
	<?php

	} 
	 else { ?>
	
  	        <script type="text/javascript">
  			alert('Please try Again');
  			window.location="branches.php";
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
            <h1>Branches</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">Branches</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		
	 <?php if($action == 'deleteData') {

    $guid = $_GET['guid'];

    $sth = $db->query ("DELETE FROM branches WHERE `guid`='$guid'");

    //$sth->execute();

    header('location:branches.php'); 

  } else { ?>  
      <div class="row">
        <div class="col-12">
         <?php $sth = $db->query ("SELECT * FROM branches order by guid DESC");
			         $count = $sth->rowCount(); ?>

          <div class="card">
            <div class="card-header">
              <!--h3 class="card-title">DataTable with default features</h3-->
            </div>
		<div class="col-3"><a href="#"  data-toggle="modal" data-target="#modal-add" class="btn btn-info" >New branch</a>
        <p><?php echo $_GET[post_msg];?></p></div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				          <th>S.no</th>
				          <th>Branch</th>
                          <th>Edit</th>
				          <th>Delete</th>
                </tr>
                </thead>
                <tbody>
               <?php if($count > 0) { 

						$m = 1;
						while($row = $sth->fetch()){ ?>
                <tr>
                  <td><?php echo $m; ?></td>
                  <td><?php echo $row['name']; ?></td>
				 
                 <td><div class="btn-group btn-group-sm"> <a data-toggle="modal" data-target="#modal-edit<?php echo $row[0]; ?>" class="btn btn-inverse"><i class="fa fa-edit icon-only"></i></a> </div></td>
                  <td><div class="btn-group btn-group-sm"> <a href="branches.php?action=deleteData&guid=<?php echo $row[0]; ?>" class="btn btn-danger" onClick="return delete1();"><i class="fa fa-trash icon-only"></i></a></div></td>
                </tr>

        <div class="modal fade" id="modal-edit<?php echo $row[0]; ?>">
        <div class="modal-dialog">
          <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data" id="form">
            <div class="modal-header">
              <h4 class="modal-title">Edit branch</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               
             <div class="form-group">
                  <label for="merchants">Branch name</label>
                  <input type="text" class="form-control" required id="name" name="name" placeholder="Branch name" value="<?php echo $row['name']; ?>">
                </div>
                <input type="hidden" name="guid" value="<?php echo $row['guid']; ?>">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="Submit" value="Save" class="btn btn-primary">Save changes</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

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
              <h4 class="modal-title">Add branch</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
             <div class="form-group">
                  <label for="merchants">Branch name</label>
                  <input type="text" class="form-control" required id="name" name="name" placeholder="Branch name">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="Submit" value="Add" class="btn btn-primary">Save changes</button>
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
</script>
</body>
</html>
