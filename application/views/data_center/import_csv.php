<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

	<h1>Importer plusieurs élément via un fichier CSV</h1>
        
        <p><?php echo $error;?></p>
        
        <?php echo form_open_multipart('data_center/import_csv/do_upload'); ?>
        
        <table>
            <tr>
                <input type="radio" name="transaction" value="FALSE" checked>Importer les informations au mieux (ce qui ne contient pas d'erreur sera enregistré)<br>
                <input type="radio" name="transaction" value="TRUE">Ne rien importer s'il y a la moindre erreur
            </tr>
            <tr><td><input type="file" name="csv_file"</td></tr>
            
            <tr><td><input type="submit" value="Importer" /><tr><td>
            
        </table>