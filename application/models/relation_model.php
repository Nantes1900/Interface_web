<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relation_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

		//Connexion à la base de données
		$this->load->database();

	}
        
        public function ajout_relation($relationdata)
        {
            //Création de la requête
            $this->db->set('username', $relationdata['username']);
            $this->db->set('objet_id_1', $relationdata['objet_id_1']);
            $this->db->set('objet_id_2', $relationdata['objet_id_2']);
            
            if (array_key_exists('datation_indication_debut', $relationdata))
            {
                $this->db->set('datation_indication_debut', $relationdata['datation_indication_debut']);
            }
            
            if (array_key_exists('datation_indication_fin', $relationdata))
            {
                $this->db->set('datation_indication_fin', $relationdata['datation_indication_fin']);
            }
            
            if (array_key_exists('date_debut_relation', $relationdata))
            {
                $this->db->set('date_debut_relation', $relationdata['date_debut_relation']);
            }
            
            if (array_key_exists('date_debut_relation', $relationdata))
            {
                $this->db->set('date_fin_relation', $relationdata['date_fin_relation']);
            }
            
            if (array_key_exists('date_precision', $relationdata))
            {
                $this->db->set('date_precision', $relationdata['date_precision']);  
            }       
            
            if (array_key_exists('parent', $relationdata))
            {
                $this->db->set('parent', $relationdata['parent']);
            } 
                      
            $this->db->set('type_relation_id', $relationdata['type_relation_id']);
            $this->db->insert('relation'); //Exécution            
        }
        
        public function get_type_relation_list()
        {
            $this->db->select('type_relation_id, type_relation');
            $query = $this->db->get('type_relation');
            return $query->result_array();
        }
        
        public function import_csv($data, $transaction)
        {
            $failure = array();
            if($transaction){$this->db->trans_start();}
            $this->load->model('objet_model','objet');
            
            foreach($data as $relationcsv){
                if($this->objet->get_objet_by_name($relationcsv['source'])!=null && $this->objet->get_objet_by_name($relationcsv['target'])!=null){
                    $relationdata['objet_id_1'] = $this->objet->get_objet_by_name($relationcsv['source']);
                    $relationdata['objet_id_2'] = $this->objet->get_objet_by_name($relationcsv['target']);
                    $relationdata['type_relation_id'] = $this->get_type_relation_by_name($relationcsv['label']);
                    $relationdata['username'] = $this->session->userdata('username');
                    if ($relationdata['objet_id_1']!=null && $relationdata['objet_id_2']!=null){
                        $this->ajout_relation($relationdata);
                        //if there is an error in the insertion we want to continue, check $db['default']['db_debug'] = FALSE; in config/database 
                        if (($this->db->_error_message())!=null) { 
                            $failure[] = 'la relation entre '.$relationcsv['source'].' et '.$relationcsv['target'].
                                            ' (objets trouvés mais informations non valides), '; 
                        }
                    } 
                }elseif ($this->objet->get_objet_by_name($relationcsv['source'])==null){
                    $failure[] = 'la relation entre '.$relationcsv['source'].'et '.$relationcsv['target'].', ('.$relationcsv['source'].' n\'existe pas)'; 
                } elseif ($this->objet->get_objet_by_name($relationcsv['target'])==null){
                    $failure[] = 'la relation entre '.$relationcsv['source'].'et '.$relationcsv['target'].', ('.$relationcsv['target'].' n\'existe pas)'; 
                }
            }
            if($transaction){$this->db->trans_complete();}
            return $failure;
        }
        
        public function get_type_relation_by_name($name)
        {
            $this->db->select('type_relation_id');
            $this->db->from('type_relation');
            $this->db->where('type_relation', ucfirst(trim($name)));
            
            $query = $this->db->get(); //Exécution

            $result = $query->result_array(); //Récupération des résultats
            $type_relation_id = $result['0']['type_relation_id'];
            
            return $type_relation_id;
        }
        
        public function delete_relation($relation_id){
            $this->db->where('relation_id',$relation_id);
            $this->db->delete('relation'); 
        }
        
}


/* End of file relation_model.php */
/* Location: ./application/models/relation_model.php */
