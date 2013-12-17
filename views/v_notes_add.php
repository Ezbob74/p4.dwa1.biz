
	<div id="wrapper">
   
         <!-- Begin Header -->
         <div id="header">
		 
		       4EverNote		 
			   
		 </div>
		 <!-- End Header -->
		 
		 <!-- Begin Left Column -->
		 <div id="leftcolumn">
		 
		       Left Column
		 
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
						
		

				<!--add notes view -->
				<strong>Add a new note</strong><BR><BR>

				<form id='formID' method='post' action='/notes/p_add'>
					Title: <BR>
					<input value='Untitled' type='text' name='title' required><BR>
					Body:
					<br>
					<textarea name='body' rows="20" cols="50" required></textarea>
					<BR><BR>
						Here:"<?=$new_note_id?>"
					<input type='Submit' id='ADD_Note' value='Add Note'>
				 	<input type='reset' value='Reset'> 
				</form>
				<br><br>
				<!-- Ajax results will go here -->
				<div id='results'><BR></div>



		       
		 
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
