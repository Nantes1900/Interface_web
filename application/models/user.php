<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * creator : Paul-Yves
 * This class aims at having more natural representation of user object
 * it relies on user_model to connect to the database
 * 
 */
class user
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
    
    
    
    //with an user's login, we use the user_model to query the db and hydrate with it's answer the new user object
    public function __construct($userLogin) {
        $userManager=new User_model();
        if($userManager->check_ifuserexists($userLogin)!=0){
            $this->hydrate($userManager->get_user($userLogin));          
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
        $this->_firstName = $_firstName;
    }

    public function get_name() {
        return $this->_name;
    }

    public function set_name($_name) {
        $this->_name = $_name;
    }

    public function get_adress() {
        return $this->_adress;
    }

    public function set_adress($_adress) {
        $this->_adress = $_adress;
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
        $this->_job = $_job;
    }
}


/* End of file user.php */
/* Location : ./application/models/user.php */

