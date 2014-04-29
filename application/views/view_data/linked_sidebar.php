    <div class='rightSidebar'>
        <h2><?php echo $this->lang->line('common_view_sidebar_obj') ?></h2>
        <?php //@TODO mieux gérer l'affichage des données liées : pas de bandeau si pas d'objets liés ou que bandeau ress text pour modération ?>
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
                                if($objetArray['date_precision']=="Jour"){
					echo 'du '.to_date_dmy($objetArray['date_debut_relation']).' au '.to_date_dmy($objetArray['date_fin_relation']);
				}
				else if ($objetArray['date_precision']=="Mois"){
					$date_debut = date_parse(to_date_dmy($objetArray['date_debut_relation']));
					$date_fin = date_parse(to_date_dmy($objetArray['date_fin_relation']));
					echo 'du '.$date_debut['month'].'/'.$date_debut['year'].' au '.$date_fin['month'].'/'.$date_fin['year'];
				}
				else if ($objetArray['date_precision']=="Annee"){
					$date_debut = date_parse(to_date_dmy($objetArray['date_debut_relation']));
					$date_fin = date_parse(to_date_dmy($objetArray['date_fin_relation']));
					echo 'de '.$date_debut['year'].' à '.$date_fin['year'];
				}
			      }
				else if(($objetArray['date_debut_relation']!=null)&&($objetArray['date_fin_relation']==null)){
					if($objetArray['date_precision']=="jour"){
					echo 'du '.to_date_dmy($objetArray['date_debut_relation']).' à aujourd\'hui';
					}
					else if ($objetArray['date_precision']=="mois"){
						$date_debut = date_parse(to_date_dmy($objetArray['date_debut_relation']));
						$date_fin = date_parse(to_date_dmy($objetArray['date_fin_relation']));
						echo 'du '.$date_debut['month'].'/'.$date_debut['year'].' à aujourd\'hui';
					}
					else if ($objetArray['date_precision']=="annee"){
						$date_debut = date_parse(to_date_dmy($objetArray['date_debut_relation']));
						$date_fin = date_parse(to_date_dmy($objetArray['date_fin_relation']));
						echo 'du '.$date_debut['year'].' à aujourd\'hui';
					}
			}
                        ?>
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
                        <?php echo $ressArray['auteurs'];
                        ?> 
                        <br/>
                        <?php echo ' '.$ressArray['editeur'];
                        ?> 
                        <br/>
                        <?php if ($ressArray['reference_ressource'] != null) { echo $ressArray['reference_ressource']; } ?>
                        <br/>
                        <?php 
                            if ($ressArray['date_precision'] == 'jour') {
                                echo 'Date de publication '.to_date_dmy_prec($ressArray['date'],'jour');
                            }
                            else if ($ressArray['date_precision'] == 'mois') {
                                $date = to_date_dmy_prec($ressArray['date'],'mois');
                                echo 'Date de publication '.$date;
                            }
                            else if ($ressArray['date_precision'] == 'année') {
                                $date = to_date_dmy_prec($ressArray['date'],'année');
                                echo 'Date de publication '.$date;
                            }
                        ?>
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
                        <?php echo 'à partir du '.to_date_dmy($ressArray['date']).', précision : '.$ressArray['date_precision']; ?>
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
                        <?php echo 'à partir du '.to_date_dmy($ressArray['date']).', précision : '.$ressArray['date_precision']; ?>
                    </span>
            </li>
            </form>
        <?php } ?>
        
    </div>
