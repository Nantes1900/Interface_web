<br/>
    <?php if($success){ ?>
            <div class="message success">
    <?php }else{ ?>
            <div class="message error">
    <?php } ?>
        <?php echo $message; ?>
        <?php echo img(array('src'=>'assets/utils/close.png','alt'=>'fermer','width'=>'4%', 'onclick'=>'ok_message()')); ?>
    </div>
<br/>
