<title>Remove My Number</title>
<style>
.myForm {
font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
font-size: 0.8em;
padding: 1em;
}

.myForm * {
box-sizing: border-box;
}

.myForm label {
padding: 0;
font-weight: bold;
}

.myForm input {
border: 1px solid #ccc;
border-radius: 3px;
font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
font-size: 0.9em;
padding: 0.5em;
}

.myForm input[type="text"] {
width: 12em;
}

.myForm button {
padding: 0.7em;
border-radius: 0.5em;
background: #eee;
border: none;
font-weight: bold;
}

.myForm button:hover {
background: #ccc;
cursor: pointer;
}
</style>
<!--<center><form class="myForm" action="remove.php" method="post">
Number: <input type="text" name="number" placeholder="ex. 2124797990"><br>
<br>
<button type="submit">Remove my Number</button>
</form></center>-->
<center>
<form class="myForm" method="post" action="remove.php">

<p>
<label>Number
<input type="text" name="number" placeholder="ex. 2124797990" required>
</label> 

<button>Remove</button>
</p>

</form>
</center>
<?php
if ($_POST)
{
   $dbhost = 'localhost';
   $dbuser = 'dbuser';
   $dbpass = 'dbpass';
   $dbname = 'hunting';
   $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
   
   if($mysqli->connect_errno) {
      echo "<script>alert('Error: $mysqli->connect_error');</script>";
      exit();
   }
   $number123 = $mysqli -> real_escape_string($_POST['number']);
   if ($number123 == "")
   {
      echo json_encode(array('error' => 'unauthorized'));
      exit();
   }
   if ($mysqli->query("DELETE FROM numbers WHERE number = $number123")) {
      echo "<script>alert('Success!');</script>";
   }
   if ($mysqli->errno) {
      echo "<script>alert('Error: $mysqli->error');</script>";
   }
$mysqli->close();
}
?>