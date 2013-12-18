<?php 
# This is the notes controller

class notebooks_controller extends base_controller {
	
    public function __construct() {
        parent::__construct();
        // If user is not logged in redirect them to login
    	if(!$this->user){
            die('Members Only Click here to <a href="/users/login">Login</a>');
    	}
    } 
# View the user's notebooks
    public function index($notebook_id){
        

         # Set up the View
        $this->template->content1 = View::instance('v_notes_index1');
       //test
        $this->template->content2 = View::instance('v_notes_index2');

        $this->template->content3 = View::instance('v_notebooks_index3');


        $q = 'SELECT *
                    FROM notes
                    WHERE notes.user_id = '.$this->user->user_id.'
                        ORDER BY notes.modified DESC';
                 // echo $q;
                # Run the query, store the results in the variable $notes
        $notes = DB::instance(DB_NAME)->select_rows($q);
                
        $q = 'SELECT *
                    FROM notebooks
                    WHERE notebooks.user_id = '.$this->user->user_id.'
                        ORDER BY notebooks.modified DESC';
                 // echo $q;
                # Run the query, store the results in the variable $notes
        $notebooks = DB::instance(DB_NAME)->select_rows($q);
        
       
            $this->template->title   = APP_NAME. " :: Notebooks";

            # Query notes to get the users notes

              

            if (!$notebook_id){
                $q = 'SELECT * 
                        FROM notebooks
                        WHERE notes.user_id = '.$this->user->user_id .'
                        ORDER BY notebooks.modified DESC
                        LIMIT 1';
            }
            else{
                $q = 'SELECT * 
                    FROM notebooks
                    WHERE notebooks.notebook_id = '.$notebook_id ;
                  //  ORDER BY notes.modified DESC
                  //  LIMIT 1';
            }
                
        # Execute this query with the select_array method
        #
               // echo $q;
            $currentnotebook = DB::instance(DB_NAME)->select_rows($q);
        # Pass data to the View
       // if( empty( $currentnote ) ){
       // echo "empty";}
        $this->template->content2->newnote = 1;
        $this->template->content3->notebook_id = $notebook_id;
        
        $this->template->content3->currentnotebook=$currentnotebook;
        $this->template->content1->notebooks = $notebooks;
        $this->template->content2->notes = $notes;
        
        //test
       

        # Render the View
        # Load JS files
        $client_files_body = Array("/js/jquery.form.js",
                                   "/js/notebooks_note.js"
                                    );
        //  $this->template->client_files_head=Utils::load_client_files($client_files_head);
        $this->template->client_files_body = Utils::load_client_files($client_files_body); 



        echo $this->template;

    }
    public function notebook($notebook_id){
        # looks for urls and make them links , also strip tags    
        
        


                if (!empty($_POST)){
                        $_POST['name'] = strip_tags($_POST['name']);
                        $_POST['name'] = Utils::make_urls_links($_POST['name']);
                        //$_POST['user_id'] = $this->user->user_id;
                        //$_POST['created'] = Time::now();
                        $_POST['modified'] = Time::now();
                      
                   
                        
                    
                          $where_condition = 'WHERE notebook_id = '.$_POST['notebook_id'];
                        # insert the notes
                        DB::instance(DB_NAME)->update_row('notebooks',$_POST,$where_condition);
                }
                else{
                        $_POST['notebook_id']=$notebook_id;

                }

                $q = "SELECT *
                    FROM notebooks 
                    WHERE notebook_id=".$_POST['notebook_id'];

                # Execute the query to get all the users. 
                # Store the result array in the variable $users
                $notebook = DB::instance(DB_NAME)->select_row($q);

            
        //$new_note_id = DB::instance(DB_NAME)->insert('notes',$_POST);
        //echo "Your post was added";
        # Set up the view
        $view = View::instance('v_notebooks_note');

        # Pass data to the view
        //$view->created     = $_POST['created'];
        $view->note_body = $notebook['name'];
        $view->created = Time::display(Time::now());
        # Render the view
        echo $view;     



       // Router::redirect('/notes/note');   
    }


