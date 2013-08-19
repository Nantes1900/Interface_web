<?php

class Accueil extends MY_Controller {

    public function index() {
        $this->accueil();
    }

    public function __construct() {
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->load->library('form_validation');
    }

    public function accueil() {
        
        $this->layout->views('accueil/body');

        if (!$this->session->userdata('username')) { //Si l'utilisateur n'est pas loggé, on affiche le formulaire de connexion
            $this->layout->add_js('removepopup');
            $this->layout->view('accueil/login/formulaire_login', array('titre' => $this->lang->line('common_need_login')));
        } else { //Sinon, on affiche les zones restreintes

            $data = array('username' => $this->session->userdata('username'));

            $this->layout->view('accueil/welcome');

        }
    }

    public function signin() {
        $this->lang->load('login_signin', $this->language);
        $this->load->library('form_validation');
        
        $this->layout->view('accueil/signin/formulaire_signin');
    }
    
    public function not_connected(){
        $this->layout->view('accueil/login/formulaire_login',array('titre'=>$this->lang->line('common_do_need_login')));
    }
    
    public function change_lang(){
        $language = $this->input->post('language');
        $languages = array('french','english');
        if(in_array($language, $languages)){
            $this->session->set_userdata('language',$language);
        }
        redirect('accueil/accueil');
    }
}

/* End of file accueil.php */
/* Location : ./application/controllers/accueil.php */
