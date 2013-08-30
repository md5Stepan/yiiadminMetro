<?php 
ini_set('display_errors',1);

class CustomMain
{
    public $dir_constructs = '/protected/modules/admin/controllers/';
    public $dir_views = '/protected/modules/admin/views/';
    public $remakeControllers = array(
        // Комментируем не нужное
        '\'postOnly\s\+\sdelete\''=>"//'postOnly + delete'",
        // Прова для действий
        'public\sfunction\saccessRules\(\)\s+\{(.*?)\}\s+\/\*\*\s+\*\sDisplays\sa\s'=>"public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('view','create','update','admin','delete'),
				'users'=>array('@'),
                                'expression'=>'AdmAccess::model()->accessAdmin()'
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
	/**
	 * Displays a ",
        // Удаляем действие Index
        '\/\*\*\s+\*\sLists\sall\smodels\.\s+\*\/\s+public\sfunction\sactionIndex\(\)\s+\{(.*?)\}\s+\/\*\*\s+\*\sManages'=>'/**
	 * Manages',
    );
    
    public $remakeViews = array(
        /**
         *  Форма
         */
        '_form.php'=>array(
            '\s+<div\sclass=\"form\">'=>'',
            '\'enableAjaxValidation\'=>false,'=>"'enableAjaxValidation'=>false,
        'htmlOptions'=>array('class'=>'form-horizontal'),",
            '<p\sclass="note">.*\.</p>'=>'<p class="alert"><span class="required">*</span> Поля обязательные для заполнения.</p>',
            '<\?php\secho\s\$form->errorSummary\(\$model\);\s\?>'=>'<?php if($model->hasErrors()):?>
        <div class="alert alert-error">
                <button class="close" data-dismiss="alert"></button>
                <?php echo $form->errorSummary($model); ?>
        </div>
        <?php endif;?>',
            '<div\sclass=\"row\">'=>'<div class="control-group">
	    <label class="control-label">',
            '<\?php\secho\s\$form->labelEx\(\$model,\'(\w+)\'\);\s\?>'=>'<?php echo $form->labelEx($model,\'$1\'); ?>
	    </label>
	    <div class="controls">',
            '<\?php\secho\s\$form->error\(\$model,\'(\w+)\'\);\s\?>'=>'<?php echo $form->error($model,\'$1\',array(\'class\'=>\'alert alert-error\')); ?>
	    </div>',
            '<div\sclass="row\sbuttons">\s+<\?php\secho\sCHtml::submitButton\(\$model->isNewRecord\s\?\s\'Create\'\s:\s\'Save\'\);\s\?>\s+<\/div>'=>'<div class="form-actions">
	    <?php echo CHtml::submitButton($model->isNewRecord ? \'Добавить\' : \'Сохранить\',array(\'class\'=>\'btn blue\')); ?>
	</div>',
            '\s+<\/div><\!--\sform\s-->'=>'',
        ),
        
        
        
        /*
         *  Поиск
         */
        '_search.php'=>array(
            '\s+<div\sclass="wide\sform">'=>'',
            '\'method\'=>\'get\','=>"'method'=>'get',
        'htmlOptions'=>array('class'=>'form-horizontal'),",
            '<div\sclass="row">'=>'<div class="control-group">
	    <label class="control-label">',
            '<\?php\secho\s\$form->label\(\$model,\'(\w+)\'\);\s\?>'=>'<?php echo $form->label($model,\'$1\'); ?>
	    </label>
	    <div class="controls">',
            '<\?php\secho\s\$form->(\w+)\(\$model,\'(\w+)\'(|,array\(([^\)]*)\))\);\s\?>\s+<\/div>'=>'<?php echo $form->$1($model,\'$2\',array(\'class\'=>\'span12\')); ?>
	    </div>
	</div>',
            '<div\sclass=\"row\sbuttons\">\s+<\?php\secho\sCHtml::submitButton\(\'Search\'\);\s\?>'=>'<div class="control-group">
	    <?php echo CHtml::submitButton(\'Поиск\',array(\'class\'=>\'btn blue\')); ?>',
            '\s+<\/div><\!--\ssearch-form\s-->'=>'',
        ),
        
        
        
        /**
         *  Менеджер
         */
        'admin.php'=>array(
            // Бредкрамбс и title
            '\$this->breadcrumbs=array\(\s+\'(\w+)\'=>array\(\'index\'\),\s+\'(\w+)\',\s+\);'=>'$this->pageTitle = \'$1\';
$this->breadcrumbs=array(
	\'$2 $1\',
);',
            // Менюшка
            '\$this->menu=array\(.*?\);\s+Yii::app'=>'$this->menu=array(
	array(\'label\'=>\'Добавить\', \'url\'=>array(\'create\')),
);

Yii::app',
            // Шапка и Поиск
            '<h1>(\w+)\s(\w+)<\/h1>\s+<p>.*<\/div><\!--\ssearch-form\s-->'=>'<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-cloud"></i>$1 $2</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body">
                
                <div class="portlet box grey span4">
                    <div class="portlet-title">
                        <div class="caption"><i class="icon-search"></i>
                        <?php echo CHtml::link(\'Поиск\',\'#\',array(\'class\'=>\'search-button\',\'style\'=>\'color:#eee;\')); ?>
                        </div>
                    </div>
                    <div class="portlet-body search-form" style="display:none">
                        <?php $this->renderPartial(\'_search\',array(
                            \'model\'=>$model,
                        )); ?>  
                    </div>
                </div>
                <!-- search-form -->',
            // Подвал
            '<\?php\s\$this->widget\((.*?)\);\s\?>'=>'<?php $this->widget($1); ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>',
            // Свой грид
            'zii\.widgets\.grid\.CGridView'=>'AdmGridView',
        ),
        
        
        
        
        /**
         *  Добавление
         */
        'create.php'=>array(
            // Бредкрамбс и title
            '\$this->breadcrumbs=array\(\s+\'(\w+)\'=>array\(\'index\'\),\s+\'(\w+)\',\s+\);'=>'$this->pageTitle = \'$1\';
$this->breadcrumbs=array(
	\'$2 $1\',
);',
            // Менюшка
            '\$this->menu=array\(.*?\);\s+\?>\s+<h1>'=>'$this->menu=array(
	array(\'label\'=>\'Менеджер\', \'url\'=>array(\'admin\')),
);
?>',
            //Контент
            '(\w+)\s(\w+)<\/h1>\s+.*\?>'=>'

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-plus"></i>Добавить</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <?php echo $this->renderPartial(\'_form\', array(\'model\'=>$model)); ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>',
        ),
        
        
        
        
        /**
         *  Изменение
         */
        'update.php'=>array(
            '\$this->breadcrumbs=array\(\s+\'(\w+)\'=>array\(\'index\'\),\s+\$model->id=>array\(\'view\',\'id\'=>\$model->id\),\s+\'Update\',\s+\);'=>'$this->pageTitle = \'$1\';
$this->breadcrumbs=array(
	\'Менеджер $1\'=>array(\'admin\'),
	CHtml::encode($model->id)=>array(\'view\',\'id\'=>$model->id),
	\'Изменить\',
);',
            '\$this->menu=array\(\s+.*?\);\s+\?>\s+<h1>'=>'$this->menu=array(
	array(\'label\'=>\'Добавить\', \'url\'=>array(\'create\')),
	array(\'label\'=>\'Просмотр\', \'url\'=>array(\'view\', \'id\'=>$model->id)),
	array(\'label\'=>\'Менеджер\', \'url\'=>array(\'admin\')),
);
?>',
            '(\w+)\s(\w+)\s<\?php\secho\s.*\?><\/h1>\s+<\?php.*\?>'=>'

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-plus"></i>Изменить</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <?php echo $this->renderPartial(\'_form\', array(\'model\'=>$model)); ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>',
        ),
        
        
        
        /**
         *  Просмотр
         */
        'view.php'=>array(
            '\$this->breadcrumbs=array\(\s+\'(\w+)\'=>array\(\'index\'\),\s+\$model->id,\s+\);'=>'$this->pageTitle = \'$1\';
$this->breadcrumbs=array(
	\'Менеджер $1\'=>array(\'admin\'),
	CHtml::encode($model->id),
);',
            '\$this->menu=array\(.*?\?>\s+<h1>'=>'$this->menu=array(
	array(\'label\'=>\'Добавить\', \'url\'=>array(\'create\')),
	array(\'label\'=>\'Изменить\', \'url\'=>array(\'update\', \'id\'=>$model->id)),
	array(\'label\'=>\'Удалить\', \'url\'=>array(\'delete\', \'id\'=>$model->id)),
	array(\'label\'=>\'Менеджер\', \'url\'=>array(\'admin\')),
);
?>',
            '(\w+)\s(\w+)\s\#<\?php\secho\s\$model->id;\s\?><\/h1>'=>'

<div class="row-fluid">
    <div class="span12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"><i class="icon-plus"></i>Просмотреть</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body">',
            '\)\);\s\?>'=>')); ?>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>',
        ),
    );
    public $fileView = array(
        '_form.php',
        '_search.php',
        'admin.php',
        'create.php',
        'update.php',
        'view.php',
    );
    
    private $model = false;
    
    /**
     * Конструктор
     */
    public function __construct($boot=true){
        if($boot){
            $this->pr('Старт конструктора');

            $this->pr('Создаем экземпляр модели');
            $this->model = new Model;
            
            $this->remakeControllers();
            $this->remakeViews();

            $this->pr('Конец конструктора');
        }
    }
    
    /**
     * Вывод строки
     * @param string $str строка на вывод
     */
    public function pr($str){
        echo $str.PHP_EOL;
    }
    
    /**
     * Переделка контроллеров
     */
    private function remakeControllers(){
        $this->pr('++++++++++++++++++++++++++++++++');
        $this->pr('+++ Переделка контроллеров +++');
        $this->pr('Получаем список контроллеров');
        $ctrl = $this->model->scanDir($this->dir_constructs);
        $this->pr('Получено '.count($ctrl).' контроллеров');
        $this->pr('++++++++++++++++++++++++++++++++');
        
        if(count($ctrl)>0)
            foreach($ctrl as $file)
            {
                
                if($this->model->isFile($this->dir_constructs.$file))
                {
                    $this->pr('--- Переделываем контроллер '.$file);
                    $contents = file_get_contents(dirname(__FILE__).$this->dir_constructs.$file);
                    $remake = $this->model->remakeCtrl($contents);
                    file_put_contents(dirname(__FILE__).$this->dir_constructs.$file, $remake);
                }
                else
                    $this->pr('!!! ['.$file.'] Это не файл !!!');
            }
        $this->pr('////////////////////////////////');
        $this->pr('');
    }
    
    /**
     * Переделка представлений
     */
    private function remakeViews(){
        $this->pr('++++++++++++++++++++++++++++++++');
        $this->pr('+++ Переделка представлений +++');
        $this->pr('Получаем список каталогов представления');
        $dir = $this->model->scanDir($this->dir_views);
        $this->pr('Получено '.count($dir).' каталогов представления');
        $this->pr('++++++++++++++++++++++++++++++++');
        
        if(count($dir)>0)
            foreach($dir as $dirname){
                $views = $this->model->scanDir($this->dir_views.$dirname.'/');
                $this->pr('=== Получено '.count($views).' шаблонов из каталога '.$dirname);
                if(count($views)>0)
                    foreach($views as $tmpl)
                    {   
                        if($this->model->isFile($this->dir_views.$dirname.'/'.$tmpl)){
                            if(in_array($tmpl,$this->fileView)){
                                $this->pr('--- Переделываем представление '.$tmpl);
                                $contents = file_get_contents(dirname(__FILE__).$this->dir_views.$dirname.'/'.$tmpl);
                                $remake = $this->model->remakeView($tmpl,$contents);
                                /*if($tmpl == '_search.php' && $dirname == 'products')
                                    echo $remake;*/
                                file_put_contents(dirname(__FILE__).$this->dir_views.$dirname.'/'.$tmpl, $remake);
                            }
                        }
                        else
                            $this->pr('!!! ['.$file.'] Это не файл !!!');
                    }
            }
        $this->pr('////////////////////////////////');
        $this->pr('');
    }
}

class Model extends CustomMain
{   
    public function __construct() {
        parent::__construct(false);
    }
    /**
     * Сканирование директории
     * @param string $dir поть к каталогу
     * @return array
     */
    public function scanDir($dir){
        return array_diff(scandir(dirname(__FILE__).$dir),array('..','.'));
    }
    
    /**
     * Проверяет на сущестрование и проверяет что путь к файлу
     * @param string $dir путь к файлу
     * @return boolean
     */
    public function isFile($dir){
        return (file_exists(dirname(__FILE__).$dir) && is_file(dirname(__FILE__).$dir))? true: false;
    }
    
    /**
     * Переделываем контроллер
     * @param string $content
     * @return string
     */
    public function remakeCtrl($content){
        if(count($this->remakeControllers)>0)
            foreach($this->remakeControllers as $pattern=>$replace){
                $content = preg_replace('#'.$pattern.'#iUms',$replace,$content);
            }
        return $content;
    }
    
    public function remakeView($file,$content){
        if(count($this->remakeViews[$file])>0)
            foreach($this->remakeViews[$file] as $pattern=>$replace){
                $content = preg_replace('#'.$pattern.'#iUms',$replace,$content);
            }
        return $content;
    }
}

new CustomMain();