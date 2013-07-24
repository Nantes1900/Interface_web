
    <div class='rightSidebar'>
        <h2><?php echo $this->lang->line('common_view_sidebar_obj') ?></h2>
        
        <?php foreach ($linkedObjetArray as $objetArray){ ?>
            <?php echo form_open('view_data/view_data', array('style'=>'margin:0px')) ?>
                <li class="helpbox">
                    <?php echo $objetArray['nom_objet']; ?>
                    <input type="hidden" name="data_id" value="<?php echo $objetArray['objet_id']; ?>" />
                    <input type="hidden" name="type" value="objet" />
                    <button type="submit" class="invisible" title="<?php echo $this->lang->line('common_view_sidebar_alt_obj');?>"> 
                        <?php echo img(array('src'=>'assets/utils/zoom.png','alt'=>$this->lang->line('common_view_sidebar_alt_obj'),
                                             'width'=>'50%')); ?>
                    </button>  
                    <span> 
                        <?php echo substr($objetArray['resume'],0,256);
                            if(strlen($objetArray['resume'])>256){echo '...';}
                        ?>  
                    </span>
                </li>
            </form>
        <?php } ?>
        
    </div>