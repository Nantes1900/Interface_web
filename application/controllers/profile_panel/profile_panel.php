<?php

/**
 * profile_panel class
 * 
 * Accessible à tous les utilisateurs connectés
 * Menu pour changer ses informations
 * 
 * @author LUCAS Paul-Yves
 * 
 */
class Profile_panel extends MY_Controller {
    public function index(){
        $this->profile_panel();
    }
    
    public function __construct() {

        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->lang->load('user', $this->language);
        $this->load->model('user_model');
        require ('application/models/user.php');
        $this->load->library('form_validation');
        $this->load->view('header');
        $this->load->helper('security'); //to hash passwords
        if (!$this->session->userdata('username')) {
            redirect('accueil/accueil/not_connected/', 'refresh');
        }
    }

    public function profile_panel(){ //render the profile_panel page
        $data = array();
        $userName = $this->session->userdata('username');
        $currentUser = new User($userName);
        $data['user'] = $currentUser;
        $this->load->view('profile_panel/profile_panel', $data);
        $this->load->view('footer');
    }
    
    public function change_profile(){ //change some of the user information
        
        if($this->form_validation->run('change_profile')==TRUE){
            $userName = $this->session->userdata('username');
            $currentUser = new User($userName);
            
            $currentUser->set_firstName($this->input->post('firstName'));
            $currentUser->set_name($this->input->post('name'));
            $currentUser->set_adress($this->input->post('theAdress'));
            $currentUser->set_phoneNumber($this->input->post('phoneNumber'));
            $currentUser->set_job($this->input->post('job'));
            $currentUser->set_email($this->input->post('email'));
            
            $newPassword = $this->input->post('newPW');
            if(!empty($newPassword)){
                $currentUser->set_hashedPassword(do_hash($newPassword));
            }
            $currentUser->save();
            redirect('profile_panel/profile_panel', 'refresh');
        }
                            
            $this->profile_panel();
            
    }
    
    public function change_lang(){
        $language = $this->input->post('language');
        $languages = ['french','english'];
        if(in_array($language, $languages)){
            $this->session->set_userdata('language',$language);
        }
        redirect('profile_panel/profile_panel');
    }
    
    public function check_password(){ //callback function of form_validation that checks password
        $userName = $this->session->userdata('username');
        $currentUser = new User($userName);
        $password = $this->input->post('password');
        $hashedPW = do_hash($password);
        if ( $hashedPW == $currentUser->get_hashedPassword() ){
            return TRUE;
        }else{
            $this->form_validation->set_message('check_password', 'Mot de passe invalide');
            return FALSE;
        }
    }
    
    public function check_unique_mail(){
            $mail = $this->input->post('email');
            $userName = $this->session->userdata('username');
            $currentUser = new User($userName);
            $userList = $this->user_model->get_user_list(null,'username','asc','email',$mail);
            if(!isset($userList['0']) || $userList['0']->get_email()==$currentUser->get_email() ){
                return TRUE;
            } else {
                $this->form_validation->set_message('check_unique_mail', 'L\'adresse mail : '.$mail.' est déjà prise');
                return FALSE;
            }  
    }
}

/* End of file profile_panel.php */
/* Location : ./application/controllers/profile_panel/profile_panel.php */