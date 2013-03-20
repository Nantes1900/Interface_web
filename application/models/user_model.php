<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		//Connexion à la base de données
		$this->load->database();

	}


        //Vérification des données de connexion de l'utilisateur
	public function check_login_info($username,$submitted_password)
	{
		
		//Chargement de la gestion de hashage de mot de passe
		$this->load->helper('security');
                
                //On commence par vérifier si le nom d'utilisateur spécifié existe
                
                if ($this->check_ifuserexists($username) == 0)
                {
                    return array(false, 'username'); //L'utilisateur n'existe pas
                }
                else
                {
                    //On va maintenant vérifier si le mot de passe correspond à celui stocké dans la BDD
                    //Création de la requête
                    $this->db->select('username, password');
                    $this->db->from('users');
                    $this->db->where('username', $username);
                    $query = $this->db->get(); //Exécution

                    $result = $query->result_array(); //Récupération des résultats
                    $stored_password = $result['0']['password']; //On isole le mot de passe

                    if (do_hash($submitted_password) != $stored_password)
                    {
			return array(false, 'password'); //Le mot de passe ne correspond pas
                    }
                    else
                    {   
			return array(True); //La connexion est légitime
                    }
                }	
	}
        
        //Ajout d'un utilisateur à la BDD
        public function create_user($userdata)
	{

		//Chargement de la gestion de hashage de mot de passe
		$this->load->helper('security');

		//Création de la requête
		$this->db->set('username', $userdata['username']);
		$this->db->set('password', do_hash($userdata['password']));
		$this->db->set('user_level', 1); //Par défaut, l'utilisateur possède les droits les plus bas
		$this->db->set('timestamp', now());
		$this->db->set('nom', $userdata['nom']);
		$this->db->set('prenom', $userdata['prenom']);
		$this->db->insert('users'); //Exécution


	}

        //Vérification de l'existence d'un utilisateur
	private function check_ifuserexists($username)
	{

		//Création de la requête
		$this->db->select('username');
		$this->db->from('users');
		$this->db->where('username', $username);
		$exists = $this->db->count_all_results(); //Renvoie 0 si le nom d'utilisateur proposé n'existe pas déjà

		return $exists;
		
	}
        
        //Récupération de l'user_level d'un utilisateur
        public function get_user_level($username)
        {
            //Création de la requête
            $this->db->select('user_level');
            $this->db->from('users');
            $this->db->where('username', $username);
            $query = $this->db->get(); //Exécution
            
            $result = $query->result_array(); //Récupération des résultats
            $user_level = $result['0']['user_level'];
            
            return $user_level;
            
        }

}

/* End of file login_model.php */
/* Location : ./application/models/login_model.php */
