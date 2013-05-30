<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
    <div class='rightSidebar'>
        <h2>Objets en relation</h2>
        
        <?php foreach ($linkedObjetArray as $objetArray){ ?>
            <?php echo form_open('view_data/view_data', array('style'=>'margin:0px')) ?>
                <li class="helpbox">
                    <?php echo $objetArray['nom_objet'].' ('.$objetArray['type_relation'].')'; ?>
                    <input type="hidden" name="data_id" value="<?php echo $objetArray['objet_id']; ?>" />
                    <input type="hidden" name="type" value="objet" />
                    <button type="submit" class="invisible"> 
                        <?php echo img(array('src'=>'assets/utils/zoom.png','alt'=>'voir objet','width'=>'50%')); ?>
                    </button>  
                    <span> 
                        <?php echo $objetArray['resume']; ?> 
                        <br/>
                        <?php echo 'du '.to_date_dmy($objetArray['date_debut_relation']).' au '.to_date_dmy($objetArray['date_fin_relation']); ?>
                    </span>
                </li>
            </form>
        <?php } ?>
        
        <h2>Ressources en relation</h2>
        
        <?php foreach ($linkedRessTxtArray as $ressArray){ ?>
            <?php echo form_open('view_data/view_data', array('style'=>'margin:0px')) ?>
                <li class="helpbox">
                    <?php echo $ressArray['titre']; ?>
                    <input type="hidden" name="data_id" value="<?php echo $ressArray['ressource_id']; ?>" />
                    <input type="hidden" name="type" value="ressource_texte" />
                    <button type="submit" class="invisible"> 
                        <?php echo img(array('src'=>'assets/utils/zoom.png','alt'=>'voir objet','width'=>'50%')); ?>
                    </button>  
                    <span> 
                        <?php echo $ressArray['description']; ?> 
                        <br/>
                        <?php echo 'Ref : '.$ressArray['reference_ressource']; ?>
                        <br/>
                        <?php echo 'à partir du '.to_date_dmy($ressArray['date']); ?>
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
                    <button type="submit" class="invisible"> 
                        <?php echo img(array('src'=>'assets/utils/zoom.png','alt'=>'voir objet','width'=>'50%')); ?>
                    </button>
                    <span> 
                        <?php echo $ressArray['description']; ?> 
                        <br/>
                        <?php echo 'Ref : '.$ressArray['reference_ressource']; ?>
                        <br/>
                        <?php echo 'à partir du '.to_date_dmy($ressArray['date']); ?>
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
                    <button type="submit" class="invisible"> 
                        <?php echo img(array('src'=>'assets/utils/zoom.png','alt'=>'voir objet','width'=>'50%')); ?>
                    </button>
                    <span> 
                        <?php echo $ressArray['description']; ?> 
                        <br/>
                        <?php echo 'Ref : '.$ressArray['reference_ressource']; ?>
                        <br/>
                        <?php echo 'à partir du '.to_date_dmy($ressArray['date']); ?>
                    </span>
            </li>
            </form>
        <?php } ?>
        
    </div>
</html>