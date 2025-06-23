<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Dashboard</title>
    <style>
        table,td,th{
            border:1px solid black;
            border-collapse:collapse;
        }
        th,td{
            padding:10px 20px
        }
    </style>
</head>
<body>
    <?php
    include_once('config.php');
    $sql="SELECT * FROM users";
    $getUsers=$conn->prepare($sql);
    $getUsers->execute();

    $users=$getUsers->fetchALL();
    
    
    ?>
    <table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Surname</th>
      <th scope="col">Username</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
      <?php
            foreach($users as $user){

            ?>
            <tr>
                <td><?= $user['id'];?>
                <td><?= $user['name'];?>
                <td><?= $user['surname'];?>
                <td><?= $user['username'];?>
                <td><?= "<a href='delete.php?id=$user[id]'>Delete</a>|<a href='edit.php?id=$user[id]'>Update</a> "?></td>
            </tr>
            <?php
            }
            ?>
  </tbody>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>