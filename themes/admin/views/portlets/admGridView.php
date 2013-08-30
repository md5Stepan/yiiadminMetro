<?php 
$redirectForm = ($switchFormRedirect == true)? '': "+'?'+$('form').serialize()";
Yii::app()->clientScript->registerScript('adm-grid-view',"
    $('.adm-sort').click(function(){
        var sortAttr = $(this).attr('attr-sort');
        
        if(sortAttr == '_asc')
            sortAttr = 'desc';
        else
            sortAttr = 'asc';
        
        var routeSort = '/grid/'+$(this).attr('route-sort');
        window.location = '".$urlRoute."/sort/'+sortAttr+'/field/'+$(this).attr('column-id')+routeSort".$redirectForm.";
    });
");
Yii::app()->clientScript->registerCssFile('/assets/plugins/data-tables/DT_bootstrap.css');
?>

<table class="table table-striped table-hover table-bordered dataTable">
    <thead>
        <tr role="row">
            <?php for($i=0; $i<count($thisGrid->columns); $i++):?>
                <?php if($thisGrid->isSorting($i)):?>
                <th <?php echo (count($thisGrid->columns)-1 == $i)? 'style=width:207px;': '';?>>
                <?php else:?>
                <th class="sorting<?php echo ($i == $sort['field'])? $sort['attr']: '';?> adm-sort" column-id="<?php echo $i;?>" route-sort="<?php echo $routeSort;?>" attr-sort="<?php echo ($i == $sort['field'])? $sort['attr']: '_desc';?>">
                <?php endif;?>
                    <?php echo $thisGrid->getColumnName($i);?>
                </th>
            <?php endfor;?>
        </tr>
    </thead>
									
    <tbody role="alert" aria-live="polite" aria-relevant="all">
        <?php if($dataProvider->itemCount > 0):?>
            <?php foreach($dataProvider->getData() as $unit):?>
                <tr class="<?php if($cssRows == 0){ echo 'odd'; $cssRows++;}else{ echo 'even'; $cssRows--;}?>">
                <?php for($i=0; $i<count($thisGrid->columns); $i++):?>
                    <td class="<?php if($i == 0){ echo 'sorting_1';}?>"><?php echo $thisGrid->getColumnValue($unit, $i);?></td>
                <?php endfor;?>
                </tr>
            <?php endforeach;?>
        <?php else:?>
                <tr>
                    <td colspan="<?php echo count($thisGrid->columns);?>">
                        <i>Нет результатов.</i>
                    </td>
                </tr>
        <?php endif;?>
    </tbody>
</table>

<div class="dataTables_info" id="DataTables_Table_1_info">
    Всего <?php echo Yii::t('adm_grid_count', '{n} записи.|{n} записей.', CHtml::encode($dataProvider->totalItemCount));?>
</div>
<div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
    <?php $this->widget('CLinkPager',array('pages'=>$dataProvider->getPagination()));?>
</div>
        