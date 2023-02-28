<?php
require_once 'database.php';

function login($email, $password) {

  $con = database_connect();
  $query = "SELECT * FROM `user` WHERE `email` = '$email' && `password` = '$password'";
  $query_result = mysqli_query($con, $query);

  return mysqli_fetch_assoc($query_result);

}

// function addNewUser($name, $email, $password, $img, $user_id) {
//   $con = database_connect();

//   $query = "INSERT INTO `user`(`name`, `email`, `password`, `avatar`) 
//             VALUES 
//             ('$name', '$rate', '$feedback', '$avatar')";

//             // echo $query; die;

//   mysqli_query($con, $query);

//   return mysqli_affected_rows($con) == 1 ? true : false;
// }