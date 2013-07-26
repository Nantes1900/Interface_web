
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
    
    <div id="map"></div>


    
