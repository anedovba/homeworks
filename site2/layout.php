<!DOCTYPE html>
<html>
<head>
	<title>SITE2</title>
	 <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	 <link href="/css/style.css" rel="stylesheet">
	<script src='/js/jquery-3.1.1.min.js'></script>
	<script src='/bootstrap/js/bootstrap.min.js'></script>

</head>
 <body>

   	<?php include 'header.php';?>

    <div class="container">
		<br>
		<div class="alert alert-info"><?=getFlash()?></div>
   	<?=$content;?>

	<?php include 'footer.php';?>
    </div><!-- /.container -->



  </body>
</html>