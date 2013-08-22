<?php

class Login extends MY_Controller {

    public function index() {
        $this->check_login();
    }

    public function __construct() {
        parent::__construct();
            
        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->lang->load('login_signin', $this->language);
        $this->load->library('form_validation');
        $this->load->helper(array('form'));
        require_once ('application/models/user.php');
        $this->load->model('user_model');
    }

    public function check_login() {

        if ($this->form_validation->run('login') == FALSE) {
            $this->layout->views('accueil/body');
            $this->layout->view('accueil/login/formulaire_login', array('titre' => $this->lang->line('common_need_login')));
        } else {
            //La connexion ayant été jugée légitime, on va maintenant la créer
            $this->login($this->input->post('username'));
        }
    }

    public function check_login_info() {

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->load->model('user_model');

        $check = $this->user_model->check_login_info($username, $password);

        if ($check['0']) {
            return $check['0'];
        } elseif ($check['1'] == 'username') {
            $this->form_validation->set_message('check_login_info', $this->lang->line('login_unknown_user'));
            return FALSE;
        } elseif ($check['1'] == 'password') {
            $this->form_validation->set_message('check_login_info', $this->lang->line('login_invalid_password'));
            return FALSE;
        } elseif ($check['1'] == 'unvalid user') {
            $this->form_validation->set_message('check_login_info', $this->lang->line('login_unconfirmed_user'));
            return FALSE;
        } elseif ($check['1'] == 'banned user') {
            $this->form_validation->set_message('check_login_info', $this->lang->line('login_banned_user'));
            return FALSE;
        }
    }

    private function login($username) {

        $data = array('username' => $username,
            'user_level' => $this->user_model->get_user_level($username));

        $this->session->set_userdata('username', $data['username']);
        $this->session->set_userdata('user_level', $data['user_level']);
        $this->layout->view('accueil/login/success_login', $data);
        redirect('accueil/', 'refresh');
    }

    public function logout() {

        $this->session->sess_destroy();
        $this->layout->view('accueil/login/success_logout');
        redirect('accueil/', 'refresh');
    }
    
    public function lostpw(){
        if ($this->form_validation->run('lost_password') == FALSE) {
            redirect('accueil/', 'refresh');
        } else {
            $user = new User($this->input->post('username'));
            
            $user->set_lostpw('t');
            $user->save();
            
            //email sending
            $this->load->library('encrypt');
            $config = array();        
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['wordwrap'] = TRUE;

            $this->load->library('email');
            $this->email->initialize($config);

            $this->email->from('noreply@nantes1900.com', 'email automatique'); //mettre une adresse valide
            $this->email->to($user->get_email());
            $this->email->subject('[Nantes1900] Noreply : réinitialisation de mot de passe');
            $msg = '<h1>Nantes1900</h1>';
            $msg = $msg . '<p>Votre demande de réinitialisation de mot de passe a été prise en compte';
            $msg = $msg . '<p>Pour entrer un nouveau mot de passe, rendez vous au lien suivant : ';
            $msg = $msg . anchor('accueil/login/set_new_password/' . urlencode($this->encrypt->encode($user->get_userName()))) . '</p>';
            $this->email->message($msg);

            $this->email->send();
            
            $this->layout->views('accueil/body');
            $this->layout->views('accueil/login/formulaire_login', array('titre' => $this->lang->line('common_need_login')));
            $this->layout->add_js('close_message');
            $messageData = array('success'=>TRUE, 'message'=>'un email vous a été envoyé pour changer votre mot de passe');
            $this->layout->view('data_center/success_form', $messageData);
        }
    }
    
    public function set_new_password($cryptedUsername=null){
        $this->load->library('encrypt');
        $this->load->helper('security');
        
        $username = $this->encrypt->decode(urldecode($cryptedUsername));
        
        $user = new User($username);
        if((!isset($user))||$user->get_lostpw()!='t'){
            redirect('accueil');
        }
        if ($this->form_validation->run('set_new_password') == FALSE) {
            $this->layout->view('accueil/pw_recovery', array('cryptedUsername'=>$cryptedUsername, 'username'=>$username));
        } else {
            $user->set_hashedPassword(do_hash($this->input->post('password1')));
            $user->set_lostpw('f');
            $user->save();
            
            $this->layout->views('accueil/body');
            $this->layout->views('accueil/login/formulaire_login', array('titre' => $this->lang->line('common_need_login')));
            $this->layout->add_js('close_message');
            $messageData = array('success'=>TRUE, 'message'=>'Votre nouveau mot de passe a été correctement enregistré');
            $this->layout->view('data_center/success_form', $messageData);
        }
    }
    
    //form validation callback functions for password loss
    public function check_username($username){
        $exist = $this->user_model->check_ifuserexists($username);
        if($exist!=0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function check_email($email){
        $user = new User($this->input->post('username'));
        if($email==$user->get_email()){
            return TRUE;
        }else{
            return FALSE;
        }
    }

}

/* End of file login.php */
/* Location : ./application/controllers/login.php */
