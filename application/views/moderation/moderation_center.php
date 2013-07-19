

	<h1><?php echo $this->lang->line('moderation_main_title'); ?></h1>
        
        
        <div class='menu'>
            <ul id='navigation' style="width:65%;">
                <li><?php echo anchor('moderation/modify_objet/index/modify', 
                            $this->lang->line('moderation_mod_edit_m').strtolower($this->lang->line('common_histo_objet'))); ?></li>
            
                <li><?php echo anchor('moderation/modify_objet/index/relation', 
                            $this->lang->line('moderation_mod_manage_p').strtolower($this->lang->line('common_obj_links'))); ?></li>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_texte/modify',
                            $this->lang->line('moderation_mod_edit_f').strtolower($this->lang->line('common_ressource_txt'))); ?></li>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_texte/documentation', 
                            $this->lang->line('moderation_mod_manage_s').strtolower($this->lang->line('common_doc_txt')).
                            $this->lang->line('moderation_mod_concerning').strtolower($this->lang->line('common_histo_objet'))); ?></li>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_graphique/modify', 
                            $this->lang->line('moderation_mod_edit_f').strtolower($this->lang->line('common_ressource_img'))); ?></li>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_graphique/documentation', 
                            $this->lang->line('moderation_mod_manage_s').strtolower($this->lang->line('common_doc_img')).
                            $this->lang->line('moderation_mod_concerning').strtolower($this->lang->line('common_histo_objet'))); ?></li>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_video/modify', 
                            $this->lang->line('moderation_mod_edit_f').strtolower($this->lang->line('common_ressource_vid'))); ?></li>
            
                <li><?php echo anchor('moderation/modify_ressource/index/ressource_video/documentation', 
                            $this->lang->line('moderation_mod_manage_s').strtolower($this->lang->line('common_doc_vid')).
                            $this->lang->line('moderation_mod_concerning').strtolower($this->lang->line('common_histo_objet'))); ?></li>
            </ul>
        </div>


