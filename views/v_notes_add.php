<!--add notes view allowing posting of size 140 chars -->
<strong>Add a new note</strong><BR><BR>

<form id='formID' method='post' action='/notes/p_add'>

	<textarea name='body' rows="4" cols="50" required></textarea>

	<input type='Submit' value='Add new note'>
 	<input type='reset' value='Reset'> 
</form>
<!-- Ajax results will go here -->
<div id='results'></div>

