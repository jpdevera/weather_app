<?php 

//Get the base path an
$currentPath = $_SERVER['PHP_SELF'];
$pathInfo  = pathinfo($currentPath);
$hostName  = $_SERVER['HTTP_HOST'];
$protocol  = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https://'?'https://':'http://';

// Set base url and base index
$base_url = $protocol.$hostName.$pathInfo['dirname']."/";
$base_url_index = $base_url.'index.php?';
$title = 'Weather Application';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>
    <?php 
      if(isset($title)) { 
        echo htmlentities($title); 
      } 
    ?>
  </title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $base_url ?>bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $base_url ?>assets/css/style.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $base_url_index ?>&module=home">Weather Application</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo $base_url_index ?>&module=home">Home</a></li>
            <li><a href="<?php echo $base_url_index ?>&module=travel">Travel</a></li>
            <li><a href="<?php echo $base_url_index ?>&module=weather">Weather</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="hidden" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>

    <input type="hidden" value="<?=$base_url?>" id="base_url">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" style="margin-top: 80px;">
          <ul class="nav nav-sidebar">
            <li>
            </li>
            <!-- <li><a href="<?php echo $base_url_index ?>&module=travel">Travel</a></li>
            <li><a href="<?php echo $base_url_index ?>&module=weather">Weather</a></li> -->
            <!-- <li><a href="<?php echo $base_url_index ?>&module=travel">Travel</a></li> -->
          </ul>
        </div>