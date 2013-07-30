<?php

/**
 * ajout_annotation class
 * 
 * Accessible uniquement aux utilisateurs autorisés (à partir de chercheur)
 * Permet de collecter les formulaires sur les annotations et redirige vers
 * le controlleur view_data (méthode appropriée)
 * 
 * @author Lucas Paul-Yves
 * 
 */

class Ajout_annotation extends MY_Controller {
    
    public function index($goal) {
        
        if($goal=='new'){
            $this->new_annotation();
        } elseif($goal=='answer'){
            $this->answer_annotation();
        } elseif($goal=='delete'){
            $this->delete_annotation();
        } else {
            redirect('accueil/accueil/', 'refresh');
        }
    }
    
    public function __construct() {
        parent::__construct();

        //Ce code sera executé charque fois que ce contrôleur sera appelé
        $this->load->model('annotation_model');
        require_once('application/models/annotation.php');
        $this->load->library('form_validation');
        if (!$this->session->userdata('username') || $this->session->userdata('user_level')<4) { //checking that user is connected
            redirect('accueil/accueil/not_connected/', 'refresh');
        }
    }
    
    private function new_annotation(){
        
        $annotData['type_target'] = ($this->input->post('type_target'));
        $annotData['target_id'] = ($this->input->post('target_id'));
        
        if($this->form_validation->run('add_annotation') == TRUE) {
            $annotData['titre'] = $this->input->post('titre');
            $annotData['texte'] = $this->input->post('texte');
            $annotData['username'] = ($this->session->userdata('username'));

            $annotation = new Annotation($annotData);
            $annotation->save();
        }
        
        if($annotData['type_target']=='objet'){
            redirect('view_data/view_data/view_objet/'.$annotData['target_id']);
        } elseif (preg_match("#ressource_[a-z]*#", $annotData['type_target'])){
            redirect('view_data/view_data/view_ressource/'.$annotData['target_id'].'/'.$annotData['type_target']);
        }
    }
    
    private function answer_annotation(){
        $annotData['type_target'] = ($this->input->post('type_target'));
        $annotData['target_id'] = ($this->input->post('target_id'));
        
        if($this->form_validation->run('answer_annotation') == TRUE) {
            $annotData['texte'] = $this->input->post('texte');
            $annotData['username'] = ($this->session->userdata('username'));
            $annotData['parent_id'] = ($this->input->post('parent_id'));

            $answer = new Annotation($annotData);
            $answer->save();
        }
        
        if($annotData['type_target']=='objet'){
            redirect('view_data/view_data/view_objet/'.$annotData['target_id']);
        } elseif (preg_match("#ressource_[a-z]*#", $annotData['type_target'])){
            redirect('view_data/view_data/view_ressource/'.$annotData['target_id'].'/'.$annotData['type_target']);
        }
    }
    
    private function delete_annotation(){
        $type_target = ($this->input->post('type_target'));
        $target_id = ($this->input->post('target_id'));
        
        $annot = new Annotation($this->input->post('annot_id'));
        $annot->delete();
        if($type_target=='objet'){
            redirect('view_data/view_data/view_objet/'.$target_id);
        } elseif (preg_match("#ressource_[a-z]*#", $type_target)){
            redirect('view_data/view_data/view_ressource/'.$target_id.'/'.$type_target);
        }
    }
}

/* End of file annotations.php */
/* Location : ./application/models/ajout_annotations.php */

