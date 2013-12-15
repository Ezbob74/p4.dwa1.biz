<?php if($notes): ?>
<strong>Your Notes </strong><BR><BR>
	 <!-- Show posts and display a link to users profile -->
	<?php foreach($notes as $note): ?>

	<div id='notes'><strong><a href='/users/profile/<?=$post['email']?>'><?=$post['first_name']?></a></strong><BR>

	<?=$note['body']?></div><br><br>
	

<?php endforeach; ?>
	
<?php else: ?>
	There are no notes from you. Create a Note.
<?php endif; ?>