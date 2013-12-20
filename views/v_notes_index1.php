
		        
				<?php if($notebooks): ?>
				<strong>Notebooks </strong><BR><BR>
				 	<!-- Show posts and display a link to users profile -->
				<?php foreach($notebooks as $notebook): ?>

				<div id='notes'><strong><a class="nav-link" href='/notebooks/index/<?=$notebook['notebook_id']?>'><?=$notebook['name']?></a></strong><BR>

				</div><br><br>
				

				<?php endforeach; ?>

				<?php else: ?>
						There are no notebooks from you. Create a Notebook.
				<?php endif; ?> 
		 
				<?php if($tags): ?>
				<strong>Tags </strong><BR><BR>
				 	<!-- Show posts and display a link to users profile -->
				<?php foreach($tags as $tag): ?>

				<div id='notes'><strong><a class="nav-link" href='/tags/index/<?=$tag['tag_id']?>'><?=$tag['tag']?></a></strong><BR>

				</div><br><br>
				

				<?php endforeach; ?>

				<?php else: ?>
						There are no tags from you. Create a Tag.
				<?php endif; ?> 
				
