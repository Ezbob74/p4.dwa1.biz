

				<!--add tags view -->
				<strong>Add a new tag</strong><BR><BR>

				<form id='formID' method='post' action='/tags/p_add'>
					Title: <BR>
					<input value='' type='text' name='tag' required><BR>
					
					
					<BR><BR>
						
					<input type='Submit' id='ADD_Tag' value='Add Tag'>
				 	<input type='reset' value='Reset'> 
				</form>
				<br><br>
				<!-- Ajax results will go here -->
				<div id='results'><BR></div>
