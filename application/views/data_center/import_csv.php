<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" > 

	<h1>Importer plusieurs élément via un fichier CSV</h1>
        
        <p><?php echo $error;?></p>
        
        <?php echo form_open_multipart('data_center/import_csv/do_upload'); ?>
        
        <table>
            
            <tr><td><input type="file" name="csv_file"</td></tr>
            
            <tr><td><input type="submit" value="Importer" /><tr><td>
            
        </table>