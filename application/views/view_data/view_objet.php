

        <h1> <?php echo $this->lang->line('common_view_detail_obj').$objet->get_nom_objet(); ?> </h1>
        
        <h2> <?php echo $this->lang->line('common_obj_resume');?> </h2>
        <p> <?php echo $objet->get_resume(); ?> </p>
        
        <h2> <?php echo $this->lang->line('common_obj_description');?> </h2>
        <p> <?php echo $objet->get_description(); ?> </p> 
        
        <h2> <?php echo $this->lang->line('common_obj_historique');?> </h2>
        <p> <?php echo $objet->get_historique(); ?> </p>
        
        <h3> <?php echo $this->lang->line('common_obj_adresse_postale');?> </h3>
        <p> <?php echo $objet->get_adresse_postale(); ?> </p>
        
        <h3> <?php echo $this->lang->line('common_obj_mots_cles');?> </h3>
        <p> <?php echo $objet->get_mots_cles(); ?> </p>
        
        <h3> <?php echo $this->lang->line('common_view_author');?> </h3>
        <p> <?php echo $objet->get_username(); ?> </p>
        
        
        <?php if($objet->get_geom()!=null){ ?>
            <?php echo form_open('view_data/select_data/index/carte') ?>
                <?php $latlng = $objet->get_geom(); ?>
                <input type="hidden" name="longitude" value="<?php echo $latlng['longitude']; ?>" />
                <input type="hidden" name="latitude" value="<?php echo $latlng['latitude']; ?>" />
                <input type="submit" value="<?php echo $this->lang->line('common_view_see_on_map');?>" />
            </form>
        <?php } ?>
        
        
        <?php if($this->session->userdata('user_level') >= 5){ ?>
                <?php echo form_open('moderation/modify_objet/index/modify') ?>
                            <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                            <input type="submit" value="<?php echo $this->lang->line('common_view_modify_obj');?>" />
                </form>
        <?php } ?>
        <?php echo form_open('data_center/ajout_ressource/add_on_the_fly')?>
            <p>
                <?php echo $this->lang->line('common_view_add_ress');?>
                <select name="typeFormulaire">
                       <option value="formulaire_texte"> <?php echo $this->lang->line('common_ressource_txt');?> </option>
                       <option value="formulaire_image"> <?php echo $this->lang->line('common_ressource_img');?> </option>
                       <option value="formulaire_video"> <?php echo $this->lang->line('common_ressource_vid');?> </option>
                </select>
                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                <input type="submit" value="<?php echo $this->lang->line('common_view_do_add_ress');?>" />
            </p>
        </form>
        
