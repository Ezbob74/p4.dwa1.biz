<?php if($user): ?>
<!-- Redirect to posts if user is logged in-->
	<?php Router::redirect("/notes/"); ?>
<!-- if user is not logged in show features and welcome-->
<?php else: ?>
	Welcome to 4EverNote. Please sign up or login.<BR><BR>
	<STRONG>What is 4EverNote:</STRONG><BR><BR>
	&bull; 1. It is a Note taking applocation. <br>
	&bull; 2. It is Web based.<BR>
	&bull; 3. It supports multiple Notebooks.<BR>
	&bull; 4. It supports tages.<BR>

<?php endif; ?>