<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<!-- JS/CSS File we want on every page -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>					
	<!-- Controller Specific JS/CSS -->
	<link rel="stylesheet" href="/css/sample-app.css" type="text/css">

	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	

   <!-- Begin Wrapper -->
		
		 <div id="container">
		<!-- Begin Header -->
		 <div id="header">
		 	4EverNote
		       <?php if(isset($contentheader)) echo $contentheader; ?>
		</div>
		<!-- End Header -->
		<!-- This is navigation -->
		<div id="MenuHeader">
		 	<a class="nav-link2" href='/notes/'>Home</a>:: 
            <?php if($user): ?>
                <a class="nav-link"  href='/notes/add'>Add Note</a> :: 
                <a class="nav-link" href='/notebooks/add'>Add Notebook</a> :: 
                <a class="nav-link" href='/tags/add'>Create Tag</a> :: 
                <a class="nav-link" href='/users/editprofile'>Edit Profile</a> :: 
                <a class="nav-link" href='/users/logout'>Logout</a>
            <?php else: ?>
                <a class="nav-link" href='/users/signup'>Sign Up</a> :: 
                <a class="nav-link" href='/users/login'>Log In</a>
            <?php endif; ?>
            <?php if($user): ?>
                Logged in as <?=$user->first_name?> <?=$user->last_name?><br>
            <?php endif; ?>
		       
		</div>
		<!-- This is end of navigation -->

		 <div id="COLL">
		 	<!-- Begin Left Column -->
		 <div id="col1"><?php if(isset($content1)) echo $content1; ?>
		 	 </div>
		 	<!-- End Left Column --> 
		 <div id="col2outer">
		 	<!-- Begin Left Middle Column -->
		 <div id="col2mid"><?php if(isset($content2)) echo $content2; ?>
		 
		 </div>
		 <!-- End Left Middle Column -->
			<!-- Begin Right  Column -->
		 <div id="col2side"><?php if(isset($content3)) echo $content3; ?>
		 
		 </div>
		 <!-- End Right  Column -->
		 </div>
		 </div>
		 <div id="footer">
		 
			   <!--Display footer-->
				Project 4 :: Dynamic Web Applications :: Harvard Extension School ::  Babak Mansouri
		 </div>
		 </div>
 <?php if(isset($client_files_body)) echo $client_files_body; ?>
	
</body>
</html>