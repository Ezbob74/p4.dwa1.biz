<!--add notes view allowing posting of size 140 chars -->
<strong>Add a new note</strong><BR><BR>

<form id='formID' method='post' action='/notes/p_add'>
	Title: <input value='Untitled' type='text' name='title' required><BR>
	<textarea name='body' rows="50" cols="50" required></textarea>

	<input type='Submit' value='Add new note'>
 	<input type='reset' value='Reset'> 
</form>
<!-- Ajax results will go here -->
<div id='results'></div>

