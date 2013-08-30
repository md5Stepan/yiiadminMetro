<?php

class AdmGridView extends Portlet
{
    public $id = 'adm_grid_0';
    public $dataProvider;
    public $filter;
    public $columns;
    public $title = 'Admin Grid View';
    public $attrClass = 'grid_8';
    public $switchFormRedirect = false;
    public $routeSort = false;
    public $positionButton = false;
    public $positionData = array(
        'routeUp'=>'/admin/paramValue/updatePosition?action=up&id=$data->id',
        'routeDown'=>'/admin/paramValue/updatePosition?action=down&id=$data->id',
    );
    
    public function renderContent(){
        //var_dump($this->routeSort); 
        $sort = $this->getSorting();
        $this->dataProvider->setSort(array('defaultOrder'=>($sort['attr'] == '_desc')?$sort['column'].' DESC': $sort['column']));
        $this->render('admGridView',
                array(
                    'title'=>$this->title,
                    'dataProvider'=>$this->dataProvider,
                    'cssRows'=>0,
                    'tbodyId'=>$this->id,
                    'thisGrid'=>$this,
                    'urlRoute'=>$this->getRoute(),
                    'switchFormRedirect'=>$this->switchFormRedirect,
                    'routeSort'=>$this->routeSort,
                    'sort'=>$sort
                ));
        
    }
    
    /**
     * Нужно ли выводить сортировку колонки
     * @param int $i
     * @return boolean
     */
    public function isSorting($i){
        if(is_array($this->columns[$i])){
            if(!empty($this->columns[$i]['value']) || !empty($this->columns[$i]['class']))
                return true;
        }
        return false;
    }
    
    /**
     * Возвращает данные для сортировки
     * @return array
     */
    public function getSorting(){
        if(!empty($_GET['sort']) && isset($_GET['field']) && !empty($this->columns[$_GET['field']]['name'])){
            if($this->routeSort && !empty($_GET['grid']))
                if($this->routeSort != $_GET['grid']){
                    $column = is_array($this->columns[0])? $this->columns[0]['name']:$this->columns[0];
                    return array(
                        'attr'=>'_asc',
                        'field'=>0,
                        'column'=>$column,
                    );
                }
                
            $column = is_array($this->columns[$_GET['field']])? $this->columns[$_GET['field']]['name']:$this->columns[$_GET['field']];
            return array(
                'attr'=>'_'.CHtml::encode($_GET['sort']),
                'field'=>CHtml::encode($_GET['field']),
                'column'=>$column,
            );
        }
        $column = is_array($this->columns[0])? $this->columns[0]['name']:$this->columns[0];
        return array(
            'attr'=>'_asc',
            'field'=>0,
            'column'=>$column,
        );
    }
    
    /**
     * Возвращает значение колонки
     * @param object $data
     * @param int $num
     * @return string
     */
    public function getColumnValue($data,$num){
        if(is_array($this->columns[$num])){
            
            // Кнопки управления
            if(!empty($this->columns[$num]['class']))
                if($this->columns[$num]['class'] == 'CButtonColumn')
                    return $this->getButton($data, $num);
            
            $name = $this->columns[$num]['name'];
            if(!empty($this->columns[$num]['type']))
                if($this->columns[$num]['type'] == 'raw'){
                    if(!empty($this->columns[$num]['value']))
                        return $this->execValue($data, $this->columns[$num]['value'],false);
                    return $data->$name;
                }
            
            if(!empty($this->columns[$num]['value']))
                return $this->execValue($data, $this->columns[$num]['value']);
            return CHtml::encode($data->$name);
        }
        return CHtml::encode($data->{$this->columns[$num]});
    }
    
    /**
     * Key колонки
     * @param int $num
     * @return string
     */
    public function getColumnName($num){
        if(is_array($this->columns[$num])){
            if(!empty($this->columns[$num]['class']))
                return '';
            return CHtml::activeLabel($this->dataProvider->model,$this->columns[$num]['name']);
        }
        return CHtml::activeLabel($this->dataProvider->model,$this->columns[$num]);
    }
    
    /**
     * Выполняет действия для значения колонки
     * @param object $data
     * @param string $value
     * @param boolean $encode
     * @return string
     */
    private function execValue($data, $value, $encode=true){ 
        ob_start();
        if($encode == true)
            eval('echo CHtml::encode('.$value.');');
        else
            eval('echo '.$value.';');
        $outValue = ob_get_contents();
        ob_end_clean();
        return $outValue;
    }
    
    /**
     * Основной url адрес
     * @return string
     */
    private function getRoute(){
        $get = !empty($_GET['id'])? '/id/'.intval($_GET['id']):'';
        return '/admin/'.Yii::app()->controller->id.'/'.Yii::app()->controller->action->id.$get;
    }
    
    private function getButton($data, $num)
    {
        // Определяем шаблон
        if(!empty($this->columns[$num]['template'])){
            preg_match_all('#{(.*)}#iUm', $this->columns[$num]['template'],$template);
            if(count($template) == 2)
                $template = $template[1];
        }
        else
            $template = array('view','update','delete');
        
        $buttonsData = array(
            'view'=>array(
                'label'=>'<i class="icon-file"></i>',
                'url'=>'Yii::app()->createUrl(\'/admin/\'.$controller.\'/view/\',array(\'id\'=>intval($id)))',
                'color'=>'green',
            ),
            'update'=>array(
                'label'=>'<i class="icon-pencil"></i>',
                'url'=>'Yii::app()->createUrl(\'/admin/\'.$controller.\'/update/\',array(\'id\'=>intval($id)))',
                'color'=>'blue',
            ),
            'delete'=>array(
                'label'=>'<i class="icon-trash"></i>',
                'url'=>'Yii::app()->createUrl(\'/admin/\'.$controller.\'/delete/\',array(\'id\'=>intval($id)))',
                'color'=>'red',
            )
        );
        
        foreach($template as $temp)
                $buttons[$temp] = !empty($buttonsData[$temp])? $buttonsData[$temp]: array('label'=>'','url'=>'');
        
        if(!empty($this->columns[$num]['buttons']))
            if(is_array($this->columns[$num]['buttons'])){
                foreach($this->columns[$num]['buttons'] as $key=>$value)
                    $buttons[$key] = $value;
            }
        
        return $this->render('admGridViewButton',
                array(
                    'id'=>$data->id,
                    'controller'=>lcfirst($this->dataProvider->modelClass),
                    'buttons'=>$buttons,
                    'data'=>$data,
                    'positionButton'=>($this->positionButton != false)? $this->positionData: false,
                ));
    }
}
