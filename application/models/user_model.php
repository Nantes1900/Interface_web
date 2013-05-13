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

        public function modify_user(User $user){
            //Chargement de la gestion de hashage de mot de passe
            $this->load->helper('security');
            
            //creating request depending on what exists
            if ($user->get_hashedPassword() != null){
                $this->db->set('password', $user->get_hashedPassword());
            }
            if ($user->get_userLevel() != null){
                $this->db->set('user_level', $user->get_userLevel());
            }
            if ($user->get_firstName() != null){
                $this->db->set('nom', $user->get_firstName());
            }
            if ($user->get_name() != null){
                $this->db->set('prenom', $user->get_name());
            }
            if ($user->get_adress() != null){
                $this->db->set('adresse_postale', $user->get_adress());
            }
            if ($user->get_email() != null){
                $this->db->set('email', $user->get_email());
            }
            if ($user->get_phoneNumber() != null){
                $this->db->set('telephone', $user->get_phoneNumber());
            }
            if ($user->get_job() != null){
                $this->db->set('profession', $user->get_job());
            }
            
            $this->db->where('username',$user->get_userName());
            
            $this->db->update('users'); //Execute query
        }
        
        //Vérification de l'existence d'un utilisateur
	public function check_ifuserexists($username)
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
        
        //get an user by its username in an array
        public function get_user($username)
	{
		//Création de la requête
		$this->db->select('username','password','user_level','timestamp','nom','prenom','adresse_postale','email','telephone','profession');
		$this->db->from('users');
		$this->db->where('username', $username);
		$query = $this->db->get();
                
                $result = $query->result_array();
                
		return $result['0'];
		
	}
        
        //get a list of user entities, with some parameter restriction
        //$speUserLevel allow specifiying a particular user level
        //user entity $notUser allow not querying this particular user (often self)
        public function get_user_list ($speUserLevel = null,$orderBy='username', $orderDirection='asc',$speAttribute = null, $speAttributeValue = null, User $notUser = null){
            //db query
            $this->db->select('username, user_level, timestamp, nom, prenom, adresse_postale, email, telephone, profession');
            $this->db->from('users');
            $this->db->order_by($orderBy,$orderDirection);
            if ($speUserLevel != null){
                $this->db->where('user_level',$speUserLevel);               
            }
            if ($notUser != null){
                $this->db->where('username !=',$notUser->get_userName());  
            }
            if ($speAttribute!=null && $speAttributeValue!=null){
                $this->db->like($speAttribute,$speAttributeValue);
            }
            $query = $this->db->get();
            
            //converting to an array of user entities
            $tempArray = $query->result_array();
            $resultArray = array();         
            foreach ($tempArray as $userArray){
                $resultArray[] = new User($userArray);
            }           
            return $resultArray;
        }
}

/* End of file login_model.php */
/* Location : ./application/models/login_model.php */
