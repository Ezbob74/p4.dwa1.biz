 <!-- let the user enter their email to reset the password -->
    <strong> Forgot Password? Enter your email and a new password will be emailed to you.</strong><BR><BR>
    <script>
    $(document).ready(function(){
        $("#formID").validationEngine('attach');
       });
    </script>
    
    <div class="container">
    <form id="formID" method='POST' action='/users/p_emailpassword'>

        <label>Email:</label> <input class="validate[required,custom[email]] text-input" type="text" name="email" id="email" required/><BR><BR>
          
    </div>
    
<!-- Display the errors -->    
    <?php if(isset($error)): ?>
        <div id='error' class='errors'>
           
    <?php if($error=='error1'): ?>
            Email was not found. Please enter the email used during signup.
    <?php elseif($error=='error2'): ?>
            Send failed or cant change password. Please contact support.
    <?php endif; ?>
    
        </div>
        <br>
    <?php endif; ?>

        <input type='submit' value='Email Password' >
        <input type='reset' value='Reset'> 
    </form>