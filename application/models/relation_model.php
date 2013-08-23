<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        //Connexion à la base de données
        $this->load->database();
    }
        
    public function ajout_relation($relationdata) {
        //Création de la requête
        $this->db->set('username', $relationdata['username']);
        $this->db->set('objet_id_1', $relationdata['objet_id_1']);
        $this->db->set('objet_id_2', $relationdata['objet_id_2']);

        if (array_key_exists('datation_indication_debut', $relationdata)) {
            $this->db->set('datation_indication_debut', $relationdata['datation_indication_debut']);
        }

        if (array_key_exists('datation_indication_fin', $relationdata)) {
            $this->db->set('datation_indication_fin', $relationdata['datation_indication_fin']);
        }

        if (array_key_exists('date_debut_relation', $relationdata)) {
            $this->db->set('date_debut_relation', $relationdata['date_debut_relation']);
        }

        if (array_key_exists('date_fin_relation', $relationdata)) {
            $this->db->set('date_fin_relation', $relationdata['date_fin_relation']);
        }

        if (array_key_exists('date_precision', $relationdata)) {
            $this->db->set('date_precision', $relationdata['date_precision']);
        }

        if (array_key_exists('parent', $relationdata)) {
            $this->db->set('parent', $relationdata['parent']);
        }

        $this->db->set('type_relation_id', $relationdata['type_relation_id']);

        return $this->db->insert('relation'); //Exécution            
    }
        
    public function get_type_relation_list() {
        $this->db->select('type_relation_id, type_relation');
        $query = $this->db->get('type_relation');
        return $query->result_array();
    }
        
        public function import_csv($data, $transaction) {
        $failure = array();
        $relation_id_array = array(); //id of successful insert, used for home made rollback
        $this->load->model('objet_model', 'objet');
        $this->load->helper('dates');

        foreach ($data as $relationcsv) {
            $errorBegin = sprintf($this->lang->line('csv_rel_error_begin'),$relationcsv['source'],
                                  $relationcsv['target']); //common beginning of error message
            
            if ($this->objet->get_objet_by_name($relationcsv['source']) != null && 
                $this->objet->get_objet_by_name($relationcsv['target']) != null) {
                
                $relationdata['objet_id_1'] = $this->objet->get_objet_by_name($relationcsv['source']);
                $relationdata['objet_id_2'] = $this->objet->get_objet_by_name($relationcsv['target']);
                $relationdata['type_relation_id'] = $this->get_type_relation_by_name($relationcsv['label']);
                if (isset($relationcsv['parent de'])) {
                    if ($relationcsv['parent de'] == 'TRUE') {
                        $relationdata['parent'] = 't';
                    } else {
                        $relationdata['parent'] = 'f';
                    }
                }
                if ($relationcsv['date debut'] != null) {
                    $relationdata['date_debut_relation'] = $relationcsv['date debut'];
                }
                if ($relationcsv['date fin'] != null) {
                    $relationdata['date_fin_relation'] = $relationcsv['date fin'];
                }
                if ($relationcsv['precision date'] != null) {
                    $relationdata['date_precision'] = $relationcsv['precision date'];
                }
                if ($relationcsv['indication debut'] != null) {
                    $relationdata['datation_indication_debut'] = $relationcsv['indication debut'];
                }
                if ($relationcsv['indication fin'] != null) {
                    $relationdata['datation_indication_fin'] = $relationcsv['indication fin'];
                }
                $relationdata['username'] = $this->session->userdata('username');
                    
                $this->ajout_relation($relationdata);
                //if there is an error in the insertion we want to continue, check $db['default']['db_debug'] = FALSE; in config/database 
                if (($this->db->_error_message()) == null) {
                    $relation_id_array[] = $this->db->insert_id();
                } else {
                    if ($relationdata['type_relation_id'] != null) {
                        if (!valid_DMY($relationcsv['date debut'])) {
                            $failure[] = $errorBegin . $this->lang->line('csv_rel_date_begin');
                        } elseif (!valid_DMY($relationcsv['date fin'])) {
                            $failure[] = $errorBegin . $this->lang->line('csv_rel_date_end');
                        } else {
                            $failure[] = $errorBegin . $this->lang->line('csv_rel_invalid');
                        }
                    } else {
                        $failure[] = $errorBegin . $this->lang->line('csv_rel_unknown');
                    }
                }
            } elseif ($this->objet->get_objet_by_name($relationcsv['source']) == null) {
                $failure[] = $errorBegin.' ('.$relationcsv['source'].$this->lang->line('csv_rel_do_not_exist').')';
            } elseif ($this->objet->get_objet_by_name($relationcsv['target']) == null) {
                $failure[] = $errorBegin.' ('.$relationcsv['target'].$this->lang->line('csv_rel_do_not_exist').')';
            }
        }

        if ($transaction && isset($failure['0'])) { //home-made rollback
            foreach ($relation_id_array as $relation_id) {
                $this->delete_relation($relation_id);
            }
        }
        return $failure;
    }

    public function get_type_relation_by_name($name) {
        $this->db->select('type_relation_id');
        $this->db->from('type_relation');
        $this->db->where('type_relation', ucfirst(trim($name)));

        $query = $this->db->get(); //Exécution

        $result = $query->result_array(); //Récupération des résultats
        if (isset($result['0'])) {
            $type_relation_id = $result['0']['type_relation_id'];
            return $type_relation_id;
        } else {
            return null;
        }
    }

    public function delete_relation($relation_id) {
        $this->db->where('relation_id', $relation_id);

        return $this->db->delete('relation');
    }

}


/* End of file relation_model.php */
/* Location: ./application/models/relation_model.php */
