<!-- BEGIN SIDEBAR -->
<div class="page-sidebar nav-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->        
        <ul class="page-sidebar-menu">
                <li>
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                        <div class="sidebar-toggler hidden-phone"></div>
                        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                </li>
                <li>
                        <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                        <form class="sidebar-search" action="<?php echo Yii::app()->createUrl('/admin/products/admin');?>" method="GET">
                                <div class="input-box">
                                        <a href="javascript:;" class="remove"></a>
                                        <input type="text" placeholder="Search..." name="Products[title_name_ru]"/>
                                        <input type="button" class="submit" value=" " />
                                </div>
                        </form>
                        <!-- END RESPONSIVE QUICK SEARCH FORM -->
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('default','index');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin');?>">
                        <i class="icon-home"></i> 
                        <span class="title">Главная</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('users');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/users/admin');?>">
                        <i class="icon-user"></i> 
                        <span class="title">Пользователи</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'users')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('brands');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/brands/admin');?>">
                        <i class="icon-compass"></i> 
                        <span class="title">Бренды</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'brands')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('categoryPost');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/categoryPost/admin');?>">
                        <i class="icon-list-alt"></i> 
                        <span class="title">Категории материалов</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'categoryPost')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('categoryBoutique');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/categoryBoutique/admin');?>">
                        <i class="icon-list-ul"></i> 
                        <span class="title">Категории бутика</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'categoryBoutique')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('posts');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/posts/admin');?>">
                        <i class="icon-file"></i> 
                        <span class="title">Материалы</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'posts')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('vacancy');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/vacancy/admin');?>">
                        <i class="icon-male"></i> 
                        <span class="title">Вакансии</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'vacancy')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('season');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/season/admin');?>">
                        <i class="icon-adjust"></i> 
                        <span class="title">Сезоны</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'season')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('params');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/params/admin');?>">
                        <i class="icon-plus-sign-alt"></i> 
                        <span class="title">Параметры</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'params')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('products');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/products/admin');?>">
                        <i class="icon-shopping-cart"></i> 
                        <span class="title">Товары</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'products')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('looks');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/looks/admin');?>">
                        <i class="icon-paper-clip"></i> 
                        <span class="title">Look's</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'looks')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('default','delivery');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/default/delivery');?>">
                        <i class="icon-envelope"></i> 
                        <span class="title">Рассылка</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'delivery')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('banners');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/banners/admin');?>">
                        <i class="icon-barcode"></i> 
                        <span class="title">Баннеры</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'banners')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
                <li class="start <?php echo AdmAccess::model()->classOfMenu('default','settings');?>">
                    <a href="<?php echo Yii::app()->createUrl('/admin/default/settings');?>">
                        <i class="icon-bug"></i> 
                        <span class="title">Настройки</span>
                    </a>
                    <?php if(Yii::app()->controller->id == 'settings')
                            $this->widget('zii.widgets.CMenu', array(
                                    'items'=>$this->menu,
                                    'htmlOptions'=>array('class'=>'sub-menu')
                            ));?>
                </li>
        </ul>
        <!-- END SIDEBAR MENU -->
</div>
<!-- END SIDEBAR -->