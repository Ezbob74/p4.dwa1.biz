		 <?php if($currenttag): ?>
		 		<?php foreach($currenttag as $ctag): ?>
				<strong>Tag </strong><BR><BR> <a href='/tags/delete/<?=$ctag['tag_id']?>'>Delete Tag</a>
				
				<!-- Show tags -->
				<form id='formID' method='post' action='/tags/tag/<?=$ctag['tag_id']?>'>
    			Name: <BR>
    			<input value='<?=$ctag['tag']?>' type='text' name='tag' required><BR>
				<input value='<?=$ctag['tag_id']?>' type='text' name='tag_id' hidden><BR>
				<BR><BR>

				<input type='Submit' value='Save Tag'>
				</form>
				<br><br>
				<div id='results'><BR></div>

				<?php endforeach; ?>
				
		

		<?php else: ?>
						There are no tags from you. Create a Tag.
		<?php endif; ?> 
		       
		 
	