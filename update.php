<?php
include_once("config.php");

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];

    $sql = "UPDATE users SET name=:name, surname=:surname, username=:username where id=:id";

    $prep = $conn->prepare($sql);
    $prep->bindParam(':id',$id);
    $prep->bindParam(':name',$name);
    $prep->bindParam(':surname',$surname);
    $prep->bindParam(':username',$username);

    $prep->execute();

    header('Location:dashboard.php');
}


?>