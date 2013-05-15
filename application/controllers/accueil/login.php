<?php

class Login extends CI_Controller {

	public function index()
	{
		$this->check_login();
	}

	public function __construct()
	{
		parent::__construct();

		//Ce code sera executé charque fois que ce contrôleur sera appelé
		
		$this->load->library('form_validation');
		$this->load->helper(array('form'));
		$this->load->view('header');
	}
	
	public function check_login()
	{
            
		if ($this->form_validation->run('login') == FALSE)
		{
                    $this->load->view('accueil/body');
                    $this->load->view('accueil/login/formulaire_login',array('titre'=>'Connectez-vous :'));
                    $this->load->view('footer');
		}
		else
		{
                    //La connexion ayant été jugée légitime, on va maintenant la créer
                    $this->login($this->input->post('username'));
		}

	}
        
        public function check_login_info()
        {
            
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $this->load->model('user_model','login');
            
            $check = $this->login->check_login_info($username,$password);

            if ( $check['0'] )
            {
                return $check['0'];
            }
            elseif ( $check['1'] == 'username')
            {
                $this->form_validation->set_message('check_login_info', 'Utilisateur inexistant');
                return FALSE;
            }
            elseif ( $check['1'] == 'password')
            {
                $this->form_validation->set_message('check_login_info', 'Mot de passe invalide');
                return FALSE;
            }
        }

	private function login($username)
	{
            
            $data = array('username' => $username,
                          'user_level' => $this->login->get_user_level($username));
            
            $this->session->set_userdata('username', $data['username']);
            $this->session->set_userdata('user_level', $data['user_level']);
            $this->load->view('accueil/login/success_login', $data);
            redirect('accueil/','refresh');

	}

	public function logout()
	{

            $this->session->sess_destroy();
            $this->load->view('accueil/login/success_logout');            
            redirect('accueil/','refresh');

	}


}

/* End of file login.php */
/* Location : ./application/controllers/login.php */
