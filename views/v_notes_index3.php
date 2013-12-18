		 <?php if($currentnote): ?>
		 		<?php foreach($currentnote as $cnote): ?>

				<strong>Note </strong><BR><BR> <a class="nav-link" href='/notes/delete/<?=$cnote['note_id']?>'>Delete Note</a>
				<!-- Show notes and display a link to users profile -->
				<form id='formID' method='post' action='/notes/note/'>
					
    			Title: <BR>
    			<input value='<?=$cnote['title']?>' type='text' name='title' required><BR>
				Body: <BR>
				<textarea name='body' rows="20" cols="50" required><?=$cnote['body']?></textarea>
				<input value='<?=$cnote['notebook_id']?>' type='text' name='notebook_id' hidden>
				<input value='<?=$cnote['note_id']?>' type='text' name='note_id' hidden>
				<BR>

				<?php if($notebooks): ?>
		 		<select name='notebook_id'>
		 		<?php foreach($notebooks as $cnotebook): ?>	
				<option value='<?=$cnotebook['notebook_id']?>' <?php if(($cnotebook['notebook_id']==$cnote['notebook_id'])) echo 'selected'; ?> >
						<?=$cnotebook['name']?>
				</option>
				<?php endforeach; ?>
				</select>
				<?php endif; ?> 
				<BR>


				<input type='Submit' value='Save Note'>
				</form>
				<br><br>
				<div id='results'><BR></div>

				<?php endforeach; ?>
				
		

		<?php else: ?>
						There are no notes from you. Create a Note.
		<?php endif; ?> 
		       
		 
	