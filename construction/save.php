<?php 
  if(isset($_POST['email']))
  {
    $email = $_POST['email'];
  }
  
  $db = mysql_connect("localhost", "database_username", "database_password"); 
  mysql_select_db("database_name", $db);
  mysql_query("INSERT INTO address (email) VALUES ('$email')", $db);
?>