
<h1><?php echo $this->lang->line('common_download_title'); ?></h1>

<p><?php echo $this->lang->line('common_download_presentation'); ?></p>

<h2><?php echo $this->lang->line('common_download_csv'); ?></h2>

<p>
    <?php echo $this->lang->line('common_download_csv_pres'); ?>
</p>

<?php echo form_open('download/download/do_download'); ?>
            <?php echo $this->lang->line('common_download_csv_ods'); ?>
            <select name="fileName">
                <option value="template-objet.ods"><?php echo $this->lang->line('common_objet'); ?></option>
                <option value="template-relation.ods"><?php echo $this->lang->line('common_obj_link'); ?></option>
                <option value="template-ressource-texte.ods"><?php echo $this->lang->line('common_ressource_txt'); ?></option>
                <option value="template-ressource-graphique.ods"><?php echo $this->lang->line('common_ressource_img'); ?></option>
                <option value="template-ressource-video.ods"><?php echo $this->lang->line('common_ressource_vid'); ?></option>
                <option value="template-documentation.ods"><?php echo $this->lang->line('common_doc_detail'); ?></option>
            </select>
            <input type="submit" value="<?php echo $this->lang->line('common_do_download_button'); ?>" />
</form>