<?php

class Import_csv extends CI_Controller
{

	public function index()
	{
            $userLevel = $this->session->userdata('user_level');
            $data['userLevel'] = $userLevel;
            $this->load->view('data_center/data_center',$data);
            $this->formulaire();
	}

	public function __construct()
	{
            parent::__construct();

            //Ce code sera executé charque fois que ce contrôleur sera appelé
            
            $this->load->library('upload');
            $this->load->helper(array('form','csv','file'));
            $this->load->view('header');
	}
        
        function formulaire()
	{	
		$this->load->view('data_center/import_csv', array('error' => ' ' ));
	}

	function do_upload()
	{
		$config['upload_path'] = './assets/csv/';
		$config['allowed_types'] = 'csv';               
                $config['max_size'] = '100';
                
                $this->upload->initialize($config);		
	
		if ( ! $this->upload->do_upload('csv_file'))
		{
			$error = array('error' => $this->upload->display_errors());
			
			$this->load->view('data_center/import_csv', $error);
		}	
		else
		{
                                            
                        $this->load->library('csvreader');
            
			$csv_file = $this->upload->data();
                        
                        $data = $this->csvreader->parse_file($csv_file['full_path']);
                        
                        $csv_type = guess_csv_type($data['0']);
                        
                        if( $csv_type == 'relation')
                        {
                            $this->load->model('relation_model');
                            
                            $this->relation_model->import_csv($data);
                        }
                        
                        if( $csv_type == 'objet')
                        {
                            $this->load->model('objet_model');
                            
                            $this->objet_model->import_csv($data);
                        }
                        
                        if( $csv_type == 'ressource_textuelle')
                        {
                            require_once('application/models/ressource_texte.php');
                            $this->load->model('ressource_texte_model');                            
                            $this->ressource_texte_model->import_csv($data);
                        }
                        
                        if( $csv_type == 'ressource_grapĥique')
                        {
                            require_once('application/models/ressource_graphique.php');
                            $this->load->model('ressource_graphique_model');                            
                            $this->ressource_texte_model->import_csv($data);
                        }
                        
                        if( $csv_type == 'ressource_video')
                        {
                            require_once('application/models/ressource_video.php');
                            $this->load->model('ressource_video_model');                            
                            $this->ressource_texte_model->import_csv($data);
                        }
                        
                        delete_files($csv_file['file_path']);
			
			
		}
	}	
        
}

/* End of file import_csv.php */
/* Location : ./application/controllers/data_center/import_csv.php */