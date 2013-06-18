<?php

/**
 * This class manage the page where user can download things
 * for instance, csv templates
 *
 * @author paulyves
 */
class Download extends CI_Controller{
    public function __construct() {
        parent::__construct();
        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->load->helper('download');
        $this->load->library('form_validation');
	$this->load->view('header');
    }
    
    public function index(){
        if($this->session->userdata('username')){
            $this->download_page();
        }else{
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }
    }
    
    private function download_page(){
        $this->load->view('download/download');
        $this->load->view('footer');
    }
    
    public function do_download(){
        if($this->session->userdata('username')){
            $fileName = $this->input->post('fileName');
            $data = file_get_contents(base_url().'assets/utils/'.$fileName); //we prepare the file
            force_download($fileName, $data); //we download the file
            $this->download_page();
        }else{
            $this->load->view('accueil/login/formulaire_login',array('titre'=>'Vous n\'êtes pas connecté. Veuillez vous connecter :'));
        }
    }
}

/* End of file download.php */
/* Location : ./application/models/download.php */

