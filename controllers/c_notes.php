<?php 
# This is the notes controller

class notes_controller extends base_controller {
	
    public function __construct() {
        parent::__construct();
        // If user is not logged in redirect them to login
    	if(!$this->user){
            die('Members Only Click here to <a href="/users/login">Login</a>');
    	}
    } 
    # View the user's notes and is the main page which most pages redirect to it 
    public function index($note_id=NULL){
        

         # Set up the View
        // left column
        $this->template->content1 = View::instance('v_notes_index1');
        // middle column
        $this->template->content2 = View::instance('v_notes_index2');
        // right column
        $this->template->content3 = View::instance('v_notes_index3');

        // all users notes
        $q = 'SELECT *
                    FROM notes
                    WHERE notes.user_id = '.$this->user->user_id.'
                        ORDER BY notes.modified DESC';
                 
                # Run the query, store the results in the variable $notes
        $notes = DB::instance(DB_NAME)->select_rows($q);
        
        // all users notebooks        
        $q = 'SELECT *
                    FROM notebooks
                    WHERE notebooks.user_id = '.$this->user->user_id.'
                        ORDER BY notebooks.modified DESC';
                 // echo $q;
                # Run the query, store the results in the variable $notebooks
        $notebooks = DB::instance(DB_NAME)->select_rows($q);
       
        // all tags that belong to the user
        $q = 'SELECT *
                    FROM tags
                    WHERE tags.user_id = '.$this->user->user_id.'
                        ORDER BY tags.modified DESC';
                
                # Run the query, store the results in the variable $tags
        $tags = DB::instance(DB_NAME)->select_rows($q);
       
        

        // set the title
        $this->template->title   = APP_NAME. " :: All Notes";

        // if note_id is not set get the last note that was modified   

        if (!$note_id){
               
            // first get  a note_id if its missing
            // this is used if no note_id is passed
                $q = 'SELECT note_id 
                        FROM notes
                        WHERE notes.user_id = '.$this->user->user_id .'
                        ORDER BY notes.modified DESC
                        LIMIT 1';
                //get note_id
                $note_id = DB::instance(DB_NAME)->select_field($q);
                // get the whole row to display
                $q = 'SELECT * 
                        FROM notes
                        WHERE notes.user_id = '.$this->user->user_id .'
                        ORDER BY notes.modified DESC
                        LIMIT 1';
                     
        }

        else{
                // if thers is a note_id specified use that to get a row
                $q = 'SELECT * 
                    FROM notes
                    WHERE notes.note_id = '.$note_id ;
               
        }
        
        // get tags to display in the page

        $q1 = 'SELECT T2.tag_id as Tag_id
                        FROM tag_note T2
                        INNER JOIN tags T1 ON T2.tag_id = T1.tag_id
                        WHERE T1.user_id = '.$this->user->user_id .'
                        AND T2.note_id='.$note_id; 
                        

                       
        # Get current note
        #
            
        $currentnote = DB::instance(DB_NAME)->select_rows($q);

        if ($note_id==NULL){

       // No need to display a message here
       // error checking          
        }

        else {
           $tag_note = DB::instance(DB_NAME)->select_rows($q1);   
       }

        $tag_note = array_map('current', $tag_note);

        // this is for left column
        $this->template->content1->notebooks = $notebooks;
        $this->template->content1->tags = $tags;
        // this is for middle column
        $this->template->content2->notes = $notes;

        // This is for the right column which includes tags, current note, notebooks, and tags related to notes
        $this->template->content3->tags = $tags;
        $this->template->content3->note_id=$note_id;
        $this->template->content3->currentnote=$currentnote;
        $this->template->content3->notebooks = $notebooks;
        $this->template->content3->tag_note = $tag_note;
        

       
        $client_files_body = Array("/js/jquery.form.js",
                                   "/js/notes_note.js"
                                    );
        $this->template->client_files_body = Utils::load_client_files($client_files_body); 



        echo $this->template;

    }
    // this receives the POST from the form
    public function note($note_id=NULL){
    
        # looks for urls and make them links , also strip tags    
        

        if (!empty($_POST)){
                // get the post array ready
                $_POST['body'] = strip_tags($_POST['body']);
                $_POST['body'] = Utils::make_urls_links($_POST['body']);
                $_POST['modified'] = Time::now();
                $_POST['title'] = strip_tags($_POST['title']);
                $_POST['title'] = Utils::make_urls_links($_POST['title']);
                // use this array to submit update row to database
                // as the original has a few more forms objects not in the database          
                $_POST1 = array(
                        'body' => $_POST['body'],
                        'modified'=> $_POST['modified'],
                        'title'=>  $_POST['title'],
                        'note_id' => $_POST['note_id'],
                         'notebook_id' => $_POST['notebook_id']
                        );

                $where_condition = 'WHERE note_id = '.$_POST['note_id'];
                      # insert the notes
                DB::instance(DB_NAME)->update_row('notes',$_POST1,$where_condition);

                // delete all existing tags_notes for the note        
                DB::instance(DB_NAME)->delete('tag_note',$where_condition);
                        
                //construct an array  
                
                $tagsarray = $_POST['tag_id'];    
                           
                // send the data to an array           
                         
                foreach ($tagsarray as $value){
                         
                        $data[]=  Array('tag_id' => $value, 'note_id' => $_POST['note_id'] , 'modified' => $_POST['modified'] );
                       } 
                // if it is not empty then insert them in the tag_note database           
                if(!empty($data)){   
                        DB::instance(DB_NAME)->insert_rows('tag_note',$data);
                          }

                }
                //if POST is empty get the note_id from the function
        else{
                $_POST['note_id']=$note_id;

        }


        $q = "SELECT *
              FROM notes 
              WHERE note_id=".$_POST['note_id'];

        # Execute the query to get all the notes. 
        # Store the result array in the variable $note
        $note = DB::instance(DB_NAME)->select_row($q);

            
        # Set up the view
        $view = View::instance('v_notes_note');

        # Pass data to the view
        $view->note_body = $note['body'];
        $view->created = Time::display(Time::now());
        # Render the view
        echo $view;     



       // Router::redirect('/notes/note');   
    }


