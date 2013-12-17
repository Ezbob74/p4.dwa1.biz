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
	
<div id="wrapper">
   
         <!-- Begin Header -->
         <div id="header">
		 		4EverNote
		       <?php if(isset($contentheader)) echo $contentheader; ?>	 
			   
		 </div>
		 <!-- End Header -->
		 
		 <!-- Begin Left Column -->
		 <div id="leftcolumn">
		 
		       <?php if(isset($content1)) echo $content1; ?>
		 
		 </div>
		 <!-- End Left Column -->
		 
		 <!-- Begin Left Middle Column -->
		 <div id="leftmiddle">
		      <!--Display content-->
		      
		      <?php if(isset($content2)) echo $content2; ?>
         </div>
		 <!-- End Left Middle Column -->
		 
		 <!-- Begin Right Middle Column -->
		 <div id="rightmiddle">
								
				<?php if(isset($content3)) echo $content3; ?>
		       		 
		 </div>
		 
		 <!-- End Right Middle Column -->
		 
		 <!-- Begin Right Column 
		 <div id="rightcolumn">
		 
		       Right Column
		 
		 </div>-->
		 <!-- End Right Column -->
		 
		 
		 <!-- Begin Footer -->
		 <div id="footer">
		       
			   <!--Display footer-->
				Project 4 :: Dynamic Web Applications :: Harvard Extension School ::  Babak Mansouri
    
			
			    
	     </div>
		 <!-- End Footer -->
		 
	</div>


   <!-- End Wrapper -->
<?php if(isset($client_files_body)) echo $client_files_body; ?>
<script type="text/javascript" src="/js/extend.js"></script>
</body>
</html>