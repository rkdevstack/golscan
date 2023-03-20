<!DOCTYPE html>
<html lang="en">
<head>
  <title>Gogol Coin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Transaction details</h2>
  
  <?php if($_GET['msg']=='success'){ echo "<h5 style='color:green;'>Mail sent successfully</h5>";} ?>
  <form action="mail.php" method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
    </div>
    <div class="form-group">
      <label for="pwd">Public Metamask Address:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter Public Metamask Address" name="address" required>
    </div>
    
      <div class="form-group">
      <label for="pwd">Transaction Hash Details:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Enter Transaction Hash details" name="hash_details" >
    </div>

    <button type="submit" class="btn btn-primary">Send</button>
  </form>
</div>

</body>
</html>
