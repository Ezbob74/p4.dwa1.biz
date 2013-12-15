

<div id="wrapper">
   
         <!-- Begin Header -->
         <div id="header">
		 
		       4EverNote		 
			   
		 </div>
		 <!-- End Header -->
		 <div id='test'>
		 <!-- Begin Left Column -->
		 <div id="leftcolumn">
		 
		       Left Column
		 
		 </div>
		 <!-- End Left Column -->
		 
		 <!-- Begin Left Middle Column -->
		 <div id="leftmiddle">
		      <!--Display content-->
				<?php if($notes): ?>
				<strong>Your Notes </strong><BR><BR>
				 	<!-- Show posts and display a link to users profile -->
				<?php foreach($notes as $note): ?>

				<div id='notes'><strong><a href='/notes/note/<?=$note['note_id']?>'><?=$note['title']?></a></strong><BR>

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
				<strong>Current Note </strong><BR><BR>
				 	<!-- Show posts and display a link to users profile -->
				<?php foreach($currentnote as $cnote): ?>

				<div id='note'><strong><a href='/users/profile/<?=$post['email']?>'><?=$post['first_name']?></a></strong><BR>

				<?=$cnote['body']?></div><br><br>
				

				<?php endforeach; ?>
				
		<?php else: ?>
						There are no notes from you. Create a Note.
		<?php endif; ?> 
		       
		 
		 </div>
		 <div id='results'></div>
		 <!-- End Right Middle Column -->
		 
		 <!-- Begin Right Column 
		 <div id="rightcolumn">
		 
		       Right Column
		 
		 </div>-->
		 <!-- End Right Column -->
		 </div>
		 
		 <!-- Begin Footer -->
		 <div id="footer">
		       
			   <!--Display footer-->
				Project 4 :: Dynamic Web Applications :: Harvard Extension School ::  Babak Mansouri
    
			
			    
	     </div>
		 <!-- End Footer -->
		 
   </div>