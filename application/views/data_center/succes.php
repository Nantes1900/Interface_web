<?php if(!$transaction || ($transaction && !isset($failure['0']))){ ?>
    <h3>Votre fichier csv de type <?php echo $csvType; ?> a bien été importé</h3>
<?php } ?>
    
<?php if($transaction && isset($failure['0'])){ ?>
    <h3><b>Echec</b> : votre fichier csv de type <?php echo $csvType; ?> contenait 
        <?php echo count($failure);?> erreur(s) et n'a pas été importé</h3>
<?php } ?>    
    
    
<?php if(isset($failure['0'])){ ?>
<p> <b>Malheureusement</b>, certain(e)s <?php echo $csvType; ?> n'ont pas pu être entré(e)s. Il s'agit de : 
    <?php foreach($failure as $fail){ echo $fail.', ';} ?>
<p>
    Essayez de revoir leur mise en forme et vérifier que votre fichier csv est conforme aux instructions, 
    ou encore de voir s'il n'existe pas déjà des objets de même nom. Si le problème persiste, contactez un modérateur.
</p>
<?php } ?>
<p>Vous pouvez continuer à en charger d'autres</p>