    # this function is to to view the add notes    
	public function add() {

        //setup the three column
		$this->template->content1 = View::instance("v_notes_index1");
        $this->template->content2 = View::instance("v_notes_index2");
        $this->template->content3 = View::instance("v_notes_add3");

        $this->template->title= APP_NAME. " :: Add Note ";
        // add required js and css files to be used in the form
        $client_files_head=Array('/js/languages/jquery.validationEngine-en.js',
                             '/js/jquery.validationEngine.js',
                             '/css/validationEngine.jquery.css'
                             );
        # Load JS files
         $q = 'SELECT *
                    FROM notes
                    WHERE notes.user_id = '.$this->user->user_id.'
                        ORDER BY notes.modified DESC';
                 // echo $q;
                # Run the query, store the results in the variable 
        $notes = DB::instance(DB_NAME)->select_rows($q);
        
        $q = 'SELECT *
                    FROM tags
                    WHERE tags.user_id = '.$this->user->user_id.'
                        ORDER BY tags.modified DESC';
                 // echo $q;
                # Run the query, store the results in the variable $notes
        $tags = DB::instance(DB_NAME)->select_rows($q);
        
        $q = 'SELECT *
                    FROM notebooks
                    WHERE notebooks.user_id = '.$this->user->user_id.'
                        ORDER BY notebooks.modified DESC';
                 // echo $q;
                # Run the query, store the results in the variable 
        $notebooks = DB::instance(DB_NAME)->select_rows($q);


        $client_files_body = Array("/js/jquery.form.js",
                            "/js/notes_add.js",
                            "js/notes_validation.js"
                            );
       $this->template->client_files_head=Utils::load_client_files($client_files_head);
        $this->template->client_files_body = Utils::load_client_files($client_files_body); 

        $this->template->content2->notes = $notes;
		$this->template->content1->notebooks = $notebooks;
        $this->template->content1->tags = $tags;
        echo $this->template;

	}

    #    this function is to add notes   
	public function p_add(){
        # looks for urls and make them links , also strip tags    
		$_POST['body'] = strip_tags($_POST['body']);
        $_POST['body'] = Utils::make_urls_links($_POST['body']);
        $_POST['user_id'] = $this->user->user_id;
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();
        $_POST['title'] = strip_tags($_POST['title']);
        $_POST['title'] = Utils::make_urls_links($_POST['title']);
        $_POST['notebook_id'] = DB::instance(DB_NAME)->select_field('SELECT notebook_id FROM notebooks 
                                WHERE user_id = '.$_POST['user_id'].' ORDER BY 
                                created  LIMIT 1');;
        
        # insert the notes
		$new_note_id = DB::instance(DB_NAME)->insert('notes',$_POST);
	  

         Router::redirect('/notes/index');   
	}
    


 # delete notes
    public function delete($note_id) {

        # Delete users own notes only
        $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND note_id = '.$note_id;
        DB::instance(DB_NAME)->delete('notes', $where_condition);

        # Send them back to users own notes list
        Router::redirect("/notes/");

}

}