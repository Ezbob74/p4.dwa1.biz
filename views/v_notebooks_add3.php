

				<!--add notebook view -->
				<strong>Add a new notebook</strong><BR><BR>

				<form id='formID' method='post' action='/notebooks/p_add'>
					Title: <BR>
					<input value='Untitled Notebook' type='text' name='name' required><BR>
					
					
					<BR><BR>
						
					<input type='Submit' id='ADD_Notebook' value='Add Notebook'>
				 	<input type='reset' value='Reset'> 
				</form>
				<br><br>
				<!-- Ajax results will go here -->
				<div id='results'><BR></div>
