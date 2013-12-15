<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- JS/CSS File we want on every page -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>					
	<!-- Controller Specific JS/CSS -->
	<link rel="stylesheet" href="/css/main.css" type="text/css">
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
	

	
   <!-- Begin Wrapper -->
	<?php if(isset($content)) echo $content; ?>
		 
   <!-- End Wrapper -->
<?php if(isset($client_files_body)) echo $client_files_body; ?>

</body>
</html>