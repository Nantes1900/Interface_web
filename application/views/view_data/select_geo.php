
<p><?php echo anchor('view_data/select_data/index', $this->lang->line('common_view_go_back_link')); ?></p>
    
    <h1><?php echo $this->lang->line('map_title'); ?></h1>
    
    <p>
        <?php echo $this->lang->line('map_main_instruction'); ?>
    </p>
    <?php if($this->session->userdata('user_level') >= 5) { ?>
        <span id="moderateur">
            <p>
                <?php echo $this->lang->line('map_moderator_instruction'); ?>
            </p>
        </span>
    <?php } ?>
    
    <?php if($this->session->userdata('user_level') >= 4) { ?>
    <p id="chercheur"> 
        <?php echo $this->lang->line('map_researcher_instruction'); ?>
    </p>
    <?php } ?>
    
<!--    this is for auto zoom if it was an argument-->
    <?php if(isset($latitude) && isset($longitude)){ ?>
        <div id="latitude" style="display : none;"><?php echo $latitude; ?></div>
        <div id="longitude" style="display : none;"><?php echo $longitude; ?></div>
    <?php } ?>
    
    <?php if(isset($objet) && $objet instanceof Objet){ ?>
        <h2>Ajout d'un polygone représentant <em><?php echo $objet->get_nom_objet(); ?></em></h2>
        <p id="addPolygon"> 
            Cliquez sur la carte pour ajouter les sommets d'un polygone.
            <button id='okPolygon'>Valider le polygone</button>
            <button id='delPolygon'>Annuler le polygone</button>
            <div id="objet_id" style="display : none;"><?php echo $objet->get_objet_id(); ?></div>
        </p>    
    <?php } ?>    
    <div id="map"></div>


    
