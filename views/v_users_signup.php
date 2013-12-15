<strong>Sign Up</strong><BR><BR>
     <!-- Show users signup form, do error checking using java -->
    <script>
    $(document).ready(function(){
        $("#formID").validationEngine('attach');
       });
    </script>
    <form id="formID" method='POST' action='/users/p_signup'>
    <div class="container">
    <!-- validate first name, last name, email and make them all required , first name and last name can be letters only-->
    
	   First Name: <input class="validate[custom[onlyLetterSp]]" type='text' name='first_name' required><BR>
	   Last Name: <input class="validate[custom[onlyLetterSp]]" type='text' name='last_name' required><BR>
	   Email: <input class="validate[required,custom[email]] text-input" type="text" name="email" id="email" required/><BR>
	   Password: <input type='password' name='password' required><BR><BR>
    </div>
      <!-- display differnt error messages --> 
    <?php if($error=='error'): ?>
        <div id='error' class='errors'>
            Sign-up failed. Please use a different email. This email has been already used.
        </div>
        <br>
    <?php elseif($error=='error2'): ?>    
        <div id='error' class='errors'>
            Sign-up failed. Please use enter all information.
        </div>
        <br>
    <?php endif; ?>
	<input type='submit' value='Sign Up'>
    <input type='reset' value='Reset'> 
    </form>