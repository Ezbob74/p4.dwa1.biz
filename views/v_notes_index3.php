		 <?php if($currentnote): ?>
		 		<?php foreach($currentnote as $cnote): ?>

				<strong>Note </strong><BR><BR> <a href='/notes/delete/<?=$cnote['note_id']?>'>Delete Note</a>
				<!-- Show notes and display a link to users profile -->
				<form id='formID' method='post' action='/notes/note/'>
					
    			Title: <BR>
    			<input value='<?=$cnote['title']?>' type='text' name='title' required><BR>
				Body: <BR>
				<textarea name='body' rows="20" cols="50" required><?=$cnote['body']?></textarea>
				<input value='<?=$cnote['notebook_id']?>' type='text' name='notebook_id' hidden>
				<input value='<?=$cnote['note_id']?>' type='text' name='note_id' hidden>
				<BR><BR>

				<input type='Submit' value='Save Note'>
				</form>
				<br><br>
				<div id='results'><BR></div>

				<?php endforeach; ?>
				
		

		<?php else: ?>
						There are no notebooks from you. Create a Note.
		<?php endif; ?> 
		       
		 
	