 # this function is to to view the add posts    
	public function add() {

        $this->template->content1 = View::instance("v_notes_index1");
        $this->template->content2 = View::instance("v_notes_index2");
		$this->template->content3 = View::instance("v_notebooks_add3");

        $this->template->title= APP_NAME. " :: Add Notebook ";
        // add required js and css files to be used in the form
     //   $client_files_head=Array('/js/languages/jquery.validationEngine-en.js',
       //                      '/js/jquery.validationEngine.js',
        //                     '/css/validationEngine.jquery.css'
         //                    );
        # Load JS files
         $q = 'SELECT *
                    FROM notebooks
                    WHERE notebooks.user_id = '.$this->user->user_id.'
                        ORDER BY notebooks.modified DESC';
                 // echo $q;
                # Run the query, store the results in the variable $notes
        $notebooks = DB::instance(DB_NAME)->select_rows($q);


        $q = 'SELECT *
                    FROM notes
                    WHERE notes.user_id = '.$this->user->user_id.'
                        ORDER BY notes.modified DESC';
                 // echo $q;
                # Run the query, store the results in the variable $notes
        $notes = DB::instance(DB_NAME)->select_rows($q);


        $client_files_body = Array("/js/jquery.form.js",
        			          "/js/notes_add.js"
                            );
      //  $this->template->client_files_head=Utils::load_client_files($client_files_head);
        $this->template->client_files_body = Utils::load_client_files($client_files_body); 

        $this->template->content1->notebooks = $notebooks;        
        $this->template->content2->notes = $notes;
		echo $this->template;

	}

    #    this function is to add notes   
	public function p_add(){
        # looks for urls and make them links , also strip tags    
		$_POST['name'] = strip_tags($_POST['name']);
        $_POST['name'] = Utils::make_urls_links($_POST['name']);
        $_POST['user_id'] = $this->user->user_id;
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();
        
        //$_POST['notebook_id'] = DB::instance(DB_NAME)->select_field('SELECT notebook_id FROM notebooks 
         //                       WHERE user_id = '.$_POST['user_id'].' ORDER BY 
           //                     created  LIMIT 1');;
        
        # insert the notes
		$new_note_id = DB::instance(DB_NAME)->insert('notebooks',$_POST);
	    //echo "Your post was added";
        # Set up the view
       // $view = View::instance('v_notes_p_add');

        # Pass data to the view
        // $view->created = Time::display(Time::now());
        //$view->new_note_id = $new_note_id;

        # Render the view
        //echo $view;     



         Router::redirect('/notes/');   
	}

 public function delete($notebook_id) {

        # Find the second next notebook and move all notes to this notebook, 
        # if it is the last notebook then do not delete the nootebook
        $q = 'SELECT count(*) 
              FROM notebooks
              WHERE notebooks.user_id = '.$this->user->user_id .'
              ORDER BY notebooks.modified DESC
                        ';

        if (DB::instance(DB_NAME)->select_field($q)>1){
                    $q = 'SELECT notebook_id
                        FROM notebooks
                        WHERE notebooks.user_id = '.$this->user->user_id .'
                        AND notebooks.notebook_id != '.$notebook_id .'
                        ORDER BY notebooks.modified 
                        LIMIT 1                    ';
                      $the_other_notebook = DB::instance(DB_NAME)->select_field($q);
                      // change all notes to this other notebook
                    $q = ' UPDATE notes SET notebook_id='.$the_other_notebook.'
                           WHERE notebook_id='.$notebook_id;
                     DB::instance(DB_NAME)->query($q);      

        //delete the notebook       

        $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND notebook_id = '.$notebook_id;
        DB::instance(DB_NAME)->delete('notebooks', $where_condition);}

        else
        {

            // This is the last notebook and it cant be deleted
        }

        
        # Send them back to users own post list
        Router::redirect("/notes/index");

}


}
