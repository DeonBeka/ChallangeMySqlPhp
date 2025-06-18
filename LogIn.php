<?php
  include("config.php");

   $error='';
   if($_SERVER["REQUEST_METHOD"] == "POST") {
        $db = "challangedb";
      // username and password sent from form 
      $username = mysqli_real_escape_string($db,$_POST['username']);
      $name = mysqli_real_escape_string($db,$_POST['name']); 
      $surname = mysqli_real_escape_string($db,$_POST['surname']); 


      $sql = "SELECT * FROM admin WHERE username = '$username' and name = '$name' and surname = '$surname";

      $result = mysqli_query($db,$sql);      
      $row = mysqli_num_rows($result);      
      $count = mysqli_num_rows($result);

      if($count == 1) {
	  
         // session_register("myusername");
         $_SESSION['login_user'] = $username;
         header("location: dashboard.php");
      } else {
         $error = "Your Login Name or Password is invalid";
      }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Log In</title>
</head>
<body>
    <form class="row g-3 needs-validation" novalidate action="SignUp.php" method="POST">
        <h1>Log In</h1>
  <div class="col-md-4">
    <label for="validationCustom01" class="form-label">First name</label>
    <input type="text" class="form-control" id="validationCustom01" name="name" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-4">
    <label for="validationCustom02" class="form-label">Last name</label>
    <input type="text" class="form-control" id="validationCustom02" name="surname" required>
    <div class="valid-feedback">
      Looks good!
    </div>
  </div>
  <div class="col-md-4">
    <label for="validationCustomUsername" class="form-label">Username</label>
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend">@</span>
      <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="username" required>
      <div class="invalid-feedback">
        Please write your username.
      </div>
    </div>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit" name="check">Log In</button>
  </div>
</form>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>