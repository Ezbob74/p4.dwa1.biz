
		       <div id='notes'></div>
				<?php if($notes): ?>
				<strong>Your Notes </strong><BR><BR>
				 	<!-- Show posts and display a link to users profile -->
				<?php foreach($notes as $note): ?>

				<div id='notes'><strong><a class="nav-link" href='/notes/index/<?=$note['note_id']?>'><?=$note['title']?></a></strong><BR>

				</div><br><br>
				

				<?php endforeach; ?>
				
				<?php else: ?>
						There are no notes from you. Create a Note.
				<?php endif; ?> 
