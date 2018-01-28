<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="/bootstrap/css/bootstrap-theme.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script src="/bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="/css/css.css">
</head>
<body>
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/">Головна</a></li>
        <li><a href="/account">Особистий кабінет</a></li>
                <?php
        if( isset( $_SESSION['user'] ) ) { 
          ?>
               
          <li class='navbar-right'> <a href="/logout">Вихід</a></li>
          <?php } 
          else  { ?>
          <li class='pull-right'><a href="/login">Вхід</a></li> 
          <?php } ?>

         
          </ul>
      </div>
    </div>
  </nav>
</body>
</html>
<?php
if(isset($_SESSION['flash_msg'])){
  echo $_SESSION['flash_msg'];
  unset($_SESSION['flash_msg']);
}
?>

