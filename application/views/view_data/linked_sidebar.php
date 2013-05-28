<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 
    <div class='rightSidebar'>
        <h2>Objets en relation</h2>
        
        <?php foreach ($linkedObjetArray as $objetArray){ ?>
            <li class="helpbox">
                <?php echo $objetArray['nom_objet'].' ('.$objetArray['type_relation'].')'; ?>
                <span> 
                    <?php echo $objetArray['resume']; ?> 
                    <br/>
                    <?php echo 'du '.$objetArray['date_debut_relation'].' au '.$objetArray['date_fin_relation'] ?>
                </span>
            </li>
        <?php } ?>
    </div>
</html>