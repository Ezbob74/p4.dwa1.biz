 <!-- Show users profile in the form and let him edit it -->
<strong>Edit User Profile</strong><BR><BR>
<script>
    $(document).ready(function(){
        $("#formID").validationEngine('attach');
       });
</script>
<form id="formID" method='POST' action='/users/update'>
<div class="container">
	First Name: <input value='<?=$user->first_name?>' class="validate[custom[onlyLetterSp]]" type='text' name='first_name' required><BR>
	Last Name: <input value='<?=$user->last_name?>' class="validate[custom[onlyLetterSp]]" type='text' name='last_name' required><BR>
	Email: <input  value='<?=$user->email?>' class="validate[required,custom[email]] text-input" type="text" name="email" id="email" /><BR>
	Password: <input  type='password' name='password' required><BR>
</div>
<!--display errors-->    
    <?php if(isset($error)): ?>
        <div id='error' class='errors'>
            Update failed. Please use a different email.
        </div>
        <br>
    <?php endif; ?>
	<input type='submit' value='Update'>
</form>

