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
	

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	<!-- Begin Wrapper -->
   <div id="wrapper">
   
         <!-- Begin Header -->
         <div id="header">
		 
		       4EverNote		 
			   
		 </div>
		 <!-- End Header -->
		 <div id='test'>
		 <!-- Begin Left Column -->
		 <div id="leftcolumn">
		 
		       Left Column
		 
		 </div>
		 <!-- End Left Column -->
		 
		 <!-- Begin Left Middle Column -->
		 <div id="leftmiddle">
		       
               Left Middle

         </div>
		 <!-- End Left Middle Column -->
		 
		 <!-- Begin Right Middle Column -->
		 <div id="rightmiddle">
		 
		       	<!--Display content-->
				<?php if(isset($content)) echo $content; ?>
		 
		 </div>
		 <!-- End Right Middle Column -->
		 
		 <!-- Begin Right Column 
		 <div id="rightcolumn">
		 
		       Right Column
		 
		 </div>-->
		 <!-- End Right Column -->
		 </div>
		 <!-- Begin Footer -->
		 <div id="footer">
		       
			   <!--Display footer-->
				Project 4 :: Dynamic Web Applications :: Harvard Extension School ::  Babak Mansouri
    
			
			    
	     </div>
		 <!-- End Footer -->
		 
   </div>
   <!-- End Wrapper -->


</body>
</html>