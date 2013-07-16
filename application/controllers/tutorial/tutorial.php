<?php

/**
 * Controller used to display the tutorial main page
 * and the differents parts of tutorial
 *
 * @author paulyves
 */
class Tutorial extends MY_Controller {
    
    public function __construct() {
	
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->load->library('form_validation');
        $this->load->view('header');
        //security : we check that there is an user
        if(!$this->session->userdata('username')){
            redirect('accueil/accueil/not_connected/', 'refresh');
        }
    } 
    
    //render the tutorial main menu
    public function index(){
        $this->load->view('tutorial/tuto_main');
        $this->load->view('tutorial/section_nav_bar', array('section'=>'null'));
    }
    
    //return a list of available sections for user
    //it depends on userLevel
    public function get_section_list(){
        $list = array('data_center');
        if($this->session->userdata('user_level') >= 5){
            $list[] = 'moderation_center'; 
        }
        $list[] = 'view_data'; 
        $list[] = 'profile_panel'; 
        if($this->session->userdata('user_level') >= 9){
            $list[] = 'admin_panel'; 
        }
        $list[] = 'contact_panel'; 
        $list[] = 'download';
        return $list;
    }
    
    //call the controller's method corresponding to the next section
    public function next($currentSection){
        $sections = $this->get_section_list();
        $key = array_search($currentSection, $sections);
        
        if (isset($sections[$key+1])){
            $this->$sections[$key+1]();
        }else {
            $this->$currentSection();
        }
    }
    
    //call the controller's method corresponding to the previous section
    public function previous($currentSection){
        $sections = $this->get_section_list();
        $key = array_search($currentSection, $sections);
        
        if (isset($sections[$key-1])){
            $this->$sections[$key-1]();
        }else {
            $this->$currentSection();
        }
    }
    
    public function data_center(){
        $this->load->view('tutorial/tuto_h1');
        $this->load->view('tutorial/section_nav_bar', array('section'=>'data_center'));
        $this->load->view('tutorial/data_center');
        $this->load->view('footer');
    }
    
    public function moderation_center(){
        $this->load->view('tutorial/tuto_h1');
        $this->load->view('tutorial/section_nav_bar', array('section'=>'moderation_center'));
        $this->load->view('tutorial/moderation_center');
        $this->load->view('footer');
    }
    
    public function view_data(){
        $this->load->view('tutorial/tuto_h1');
        $this->load->view('tutorial/section_nav_bar', array('section'=>'view_data'));
        $this->load->view('tutorial/view_data');
        $this->load->view('footer');
    }
    
    public function profile_panel(){
        $this->load->view('tutorial/tuto_h1');
        $this->load->view('tutorial/section_nav_bar', array('section'=>'profile_panel'));
        $this->load->view('tutorial/profile_panel');
        $this->load->view('footer');
    }
    
    public function admin_panel(){
        $this->load->view('tutorial/tuto_h1');
        $this->load->view('tutorial/section_nav_bar', array('section'=>'admin_panel'));
        $this->load->view('tutorial/admin_panel');
        $this->load->view('footer');
    }
    
    public function contact_panel(){
        $this->load->view('tutorial/tuto_h1');
        $this->load->view('tutorial/section_nav_bar', array('section'=>'contact_panel'));
        $this->load->view('tutorial/contact_panel');
        $this->load->view('footer');
    }
    
    public function download(){
        $this->load->view('tutorial/tuto_h1');
        $this->load->view('tutorial/section_nav_bar', array('section'=>'download'));
        $this->load->view('tutorial/download');
        $this->load->view('footer');
    }
}

/* End of file tutorial.php */
/* Location : ./application/models/tutorial.php */

