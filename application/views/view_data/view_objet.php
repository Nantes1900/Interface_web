

        <h1> Détails de l'objet : <?php echo $objet->get_nom_objet(); ?> </h1>
        
        <h2> Résumé </h2>
        <p> <?php echo $objet->get_resume(); ?> </p>
        
        <h2> Description </h2>
        <p> <?php echo $objet->get_description(); ?> </p> 
        
        <h2> Historique </h2>
        <p> <?php echo $objet->get_historique(); ?> </p>
        
        <h3> Adresse postale </h3>
        <p> <?php echo $objet->get_adresse_postale(); ?> </p>
        
        <h3> Mots-clés </h3>
        <p> <?php echo $objet->get_mots_cles(); ?> </p>
        
        <h3> Informations fournies par </h3>
        <p> <?php echo $objet->get_username(); ?> </p>
        
        
        <?php if($objet->get_geom()!=null){ ?>
            <?php echo form_open('view_data/select_data/index/carte') ?>
                <?php $latlng = $objet->get_geom(); ?>
                <input type="hidden" name="longitude" value="<?php echo $latlng['longitude']; ?>" />
                <input type="hidden" name="latitude" value="<?php echo $latlng['latitude']; ?>" />
                <input type="submit" value="Voir cet objet sur la carte" />
            </form>
        <?php } ?>
        
        
        <?php if($this->session->userdata('user_level') >= 5){ ?>
                <?php echo form_open('moderation/modify_objet/index/modify') ?>
                            <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                            <input type="submit" value="Modifier cet objet" />
                </form>
        <?php } ?>
        <?php echo form_open('data_center/ajout_ressource/add_on_the_fly')?>
            <p>
                Ajouter une ressource liée à cet objet :
                <select name="typeFormulaire">
                       <option value="formulaire_texte"> texte </option>
                       <option value="formulaire_image"> image </option>
                       <option value="formulaire_video"> vidéo </option>
                </select>
                <input type="hidden" name="objet_id" value="<?php echo $objet->get_objet_id(); ?>" />
                <input type="submit" value="Ajouter ressource" />
            </p>
        </form>
        
