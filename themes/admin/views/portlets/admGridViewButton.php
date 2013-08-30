<span class="btn-group">
    <?php if($positionButton != false):?>
    <a href="<?php echo eval('echo "'.$positionButton['routeUp'].'";');?>" class="btn icn-only black">
        <i class="m-icon-swapup m-icon-white"></i>
    </a>
    <a href="<?php echo eval('echo "'.$positionButton['routeDown'].'";');?>" class="btn icn-only black">
        <i class="m-icon-swapdown m-icon-white"></i>
    </a>
    <?php endif;?>
    
    <?php foreach($buttons as $key=>$unit):?>
    <a href="<?php echo eval('echo '.$unit['url'].';');?>" class="btn <?php echo $unit['color'];?> icn-only">
        <?php echo $unit['label'];?>
    </a>
    <?php endforeach;?>
</span>