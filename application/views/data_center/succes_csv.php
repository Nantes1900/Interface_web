<?php if(!$transaction || ($transaction && !isset($failure['0']))){ ?>
<h3 style="color:green"><?php echo sprintf($this->lang->line('csv_total_success'),$csvType); ?></h3>
<?php } ?>
    
<?php if($transaction && isset($failure['0'])){ ?>
    <h3 style="color:red"><?php echo sprintf($this->lang->line('csv_total_failure'),$csvType, count($failure)); ?></h3>
<?php } ?>    
    
    
<?php if(isset($failure['0'])){ ?>
<p><?php echo sprintf($this->lang->line('csv_partial_success'),$csvType); ?></p>
    <ul>
    <?php foreach($failure as $fail){ echo '<li>'.$fail.'</li>';} ?>
    </ul>
<p>
    <?php echo $this->lang->line('csv_advice'); ?>
</p>
<?php } ?>
<p><?php echo $this->lang->line('csv_continue'); ?></p>