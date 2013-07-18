<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of documentation_model
 *
 * @author paulyves
 */
class Documentation_model extends CI_Model{
    
    public function __construct() {
	parent::__construct();

	//Connexion à la base de données
	$this->load->database();

    }
    
    public function import_csv($csvData, $transaction){
        $this->load->model('objet_model');
        $this->load->model('ressource_texte_model');
        $this->load->model('ressource_graphique_model');  
        $this->load->model('ressource_video_model');
        
        $failure = array();
        $documentation_textuelle_id_array = array();
        $documentation_graphique_id_array = array();
        $documentation_video_id_array = array();
        
        foreach ($csvData as $documentationCsv){
            //common beginning of error message
            $errorBegin = sprintf($this->lang->line('csv_doc_error_begin'), $documentationCsv['Nom de l\'objet'],
                                    $documentationCsv['Titre de la ressource']); 
            
            $typeDoc = $documentationCsv['Type de documentation'];
            $objet_id = $this->objet_model->get_objet_by_name($documentationCsv['Nom de l\'objet']);
            $ressource_id = 'noType'; //alert value for error tracking
            if($typeDoc=='textuelle'){
                $ressource = $this->ressource_texte_model->get_ressource('titre',$documentationCsv['Titre de la ressource']);
                $ressource_id = $ressource['ressource_textuelle_id'];
                $pagination = $documentationCsv['page concernée'];
            }elseif($typeDoc=='graphique'){
                $ressource = $this->ressource_graphique_model->get_ressource('titre',$documentationCsv['Titre de la ressource']);
                $ressource_id = $ressource['ressource_graphique_id'];
                $pagination = $documentationCsv['page concernée'];
            }elseif($typeDoc=='video'){
                $ressource = $this->ressource_video_model->get_ressource('titre',$documentationCsv['Titre de la ressource']);
                $ressource_id = $ressource['ressource_video_id'];
                $pagination = null;
            }else{
                $failure[] = $errorBegin.$this->lang->line('csv_doc_no_type');
            }
            if($ressource_id!='noType'){
                if($this->add_documentation($typeDoc, $objet_id, $ressource_id,$pagination)){ 
                    //if insert successful we stock the id in case of future rollback
                    if($transaction){
                        if($typeDoc=='textuelle'){
                            $documentation_textuelle_id_array[] = $this->db->insert_id();
                        }elseif($typeDoc=='graphique'){
                            $documentation_graphique_id_array[] = $this->db->insert_id();
                        }elseif($typeDoc=='video'){
                            $documentation_video_id_array[] = $this->db->insert_id();
                        }
                    }
                }else{ //if insert not successful, we seek the error
                    $failure[] = $errorBegin.' (';
                    if($objet_id == null){
                        $errorBegin = array_pop($failure);
                        $failure[] = $errorBegin.$documentationCsv['Nom de l\'objet'].
                                     $this->lang->line('csv_doc_do_not_exist');
                    }
                    if($ressource_id == null){
                        $errorBegin = array_pop($failure);
                        $failure[] = $errorBegin.$documentationCsv['Titre de la ressource'].
                                     $this->lang->line('csv_doc_do_not_exist');
                    }
                    $errorBegin = array_pop($failure);
                    $failure[] = substr($errorBegin,0,-2).')';
                }
            }
        }
        
        if($transaction && isset($failure['0'])){ //homemade rollback
            foreach($documentation_textuelle_id_array as $documentation_id){
                $this->delete_documentation('textuelle', $documentation_id);
            }
            foreach($documentation_graphique_id_array as $documentation_id){
                $this->delete_documentation('graphique', $documentation_id);
            }
            foreach($documentation_video_id_array as $documentation_id){
                $this->delete_documentation('video', $documentation_id);
            }
        }
        
        return $failure;
    }
    
    public function add_documentation($typeDoc, $objet_id, $ressource_id, $pagination = null){
        $this->db->set('objet_id', $objet_id);
        $this->db->set('ressource_'.$typeDoc.'_id', $ressource_id);
        if ($typeDoc!='video'){
            $this->db->set('page_consultee',$pagination);
        }
        return $this->db->insert('documentation_'.$typeDoc);
    }
    
    public function delete_documentation($typeDoc, $documentation_id){
        $this->db->where('documentation_'.$typeDoc.'_id', $documentation_id);
        $this->db->delete('documentation_'.$typeDoc);
    }
}

/* End of file documentation_model.php */
/* Location : ./application/models/documentation_model.php */

