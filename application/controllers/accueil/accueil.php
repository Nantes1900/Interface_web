<?php

class Accueil extends MY_Controller {

    public function index() {
        $this->accueil();
    }

    public function __construct() {
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->load->library('form_validation');
        $this->load->view('header');
    }

    public function accueil() {

        $this->load->view('accueil/body');

        if (!$this->session->userdata('username')) { //Si l'utilisateur n'est pas loggé, on affiche le formulaire de connexion
            $this->load->view('accueil/login/formulaire_login', array('titre' => $this->lang->line('common_need_login')));
        } else { //Sinon, on affiche les zones restreintes

            $data = array('username' => $this->session->userdata('username'));

            $this->load->view('accueil/welcome');

            $this->load->view('footer');
        }
    }

    public function signin() {
        $this->lang->load('login_signin', $this->language);
        $this->load->library('form_validation');
        
        $this->load->view('accueil/signin/formulaire_signin');
        $this->load->view('footer');
    }
    
    public function not_connected(){
        $this->load->view('accueil/login/formulaire_login',array('titre'=>$this->lang->line('common_do_need_login')));
    }
    
    public function change_lang(){
        $language = $this->input->post('language');
        $languages = ['french','english'];
        if(in_array($language, $languages)){
            $this->session->set_userdata('language',$language);
        }
        redirect('accueil/accueil');
    }
}

/* End of file accueil.php */
/* Location : ./application/controllers/accueil.php */
