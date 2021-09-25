<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "hunting";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <meta name="title" content="MN DNR Seasons Alet Signup">
    <meta name="description" content="Signup to recieve alerts two weeks before a season starts.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://samzy.dev/api/hunting">
    <meta property="og:title" content="MN DNR Seasons Alet Signup">
    <meta property="og:description" content="Signup to recieve alerts two weeks before a season starts.">
    <meta property="og:image" content="https://samzy.dev/api/hunting/images/background2.jpg">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://samzy.dev/api/hunting">
    <meta property="twitter:title" content="MN DNR Seasons Alet Signup">
    <meta property="twitter:description" content="Signup to recieve alerts two weeks before a season starts.">
    <meta property="twitter:image" content="https://samzy.dev/api/hunting/images/background2.jpg">
    <link rel="shortcut icon" type="image/jpg" href="https://samzy.dev/api/hunting/images/favcon.jpg">
    <title>MN DNR Seasons Alet Signup </title>
    
    <link href="css/bootstrap.css" rel="stylesheet" />
	<link href="css/coming-sssoon.css" rel="stylesheet" />    
  <script src="https://kit.fontawesome.com/6e95a0a8bd.js" crossorigin="anonymous"></script>
    <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
  
</head>

<body>
<nav class="navbar navbar-transparent navbar-fixed-top" role="navigation">  
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      <li>
                <a href="remove.php" target="_blank" style="font-size: 18px;color:#FFFFFF;text-shadow: 0 1px 4px rgba(0, 0, 0, 0.33);"> 
                     Remove My Number
                </a>
            </li>
            <li>
                <a href="https://paypal.me/SamzyDev" target="_blank" style="font-size: 18px;color:#FFFFFF;text-shadow: 0 1px 4px rgba(0, 0, 0, 0.33);"> 
                     Donate
                </a>
            </li>
       </ul>
      
    </div>
  </div>
</nav>
<div class="main" style="background-image: url('images/background2.jpg')">
    
    <div class="cover black" data-color="black"></div>

    <div class="container">
        <h1 class="logo">
            Alert Signup
        </h1>
        
        <div class="content">
            <h4 class="motto">Signup to recieve alerts two weeks before a season starts.</h4>
            <div class="subscribe">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                    <form class="form-inline" role="form" action="index.php" method="post">
                    <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail2">Phone Number</label>
<input type="text" class="form-control transparent" name="number" placeholder="ex. 2124797990" />
</div>
<button type="submit" class="btn btn-danger btn-fill">Notify Me</button>
</form> 
                        <?php
                        function validateMobileNumber($mobile) {
                          if (!empty($mobile)) {
                            $isMobileNmberValid = TRUE;
                            $mobileDigitsLength = strlen($mobile);
                            if ($mobileDigitsLength < 10 || $mobileDigitsLength > 15) {
                              $isMobileNmberValid = FALSE;
                            } else {
                              if (!preg_match("/^[+]?[1-9][0-9]{9,14}$/", $mobile)) {
                                $isMobileNmberValid = FALSE;
                              }
                            }
                            return $isMobileNmberValid;
                          } else {
                            return false;
                          }
                        }
                        if ($_POST){
                              if(!validateMobileNumber($_POST['number']))
                          {
                              echo "<script>alert('Sorry, make sure you put in your number like the example!');</script>";
                          }else{
                            $number = $_POST['number'];
                            $sql = "INSERT INTO numbers (number, events)
                            VALUES ('$number', '')";
                            
                            if ($conn->query($sql) === TRUE) {
                            } else {
                              echo "<script>alert('Error');</script>";
                            }
                            echo "<script>alert('You\'ve been added!');</script>";
                            $conn->close();
                          }
                        }
                        ?>
                        <h5 class="info-text">
                          All info comes from <a href="https://www.dnr.state.mn.us/hunting/seasons.html" target="_blank">here</a>.
                      </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer">
      <div class="container">
             Made with <i class="fa fa-heart heart"></i> by <a href="https://samzy.dev">Samzy.Dev</a>. Donate <a href="https://paypal.me/SamzyDev" target="_blank">here.</a>
      </div>
    </div>
 </div>
 </body>
   <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
   <script src="js/bootstrap.min.js" type="text/javascript"></script>

</html>