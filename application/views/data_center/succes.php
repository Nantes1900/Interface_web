
<h3>Votre fichier csv de type <?php echo $csvType; ?> a bien été chargé</h3>

<?php if(isset($failure['0'])){ ?>
<p> Malheureusement, certains <?php echo $csvType; ?> n'ont pas pu être entrés. Il s'agit de : 
    <?php foreach($failure as $fail){ echo $fail.', ';} ?>
<p>
    Essayez de revoir leur mise en forme et vérifier que votre fichier csv est conforme aux instructions, 
    ou encore de voir s'il n'existe pas déjà des objets de même nom. Si le problème persiste, contactez un modérateur.
</p>
<?php } ?>
<p>Vous pouvez continuer à en charger d'autres</p>