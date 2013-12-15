<?php
# This is the users controller
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct(); 
 
    } 

    public function index() {
        // If user is not logged in redirect them to login
        if(!$this->user){
                die('Members Only <a href="/users/login">Login</a>');
        }   
        echo "This is the index page";
    }
    # this sets up signup view, loads js and css and captures errors
    public function signup($error = NULL) {
        $this->template->content=View::instance('v_users_signup');

        $this->template->title= APP_NAME. " :: Sign up";
            // add required js and css files to be used in the form
        $client_files_head=Array('/js/languages/jquery.validationEngine-en.js',
                             '/js/jquery.validationEngine.js',
                             '/css/validationEngine.jquery.css');

        $this->template->client_files_head=Utils::load_client_files($client_files_head);
        # error checking passed to view
        $this->template->content->error = $error;
        echo $this->template;
    }

    # this is the function that processes the signup 
    public function p_signup() {

        $q= 'Select email         
          From users            
           WHERE email="'.$_POST['email'].'"';
        # see if the email exists
        $emailexists= DB::instance(DB_NAME)->select_field($q);
        
        # email exists, throw an error
        if($emailexists){  
      
             Router::redirect("/users/signup/error"); 
          
         }
         
         #requires all fields to be entered if java script is disabled, otherwise thow a different error
        
        elseif (!$_POST['email'] OR !$_POST['last_name'] OR !$_POST['first_name'] OR !$_POST['password']) {
              Router::redirect("/users/signup/error2"); 
        }
        # all is well , proceed with signup
        else{
           
            $_POST['created']= Time::now();
            $_POST['password']= sha1(PASSWORD_SALT.$_POST['password']); 
            $_POST['token']= sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 

        # add user to the database and redirect to users login page        
            DB::instance(DB_NAME)->insert_row('users',$_POST);
            Router::redirect('/users/login');
        }
        
    }

    # sets up login view and shows error using the view 
    public function login($error = NULL) {
        
        $this->template->content=View::instance('v_users_login');    
        $this->template->title= APP_NAME. " :: Login";
        // add required js and css files to be used in the form
        $client_files_head=Array('/js/languages/jquery.validationEngine-en.js',
                             '/js/jquery.validationEngine.js',
                             '/css/validationEngine.jquery.css'
                             );
        $this->template->client_files_head=Utils::load_client_files($client_files_head);    
        # Pass data to the view
        $this->template->content->error = $error;

        echo $this->template;


    }
    # this sets up email password view and displays error if any
    public function emailpassword($error = NULL) {
        
        $this->template->content=View::instance('v_users_emailpassword');    
        $this->template->title= APP_NAME. " :: Login";
        // add required js and css files to be used in the form
        $client_files_head=Array('/js/languages/jquery.validationEngine-en.js',
                             '/js/jquery.validationEngine.js',
                             '/css/validationEngine.jquery.css'
                             );
        $this->template->client_files_head=Utils::load_client_files($client_files_head);    
        # Pass data to the view
        $this->template->content->error = $error;

        echo $this->template;


    }
    # processes login
    public function p_login(){

        # if javascript is disabled this checks if user enters email and password to login
        if (!$_POST['email'] OR !$_POST['password']) {
                Router::redirect("/users/login/error"); 
              } 
        #if email and password is entered        
        else {  
                $_POST['password']=sha1(PASSWORD_SALT.$_POST['password']);

                $q= 'Select token From users            
                       WHERE email="'.$_POST['email'].'"
                       AND password= "'.$_POST['password'].'"';
         
                $token= DB::instance(DB_NAME)->select_field($q);
        
                #if token is not found throw an error
                if(!$token){  
                       Router::redirect("/users/login/error"); 
                }
                #if token is found then setcookie and reroute to posts
                else{
           
                      setcookie('token',$token,strtotime('+2 week'),'/');
                      Router::redirect('/notes/');
                }
        }  # end if first else   
    }
    # email password to users email
    public function p_emailpassword(){

        # if javascript is disabled this checks if user entered email and password to login
        if (!$_POST['email']) {
           Router::redirect("/users/emailpassword/error"); 
        }
        # proceed with checking if email exists
        else {  
              $q= 'Select user_id         
                    From users            
                    WHERE email="'.$_POST['email'].'"';
         
              $user_id= DB::instance(DB_NAME)->select_field($q);
        
              #email doesnt exists
              if(!$user_id){  
             
                Router::redirect("/users/emailpassword/error1"); 
              }
              # email exists , email the password that is generated using generate_random_string
              else{
                $password=Utils::generate_random_string(8); 
                $new_password=sha1(PASSWORD_SALT.$password);
                $new_modified= Time::now();

                $data=Array('modified'=>$new_modified,
                         'password'=>$new_password             
                         );
                $success= DB::instance(DB_NAME)->update('users',$data,'WHERE user_id=' .$user_id); 
         
            
                $to[]    = Array("name" => $_POST['email'], "email" => $_POST['email']);
                $from    = Array("name" => APP_NAME, "email" => APP_EMAIL);
                $subject = "Password reset message from ".APP_NAME;        
                
                $body = "This is the password: ".$password ;
                # Send email
                $sent = Email::send($to, $from, $subject, $body, FALSE, '');
                # IF EMAIL IS SENT  and password update is successful proceed to login           
                if($sent AND $success)
                    Router::redirect('/users/login');
                # else error out, either send email failed or couldnt update database 
                else
                    Router::redirect('/users/emailpassword/error2');
                }
        }  # end of first else   
    }
    #logout
    public function logout() {
        # if user hasnt logged in redirect to login
        if(!$this->user){
        //Router::redirect('/');
          die('Members Only <a href="/users/login">Login</a>');
        } 
        #set a new token , logout and redirect to index page
        $new_token=sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string()); 
        $data=Array('token'=>$new_token);
        DB::instance(DB_NAME)->update('users',$data,'WHERE user_id=' .$this->user->user_id);
        setcookie('token','',strtotime('-1 year'),'/');
        Router::redirect('/');

            }
    // this function let the user view other users profiles
    public function profile($user_name = NULL) {


        if(!$this->user){
          //Router::redirect('/');
          die('Members Only <a href="/users/login">Login</a>');

        }

        $this->template->content=View::instance('v_users_profile');    
        // $content=View::instance('v_users_profile'); 
        $this->template->title= APP_NAME. " :: Profile :: ".$user_name;
   
        $q= 'Select *         
          From users            
           WHERE email="'.$user_name.'"';
        $user= DB::instance(DB_NAME)->select_row($q);

        $this->template->content->user=$user;
   
        # Render View    
        echo $this->template;

    
    }
    // This function is to edit users profile 
    public function editprofile() {
    // If user is not logged in redirect them to login
        if(!$this->user){
       
               die('Members Only <a href="/users/login">Login</a>');

        }
        # Create a new View instance
        $this->template->content=View::instance('v_users_editprofile');    
        # Page title  
        $this->template->title= APP_NAME. ":: Edit Profile";
        // add required js and css files to be used in the form
        $client_files_head=Array('/js/languages/jquery.validationEngine-en.js',
                             '/js/jquery.validationEngine.js',
                             '/css/validationEngine.jquery.css'
                             );
        $this->template->client_files_head=Utils::load_client_files($client_files_head);


        # Pass information to the view instance
        # Render View  
        echo $this->template;

    }
    # update user profile
    public function update(){
        // If user is not logged in redirect them to login
        if(!$this->user){
            die('Members Only <a href="/users/login">Login</a>');

        }

        $new_modified= Time::now();
        $new_password= sha1(PASSWORD_SALT.$_POST['password']); 
        #$new_first_name=$_POST['first_name']
        # grab data from form  
        $data=Array('modified'=>$new_modified,
                    'password'=>$new_password,
                    'first_name'=>$_POST['first_name'],
                    'last_name'=>$_POST['last_name'],
                    'email'=>$_POST['email']
                    );
        # update database and redirect to posts
        DB::instance(DB_NAME)->update('users',$data,'WHERE user_id=' .$this->user->user_id);
        Router::redirect('/posts/');
        
          
    }


} # end of the class