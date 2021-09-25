<?php
$option = $_POST['o'];
$number = $_POST['n'];
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "hunting";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($option == "add"){
  $sql = "INSERT INTO numbers (number)
  VALUES ('$number')";
  
  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
if ($option == "del"){
  $sql = "DELETE FROM numbers WHERE number = $number";

if ($conn->query($sql) === TRUE) {
  echo "Record deleted successfully";
} else {
  echo "Error deleting record: " . $conn->error;
}
}


$conn->close();
?> 
