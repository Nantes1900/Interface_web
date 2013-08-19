<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * creator : Paul-Yves
 * This class aims at having more natural representation of user object
 * it relies on user_model to connect to the database
 * 
 */

class User
{
    protected $_userName;
    protected $_hashedPassword;
    protected $_userLevel;
    protected $_creationDate;
    protected $_firstName;
    protected $_name;
    protected $_adress;
    protected $_email;
    protected $_phoneNumber;
    protected $_job;        //these are the common traits of an user
    protected $_lostpw;

        
    //with an array of datas (typically the result of a db query), we directly call the hydrate function
    //with an user's login, we use the user_model to query the db and hydrate with it's answer the new user object
    public function __construct($userData) {
        $userManager=new User_model();
        if (is_array($userData)){
            $this->hydrate($userData);
        }else{
            if($userManager->check_ifuserexists($userData)!=0){
                $this->hydrate($userManager->get_user($userData));          
            }
        }
    }

    //given an array of data, it feed the object's attributes as much as can be done
    public function hydrate(array $donnees){
        if (isset($donnees['username'])){
            $this->set_userName($donnees['username']);
        }
        if (isset($donnees['password'])){
            $this->set_hashedPassword($donnees['password']);
        }
        if (isset($donnees['user_level'])){
            $this->set_userLevel($donnees['user_level']);
        }
        if (isset($donnees['timestamp'])){
            $this->set_creationDate($donnees['timestamp']);
        }
        if (isset($donnees['nom'])){
            $this->set_firstName($donnees['nom']);
        }
        if (isset($donnees['prenom'])){
            $this->set_name($donnees['prenom']);
        }
        if (isset($donnees['adresse_postale'])){
            $this->set_adress($donnees['adresse_postale']);
        }
        if (isset($donnees['email'])){
            $this->set_email($donnees['email']);
        }
        if (isset($donnees['telephone'])){
            $this->set_phoneNumber($donnees['telephone']);
        }
        if (isset($donnees['profession'])){
            $this->set_job($donnees['profession']);
        }
        if (isset($donnees['lostpw'])){
            $this->set_lostpw($donnees['lostpw']);
        }
    }
    
    //save an user's change in the database
    public function save(){
        
        $userManager=new User_model();
        if($userManager->check_ifuserexists($this->get_userName())!=0){
            $userManager->modify_user($this);
        }
    }
    
    public function get_contribution(){
        $userManager=new User_model();
        if($userManager->check_ifuserexists($this->get_userName())!=0){
            return $userManager->contributed($this->get_userName());
        } else {
            return null;
        }
    }
    
    //getters and setters
    public function get_userName() {
        return $this->_userName;
    }

    public function set_userName($_userName) {
        $this->_userName = $_userName;
    }

    public function get_hashedPassword() {
        return $this->_hashedPassword;
    }

    public function set_hashedPassword($_hashedPassword) {
        $this->_hashedPassword = $_hashedPassword;
    }

    public function get_userLevel() {
        return $this->_userLevel;
    }

    public function get_userLevelType() {
        switch ($this->_userLevel) {
            case 0:
                return 'non validé';
                break;
            case 1:
                return 'visiteur';
                break;
            case 3:
                return 'informateur';
                break;
            case 4:
                return 'chercheur';
                break;
            case 5:
                return 'moderateur';
                break;
            case 9:
                return 'administrateur';
                break;
            case 10:
                return 'super administrateur';
                break;
        }
    }
    
    public function set_userLevel($_userLevel) {
        $this->_userLevel = $_userLevel;
    }
    
    public function get_creationDate() {
        return $this->_creationDate;
    }

    public function set_creationDate($_creationDate) {
        $this->_creationDate = $_creationDate;
    }

    public function get_firstName() {
        return $this->_firstName;
    }

    public function set_firstName($_firstName) {
        $this->_firstName = (string) $_firstName;
    }

    public function get_name() {
        return $this->_name;
    }

    public function set_name($_name) {
        $this->_name = (string) $_name;
    }

    public function get_adress() {
        return $this->_adress;
    }

    public function set_adress($_adress) {
        $this->_adress = (string) $_adress;
    }

    public function get_email() {
        return $this->_email;
    }

    public function set_email($_email) {
        $this->_email = $_email;
    }

    public function get_phoneNumber() {
        return $this->_phoneNumber;
    }

    public function set_phoneNumber($_phoneNumber) {
        $this->_phoneNumber = $_phoneNumber;
    }

    public function get_job() {
        return $this->_job;
    }

    public function set_job($_job) {
        $this->_job = (string) $_job;
    }
    
    public function get_lostpw() {
        return $this->_lostpw;
    }

    public function set_lostpw($_lostpw) {
        $this->_lostpw = $_lostpw;
    }

}


/* End of file user.php */
/* Location : ./application/models/user.php */

