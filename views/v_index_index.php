<?php if($user): ?>
<!-- Redirect to posts if user is logged in-->
	<?php Router::redirect("/notes/"); ?>
<!-- if user is not logged in show features and welcome-->
<?php else: ?>
	Welcome to 4EverNote. Please sign up or login.<BR><BR>
	<STRONG>Features:</STRONG><BR>
	&bull; 1. <br>
	&bull; 2. <BR>
	&bull; 3. <BR>
<?php endif; ?>