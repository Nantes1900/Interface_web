<?php

class Signin extends MY_Controller {

    public function index() {
        $this->check_signin();
    }

    public function __construct() {
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->lang->load('login_signin', $this->language);
        $this->load->model('user_model');
        require_once ('application/models/user.php');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->helper(array('form','security'));
    }

    public function check_signin() {
        if ($this->form_validation->run('signin') == FALSE) {
            $this->layout->views('accueil/body');
            $this->layout->view('accueil/signin/formulaire_signin');
        } else {
            $userdata = array();
            $userdata['username'] = $this->input->post('username');
            $userdata['password'] = $this->input->post('password1');
            $userdata['nom'] = $this->input->post('nom');
            $userdata['prenom'] = $this->input->post('prenom');
            $userdata['email'] = $this->input->post('email');

            $success = $this->user_model->create_user($userdata); //Transmission des données au modèle user_model
            
            if($success){
                $this->confirm_mail($userdata); //to test during deployment as it doesn't work with localhost
                $message = sprintf($this->lang->line('signin_validation'),$userdata['username']);
            } else {
                $message = $this->lang->line('signin_failure');
            }
            $this->layout->add_js('close_message');
            $this->layout->add_js('removepopup');
            $this->layout->views('data_center/success_form', array('success'=>$success, 'message'=>$message));
            $this->layout->view('accueil/login/formulaire_login', array('titre' => $this->lang->line('common_need_login')));
        }
    }

    //this send a confirmation mail with a link to set your userlevel to 1
    public function confirm_mail($userdata) {
        $user = new User($userdata['username']);
        $admins = $this->user_model->get_user_list(10); //get a list of users with level 10
        $admin = $admins[0];
        
        $config = array();        
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        
        $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from('noreply@nantes1900.com', 'email automatique'); //mettre une adresse valide
        $this->email->to($userdata['email']);
        $this->email->subject('[Nantes1900] Noreply : mail de confirmation');
        $msg = '<h1>Bienvenue dans le projet Nantes1900</h1>';
        $msg = $msg . '<p>Votre inscription a été prise en compte, votre pseudo est "' . $userdata['username'] . '" et ';
        $msg = $msg . 'votre mot de passe est "' . $userdata['password'] . '", le mot de passe ne vous sera jamais demandé, ne le communiquez pas.</p>';
        $msg = $msg . '<p>Enfin, pour pouvoir vous connectez, vous devez valider votre compte à l\'adresse suivante : ';
        $msg = $msg . anchor('accueil/signin/confirmation/' . urlencode($this->encrypt->encode($userdata['username']))) . '</p>';
        $msg = $msg . '<p>En cas de problème, essayez de contacter l\'administrateur principal à l\'adresse : '.$admin->get_email().'</p>';
        $this->email->message($msg);

        $this->email->send();
    }

    //available through link given in mail
    public function confirmation($cryptedUsername = null) {
        
        $username = $this->encrypt->decode(urldecode($cryptedUsername));
        $this->layout->add_js('close_message');
        $this->layout->add_js('removepopup');
            
        if ($this->user_model->check_ifuserexists($username) != 0) {
            $user = new User($username);
            //checking that user is new unconfirmed user
            if ($user->get_userLevel() == 0 && $user->get_contribution() < 1) {
                $user->set_userLevel(1);
                $user->save();
                    $this->layout->view('accueil/login/formulaire_login', 
                                        array('titre' => sprintf($this->lang->line('signin_validation_success'),
                                                                    $username)));
            } else {
                    $this->layout->view('accueil/login/formulaire_login', 
                                    array('titre' => $this->lang->line('signin_validation_fail_already')));
            }
        } else {
            $this->layout->view('accueil/login/formulaire_login', 
                                array('titre' => $this->lang->line('signin_validation_fail_unknown')));
        }
    }

    public function check_existence() { //callback function of form_validation that check if a username already exists
        $userName = $this->input->post('username');
        if ($this->user_model->check_ifuserexists($userName) == 0) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_existence', 
                                    sprintf($this->lang->line('signin_check_existence'), $userName));
            return FALSE;
        }
    }

    public function check_nospace() {
        $userName = $this->input->post('username');
        if (count(explode(' ', $userName)) > 1) {
            $this->form_validation->set_message('check_nospace', $this->lang->line('signin_check_nospace'));
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_unique_mail($mail) {
        $userList = $this->user_model->get_user_list(null, 'username', 'asc', 'email', $mail);
        if (!isset($userList['0'])) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_unique_mail', $this->lang->line('signin_check_unique_mail'));
            return FALSE;
        }
    }

}

/* End of file signin.php */
/* Location : ./application/controllers/signin.php */
