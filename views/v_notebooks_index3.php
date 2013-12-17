		 <?php if($currentnotebook): ?>
		 		<?php foreach($currentnotebook as $cnotebook): ?>
				<strong>Note </strong><BR><BR> <a href='/notebooks/delete/<?=$cnotebook['notebook_id']?>'>Delete Notebook</a>
				<!-- Show notes and display a link to users profile -->
				<form id='formID' method='post' action='/notebooks/notebook/<?=$cnotebook['notebook_id']?>'>
    			Name: <BR>
    			<input value='<?=$cnotebook['name']?>' type='text' name='name' required><BR>
				<input value='<?=$cnotebook['notebook_id']?>' type='text' name='notebook_id' hidden><BR>
				<BR><BR>

				<input type='Submit' value='Save Notebook'>
				</form>
				<br><br>
				<div id='results'><BR></div>

				<?php endforeach; ?>
				
		

		<?php else: ?>
						There are no notes from you. Create a Note.
		<?php endif; ?> 
		       
		 
	