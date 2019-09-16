<?php session_start(); ?>
<?php include "config/config.php"; ?>
<?php include "config/autoload.php"; ?>
<?php
/* Set Time Zone */
date_default_timezone_set("UTC"); 
/* instantiate class objects */
$db = Db_connect::connect();
$user = new User_model();
$files = new File_model();
$chat_msg = new Chat_model();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TBC Portal</title>

  <!-- CSS -->
  <!-- <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500"> -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/styles.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Favicon and touch icons -->
  <link rel="shortcut icon" href="assets/ico/favicon.png">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>

<body>

  <!-- Top content -->
  <div class="top-content">
    <?php include 'views/header.php'; ?>

    <div class="inner-bg">
      <?php
      if(isset($_GET['action']) && !empty($_GET['action'])){
        $split = explode('/', $_GET['action']);
        $name = $split[1];
        if($_GET['action'] == 'controller/'.$name){
          $file = "controller/".$name.".php";
          if(file_exists($file)){
            include ($file);
          }
          else{
            include ('views/home.php');
          }
        }
        else{
          $file = "views/".$_GET['action'].".php";
          if(file_exists($file)){
            include ($file);
          }else{
            include ('views/home.php');
          }
        }
      }
      else{
        include ('views/home.php');
      }
      ?>
    </div>
  </div><!-- End Top content -->

  <!-- footer -->
  <?php include 'views/footer.php'; ?>
  <!-- Javascript - jQuery -->
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.backstretch.min.js"></script>
  <script src="assets/js/scripts.js"></script>

</body>

</html>
