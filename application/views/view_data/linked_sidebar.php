<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
    <div class='rightSidebar'>
        <h2>Objets en relation</h2>
        
        <?php foreach ($linkedObjetArray as $objetArray){ ?>
            <li class="helpbox">
                <?php echo $objetArray['nom_objet'].' ('.$objetArray['type_relation'].')'; ?>
                <span> 
                    <?php echo $objetArray['resume']; ?> 
                    <br/>
                    <?php echo 'du '.to_date_dmy($objetArray['date_debut_relation']).' au '.to_date_dmy($objetArray['date_fin_relation']); ?>
                </span>
            </li>
        <?php } ?>
        
        <h2>Ressources en relation</h2>
        
        <?php foreach ($linkedRessTxtArray as $ressArray){ ?>
            <li class="helpbox">
                <?php echo $ressArray['titre']; ?>
                <span> 
                    <?php echo $ressArray['description']; ?> 
                    <br/>
                    <?php echo 'Ref : '.$ressArray['reference_ressource']; ?>
                    <br/>
                    <?php echo 'à partir du '.to_date_dmy($ressArray['date']); ?>
                </span>
            </li>
        <?php } ?>
        <?php foreach ($linkedRessGraphArray as $ressArray){ ?>
            <li class="helpbox">
                <?php echo $ressArray['titre']; ?>
                <span> 
                    <?php echo $ressArray['description']; ?> 
                    <br/>
                    <?php echo 'Ref : '.$ressArray['reference_ressource']; ?>
                    <br/>
                    <?php echo 'à partir du '.to_date_dmy($ressArray['date']); ?>
                </span>
            </li>
        <?php } ?>
        <?php foreach ($linkedRessVidArray as $ressArray){ ?>
            <li class="helpbox">
                <?php echo $ressArray['titre']; ?>
                <span> 
                    <?php echo $ressArray['description']; ?> 
                    <br/>
                    <?php echo 'Ref : '.$ressArray['reference_ressource']; ?>
                    <br/>
                    <?php echo 'à partir du '.to_date_dmy($ressArray['date']); ?>
                </span>
            </li>
        <?php } ?>
        
    </div>
</html>