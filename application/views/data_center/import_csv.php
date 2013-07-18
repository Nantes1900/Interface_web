
<h1 class="hint">
    <?php echo $this->lang->line('csv_title'); ?>
    <span>
        <?php echo $this->lang->line('csv_title_hint'); ?>
    </span>
</h1>

<p><?php echo $error; ?></p>

<?php echo form_open_multipart('data_center/import_csv/do_upload'); ?>

<table>
    <tr>
    <input type="radio" name="transaction" value="FALSE" checked><?php echo $this->lang->line('csv_no_transaction'); ?><br>
    <input type="radio" name="transaction" value="TRUE"><?php echo $this->lang->line('csv_transaction'); ?>
    </tr>
    <tr><td><input type="file" name="csv_file"></td></tr>

    <tr><td><input type="submit" value="<?php echo $this->lang->line('csv_import_button'); ?>" /><tr><td>

</table>