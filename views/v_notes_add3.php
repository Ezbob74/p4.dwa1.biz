

				<!--add notes view -->
				<strong>Add a new note</strong><BR><BR>

				<form id='formID' method='post' action='/notes/p_add'>
					Title: <BR>
					<input value='Untitled'  class="validate[required]" type='text' name='title' required><BR>
					Body:
					<br>
					<textarea class="validate[required]" name='body' rows="20" cols="50" required></textarea>
					<BR><BR>
						
					<input type='Submit' id='ADD_Note' value='Add Note'>
				 	<input type='reset' value='Reset'> 
				</form>
				<br><br>
				<!-- Ajax results will go here -->
				<div id='results'><BR></div>

