

	<div id="wrapper">
   
         <!-- Begin Header -->
         <div id="header">
		 
		       4EverNote		 
			   
		 </div>
		 <!-- End Header -->
		 
		 <!-- Begin Left Column -->
		 <div id="leftcolumn">
		 
		       <div id='notebooks'><strong><a href='/notes/add'>Add Note</a></strong><BR></div><br><br>
				<?php if($notebooks): ?>
				<strong>Your Notebooks </strong><BR><BR>
				 	<!-- Show posts and display a link to users profile -->
				<?php foreach($notebooks as $notebook): ?>

				<div id='notes'><strong><a href='/notes/index/<?=$notebook['notebook_id']?>'><?=$notebook['name']?></a></strong><BR>

				</div><br><br>
				

				<?php endforeach; ?>
				
				<?php else: ?>
						There are no notes from you. Create a Note.
				<?php endif; ?> 
		 
		 </div>
		 <!-- End Left Column -->
		 
		 <!-- Begin Left Middle Column -->
		 <div id="leftmiddle">
		      <!--Display content-->
		      <div id='notes'><strong><a href='/notes/add'>Add Note</a></strong><BR></div><br><br>
				<?php if($notes): ?>
				<strong>Your Notes </strong><BR><BR>
				 	<!-- Show posts and display a link to users profile -->
				<?php foreach($notes as $note): ?>

				<div id='notes'><strong><a href='/notes/index/<?=$note['note_id']?>'><?=$note['title']?></a></strong><BR>

				</div><br><br>
				

				<?php endforeach; ?>
				
				<?php else: ?>
						There are no notes from you. Create a Note.
				<?php endif; ?> 
               

         </div>
		 <!-- End Left Middle Column -->
		 
		 <!-- Begin Right Middle Column -->
		 <div id="rightmiddle">
		
		 <?php if($currentnote): ?>
		 		<?php foreach($currentnote as $cnote): ?>
				<strong>Note </strong><BR><BR> <a href='/notes/delete/<?=$cnote['note_id']?>'>Delete Note</a>
				<!-- Show notes and display a link to users profile -->
				<form id='formID' method='post' action='/notes/note/<?=$cnote['title']?>'>
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
						There are no notes from you. Create a Note.
		<?php endif; ?> 
		       
		 
		 </div>
		 
		 <!-- End Right Middle Column -->
		 
		 <!-- Begin Right Column 
		 <div id="rightcolumn">
		 
		       Right Column
		 
		 </div>-->
		 <!-- End Right Column -->
		 
		 
		 <!-- Begin Footer -->
		 <div id="footer">
		       
			   <!--Display footer-->
				Project 4 :: Dynamic Web Applications :: Harvard Extension School ::  Babak Mansouri
    
			
			    
	     </div>
		 <!-- End Footer -->
		 
	</div>