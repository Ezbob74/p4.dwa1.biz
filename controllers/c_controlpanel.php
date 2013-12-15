<?php
class controlpanel_controller extends base_controller {
        
    public function index() {
    
        # Setup view
            $this->template->content = View::instance('v_controlpanel_index');
            $this->template->title   = "Control Panel";
    
        # JavaScript files
            $client_files_body = Array(
                '/js/notes_controlpanel.js');
            $this->template->client_files_body = Utils::load_client_files($client_files_body);
    
        # Render template
            echo $this->template;
    }
    
    
    public function refresh() {

        $data = Array();
        
        # Find out how many posts there are
        $q = "SELECT count(note_id) FROM notes";
       $data['note_count'] = DB::instance(DB_NAME)->select_field($q);
        
        # Find out how many users there are
        $q = "SELECT count(user_id) FROM users";
        $data['usercount'] = DB::instance(DB_NAME)->select_field($q);
        
        # Find out when the last post was created
        $q = "SELECT created FROM notes ORDER BY created DESC LIMIT 1";
     //   $data['most_recent_note'] = Time::display(DB::instance(DB_NAME)->select_field($q));
        
        # Send back json results to the JS, formatted in json
       echo json_encode($data);
       
    
    }
        
}


