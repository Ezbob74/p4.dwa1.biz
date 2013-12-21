<?php 
# This is the tags controller

class tags_controller extends base_controller {
	
    public function __construct() {
        parent::__construct();
        // If user is not logged in redirect them to login
    	if(!$this->user){
            die('Members Only Click here to <a href="/users/login">Login</a>');
    	}
    } 
# View the user's notebooks
    public function index($tag_id){
        

         # Set up the View
        $this->template->content1 = View::instance('v_notes_index1');
       //test
        $this->template->content2 = View::instance('v_notes_index2');

        $this->template->content3 = View::instance('v_tags_index3');


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
        
        $q = 'SELECT *
                    FROM tags
                    WHERE tags.user_id = '.$this->user->user_id.'
                        ORDER BY tags.modified DESC';
                 // echo $q;
                # Run the query, store the results in the variable $notes
        $tags = DB::instance(DB_NAME)->select_rows($q);
       
        $this->template->title   = APP_NAME. " :: Notebooks";

            # Query notes to get the users notes

              

        if (!$tag_id){
                $q = 'SELECT * 
                        FROM tags
                        WHERE tags.user_id = '.$this->user->user_id .'
                        ORDER BY tags.modified DESC
                        LIMIT 1';
            }
        else{
                $q = 'SELECT * 
                    FROM tags
                    WHERE tags.tag_id = '.$tag_id ;
                  //  ORDER BY notes.modified DESC
                  //  LIMIT 1';
            }
                
        # Execute this query with the select_array method
        #
               // echo $q;
        $currenttag = DB::instance(DB_NAME)->select_rows($q);
        # Pass data to the View
       // if( empty( $currentnote ) ){
       // echo "empty";}
        $this->template->content1->tags = $tags;   
        $this->template->content2->newnote = 1;
        $this->template->content3->notebook_id = $notebook_id;
        
        $this->template->content3->currenttag=$currenttag;
        $this->template->content1->notebooks = $notebooks;
        $this->template->content2->notes = $notes;
        
        //test
       

        # Render the View
        # Load JS files
        $client_files_body = Array("/js/jquery.form.js",
                                   "/js/tags_tag.js"
                                    );
        //  $this->template->client_files_head=Utils::load_client_files($client_files_head);
        $this->template->client_files_body = Utils::load_client_files($client_files_body); 



        echo $this->template;

    }
    public function tag($tag_id){
        # looks for urls and make them links , also strip tags    
        
        


                if (!empty($_POST)){
                        $_POST['tag'] = strip_tags($_POST['tag']);
                        $_POST['tag'] = Utils::make_urls_links($_POST['tag']);
                        //$_POST['user_id'] = $this->user->user_id;
                        //$_POST['created'] = Time::now();
                        $_POST['modified'] = Time::now();
                      
                   
                        
                    
                          $where_condition = 'WHERE tag_id = '.$_POST['tag_id'];
                        # insert the notes
                        DB::instance(DB_NAME)->update_row('tags',$_POST,$where_condition);
                }
                else{
                        $_POST['tag_id']=$tag_id;

                }

                $q = "SELECT *
                    FROM tags 
                    WHERE tag_id=".$_POST['tag_id'];

                # Execute the query to get all the users. 
                # Store the result array in the variable $users
                $tag = DB::instance(DB_NAME)->select_row($q);

            
        //$new_note_id = DB::instance(DB_NAME)->insert('notes',$_POST);
        //echo "Your post was added";
        # Set up the view
        $view = View::instance('v_tags_tag');

        # Pass data to the view
        //$view->created     = $_POST['created'];
        $view->tag_name = $tag['name'];
        $view->created = Time::display(Time::now());
        # Render the view
        echo $view;     



       // Router::redirect('/notes/note');   
    }


 # this function is to to view the add posts    
	public function add() {

        $this->template->content1 = View::instance("v_notes_index1");
        $this->template->content2 = View::instance("v_notes_index2");
		$this->template->content3 = View::instance("v_tags_add3");

        $this->template->title= APP_NAME. " :: Add tag ";
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
                    FROM tags
                    WHERE tags.user_id = '.$this->user->user_id.'
                        ORDER BY tags.modified DESC';
                 // echo $q;
                # Run the query, store the results in the variable $notes
        $tags = DB::instance(DB_NAME)->select_rows($q);

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
        $this->template->content1->tags = $tags;        
        $this->template->content2->notes = $notes;
		echo $this->template;

	}

    #    this function is to add notes   
	public function p_add(){
        # looks for urls and make them links , also strip tags    
		$_POST['tag'] = strip_tags($_POST['tag']);
        $_POST['tag'] = Utils::make_urls_links($_POST['tag']);
        $_POST['user_id'] = $this->user->user_id;
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();
        
        //$_POST['notebook_id'] = DB::instance(DB_NAME)->select_field('SELECT notebook_id FROM notebooks 
         //                       WHERE user_id = '.$_POST['user_id'].' ORDER BY 
           //                     created  LIMIT 1');;
        
        # insert the notes
		$new_note_id = DB::instance(DB_NAME)->insert('tags',$_POST);
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

 public function delete($tag_id) {


        //delete the tag      

        $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND tag_id = '.$tag_id;
        DB::instance(DB_NAME)->delete('tags', $where_condition);

       

        
        # Send them back to users own post list
        Router::redirect("/notes/index");
}



}
