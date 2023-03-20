<?php ob_start(); error_reporting(0);
//ini_set('session.cookie_lifetime', 604800);
//ini_set('session.gc_maxlifetime', 604800);
session_start();
session_destroy();
require "lib/config.php";
require "lib/title.php";
extract($_POST); 
extract($_GET);
if(!empty($_SESSION['superadmin'])){
	
header('location:home.php');	
}
if(isset($_POST) && $_POST['Submit'] == 'Login'){
   
   
		//print_r($_POST); exit;
		$lusername = stripslashes($username);
		$lpassword = stripslashes($password);
		
                //echo "SELECT * FROM `login` WHERE `username` = '$lusername' AND `status` = 'Active'";exit;
		$sth = $db->prepare("SELECT * FROM `login` WHERE BINARY `username` = '$lusername' AND `status` = 'Active'");
		$sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		
		$sql = $db->prepare("SELECT * FROM `sub_admins` WHERE BINARY `email` = '$lusername' ");
		$sql->execute();
		$frow = $sql->fetch(PDO::FETCH_ASSOC);
		
		
		if(!empty($row['guid'])){
		   //print($row[username]); exit;
	
		$bth = $db->prepare("SELECT * FROM login WHERE BINARY username = :username AND password = :password AND status = 'Active'");
            
		$bth->execute(array(':username' => $lusername, ':password' => $lpassword)); 

		$count = $bth->rowCount();

			if($count > 0 ) {
				//$data = $sth->fetchAll();
				//print_r($row); exit;
				session_start();
				$_SESSION['authenticate'] = true;
				$_SESSION['superadmin'] = $row['guid'];
				$_SESSION['loginRole'] = $row['role'];
				$_SESSION['UserName'] = $row['username'];
				$_SESSION['Name'] = $row['name'];
				
				//echo $_SESSION['Name'];exit;
				
			header('location:home.php');
				
				}  else { 
				session_start();
				session_destroy();
				$post_msg= 'Username / password Mismatch';
				header('location:index.php?post_msg='.$post_msg);
				
			}
			 
		
	}	else { 
				session_start();
				session_destroy();
				$post_msg= 'Username / password Mismatch';
				header('location:index.php?post_msg='.$post_msg);
		
	}
	
  
 }

if(isset($_POST) && $_POST['Submit'] == 'Forgot'){
    
		//print_r($_POST); exit;
		$sth = $db->prepare("SELECT * FROM login WHERE BINARY username = '".$_POST['username']."' AND BINARY email = '$email'");
		$sth->execute();
		$row = $sth->fetch(PDO::FETCH_ASSOC);
		//print_r($row); exit;
		//$count = $sth->rowCount();
		if(!empty($row[guid])){
			//print($row[username]); exit;
 //echo $decrypted;exit;
  			$to=$row['email'];
			$subject="Forgot Password Details from ".TITLE;
			$message="Your Login Details\n
			Username  :  $row[username] \n
			Password  :  $row[password] 
			";
			$from = "no-reply@gogolcoin.io";
			$headers = "From:" . $from;
	mail($to,$subject,$message,$headers);
	$post_msg = 'Password Sent Successfully To Mail ID';	
	header('location:index.php?post_msg='.$post_msg);
		}else{
				$post_msg= 'Username / Email ID Mismatch';
				header('location: index.php?post_msg='.$post_msg);
		
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
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="home.php"><!--img src="images/icon.png" alt="" style="width:100px;"--><b><?php echo TITLE;?></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg" style="color:red;"><?php echo $post_msg;?></p>

      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="input-group mb-3">
           <input type="text" name="username" required placeholder="Username" class="form-control" >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" required class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!--div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div-->
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="Submit" value="Login" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!--div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div-->
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-add">I forgot my password</a>
      </p>
      <!--p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p-->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

 <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data" id="form">
            <div class="modal-header">
              <h4 class="modal-title">Forgot Password</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                
               
             <div class="form-group">
                  <label for="merchants">Registered Email ID</label>
                  <input type="email" class="form-control" required id="email" name="email" placeholder="Email ID">
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="Submit" value="Forgot" class="btn btn-primary">Send</button>
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
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
