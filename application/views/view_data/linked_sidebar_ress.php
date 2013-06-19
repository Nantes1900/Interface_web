<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
    <div class='rightSidebar'>
        <h2>Objets en relation</h2>
        
        <?php foreach ($linkedObjetArray as $objetArray){ ?>
            <?php echo form_open('view_data/view_data', array('style'=>'margin:0px')) ?>
                <li class="helpbox">
                    <?php echo $objetArray['nom_objet']; ?>
                    <input type="hidden" name="data_id" value="<?php echo $objetArray['objet_id']; ?>" />
                    <input type="hidden" name="type" value="objet" />
                    <button type="submit" class="invisible"> 
                        <?php echo img(array('src'=>'assets/utils/zoom.png','alt'=>'voir objet','width'=>'50%')); ?>
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
</html>