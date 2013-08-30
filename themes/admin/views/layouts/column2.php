<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<!-- BEGIN PAGE HEADER-->
<div class="row-fluid">
        <div class="span12"> 
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">
                        <?php echo CHtml::encode($this->pageTitle);?>
                </h3>
                
                <?php if(count($this->breadcrumbs)>0): $col=0;?>
                <ul class="breadcrumb">
                        <li>
                                <i class="icon-home"></i>
                                <?php echo CHtml::link('Главная',array('/admin'));?>
                                <i class="icon-angle-right"></i>
                        </li>
                        <?php foreach($this->breadcrumbs as $key=>$val):$col++;?>
                            <?php if(is_array($val)):?>
                            <li>
                                <?php echo CHtml::link(CHtml::encode($key),$val);?>
                                <?php if(count($this->breadcrumbs)!=$col):?><i class="icon-angle-right"></i><?php endif;?>
                            </li>
                            <?php else:?>
                            <li>
                                <?php echo CHtml::encode($val);?>
                                <?php if(count($this->breadcrumbs)!=$col):?><i class="icon-angle-right"></i><?php endif;?>
                            </li>
                            <?php endif;?>
                        <?php endforeach;?>
                </ul>
                <?php endif;?>
                <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
</div>
<!-- END PAGE HEADER-->
<div id="container-fluid">
    <?php echo $content;?>
</div>
        
<?php $this->endContent(); ?>