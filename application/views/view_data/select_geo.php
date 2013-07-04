
    <head>
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo css_url('leaflet'); ?>" />
    </head>    
<p><?php echo anchor('view_data/select_data/index', 'Revenir à la selection de données'); ?></p>
    
    <h1>Selection de données par la carte</h1>
    
    <p>
        Pour visualiser un objet en détails, cliquez dessus puis sur le lien voir l'objet
        <?php if($this->session->userdata('user_level') >= 5) { ?>
            <span id="moderateur">
                , vous pouvez aussi cliquer sur "supprimer le marqueur" pour effacer 
                la géométrie de l'objet. Ainsi il n'apparaîtra plus sur la carte à cet endroit.
            </span>
        <?php } ?>
    </p>
    <?php if($this->session->userdata('user_level') >= 4) { ?>
    <p id="chercheur"> Pour créer un nouvel objet sur la carte, 
        double cliquez à son emplacement sur la carte puis choisissez l'option qui vous convient</p>
    <?php } ?>
    
<!--    this is for auto zoom if it was an argument-->
    <?php if(isset($latitude) && isset($longitude)){ ?>
        <div id="latitude" style="display : none;"><?php echo $latitude; ?></div>
        <div id="longitude" style="display : none;"><?php echo $longitude; ?></div>
    <?php } ?>
    
    <div id="map"></div>
    <script src="<?php echo base_url();?>assets/js/leaflet.js"></script>
    <script src="<?php echo base_url();?>assets/js/addmarkers.js"></script>

    
