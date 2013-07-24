
    <div class='rightSidebar'>
        <h2><?php echo $this->lang->line('common_view_sidebar_obj') ?></h2>
        
        <?php foreach ($linkedObjetArray as $objetArray){ ?>
            <?php echo form_open('view_data/view_data', array('style'=>'margin:0px')) ?>
                <li class="helpbox">
                    <?php echo $objetArray['nom_objet'].' ('.$objetArray['type_relation'].')'; ?>
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
                        <br/>
                        <?php if(($objetArray['date_debut_relation']!=null)&&($objetArray['date_fin_relation']!=null)){
                                echo 'du '.to_date_dmy($objetArray['date_debut_relation']).' au '.to_date_dmy($objetArray['date_fin_relation']); 
                        }?>
                    </span>
                </li>
            </form>
        <?php } ?>
        
        <h2><?php echo $this->lang->line('common_view_sidebar_ress') ?></h2>
        
        <?php foreach ($linkedRessTxtArray as $ressArray){ ?>
            <?php echo form_open('view_data/view_data', array('style'=>'margin:0px')) ?>
                <li class="helpbox">
                    <?php echo $ressArray['titre']; ?>
                    <input type="hidden" name="data_id" value="<?php echo $ressArray['ressource_id']; ?>" />
                    <input type="hidden" name="type" value="ressource_texte" />
                    <button type="submit" class="invisible" title="<?php echo $this->lang->line('common_view_sidebar_alt_ress');?>"> 
                        <?php echo img(array('src'=>'assets/utils/zoom.png','alt'=>$this->lang->line('common_view_sidebar_alt_ress'),
                                             'width'=>'50%')); ?>
                    </button>  
                    <span> 
                        <?php echo substr($ressArray['description'],0,256);
                            if(strlen($ressArray['description'])>256){echo '...';}
                        ?> 
                        <br/>
                        <?php echo 'Ref : '.$ressArray['reference_ressource']; ?>
                        <br/>
                        <?php echo 'à partir du '.to_date_dmy($ressArray['date']); ?>
                        <?php if($ressArray['page_consultee']!=0){ ?>
                            <br>
                                <?php echo $this->lang->line('common_view_sidebar_page').$ressArray['page_consultee']; ?>
                        <?php } ?>
                    </span>
                </li>
            </form>
        <?php } ?>
        <?php foreach ($linkedRessGraphArray as $ressArray){ ?>
            <?php echo form_open('view_data/view_data', array('style'=>'margin:0px')) ?>
                <li class="helpbox">
                    <?php echo $ressArray['titre']; ?>
                    <input type="hidden" name="data_id" value="<?php echo $ressArray['ressource_id']; ?>" />
                    <input type="hidden" name="type" value="ressource_graphique" />
                    <button type="submit" class="invisible" title="<?php echo $this->lang->line('common_view_sidebar_alt_ress');?>"> 
                        <?php echo img(array('src'=>'assets/utils/zoom.png','alt'=>$this->lang->line('common_view_sidebar_alt_ress'),
                                             'width'=>'50%')); ?>
                    </button>
                    <span> 
                        <?php echo substr($ressArray['description'],0,256);
                            if(strlen($ressArray['description'])>256){echo '...';}
                        ?> 
                        <br/>
                        <?php echo 'Ref : '.$ressArray['reference_ressource']; ?>
                        <br/>
                        <?php echo 'à partir du '.to_date_dmy($ressArray['date']); ?>
                        <?php if($ressArray['page_consultee']!=0){ ?>
                            <br>
                                <?php echo $this->lang->line('common_view_sidebar_page').$ressArray['page_consultee']; ?>
                        <?php } ?>
                    </span>
                </li>
            </form>
        <?php } ?>
        <?php foreach ($linkedRessVidArray as $ressArray){ ?>
            <?php echo form_open('view_data/view_data', array('style'=>'margin:0px')) ?>
                <li class="helpbox">
                    <?php echo $ressArray['titre']; ?>
                    <input type="hidden" name="data_id" value="<?php echo $ressArray['ressource_id']; ?>" />
                    <input type="hidden" name="type" value="ressource_video" />
                    <button type="submit" class="invisible" title="<?php echo $this->lang->line('common_view_sidebar_alt_ress');?>"> 
                        <?php echo img(array('src'=>'assets/utils/zoom.png','alt'=>$this->lang->line('common_view_sidebar_alt_ress'),
                                             'width'=>'50%')); ?>
                    </button>
                    <span> 
                        <?php echo substr($ressArray['description'],0,256);
                            if(strlen($ressArray['description'])>256){echo '...';}
                        ?>  
                        <br/>
                        <?php echo 'Ref : '.$ressArray['reference_ressource']; ?>
                        <br/>
                        <?php echo 'à partir du '.to_date_dmy($ressArray['date']); ?>
                    </span>
            </li>
            </form>
        <?php } ?>
        
    </div>
