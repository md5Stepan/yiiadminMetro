<?php

class DefaultController extends Controller
{
        public $layout = '//layouts/column2';
        
        /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
		);
	}
        
        /**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
                        array('allow',
                                'actions'=>array('login','error','logout'),
                                'users'=>array('*'),
                        ),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index','delivery','settings'),
				'users'=>array('@'),
                                'expression'=>'AdmAccess::model()->accessAdmin()'
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
        /**
         * Настройки
         */
        public function actionSettings(){
            $model = Settings::model()->findAll(array('order'=>'title_name'));
            $this->render('settings',array('model'=>$model));
        }
        
        /**
         * Рассылка
         */
        public function actionDelivery(){
            $model = new Delivery;
            if(!empty($_POST['Delivery'])){
                $model->attributes = $_POST['Delivery'];
                $model->date_create = date('Y-m-d H:i:s');
                if($model->save())
                    Yii::app()->user->setFlash('apply','Задание выполнено');
            }
            $this->render('delivery',array('model'=>$model));
        }
        
        /**
         * Главная страница админ панели
         */
	public function actionIndex()
	{
		$this->render('index');
	}
        
        /**
         * Вывод ошибки
         */
        public function actionError()
	{
		$this->renderPartial('error');
	}
        
        /**
         * Авторизация пользователя
         */
        public function actionLogin()
        {
            $model=new LoginFormAdmin;

            // if it is ajax validation request
            if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
            {
                    echo CActiveForm::validate($model);
                    Yii::app()->end();
            }

            // collect user input data
            if(isset($_POST['LoginFormAdmin']))
            {
                    $model->attributes=$_POST['LoginFormAdmin'];
                    // validate user input and redirect to the previous page if valid
                    if($model->validate() && $model->login())
                            $this->redirect(array('/admin'));
            }
            $this->renderPartial('login',array('model'=>$model));
        }
        
        /**
	 * Сброс авторизации
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(array('/admin'));
	}
}