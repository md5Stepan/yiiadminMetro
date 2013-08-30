<?php

class AdmAccess
{
    private static $_model = array();
    
    public static function model($className=__CLASS__)
    {
        if(empty(self::$_model[$className]))
            self::$_model[$className] = new $className;
        return self::$_model[$className];
    }
    
    /**
     * Выборка пользователя для авторизации
     * @param string $login
     * @return object
     */
    public function getUserForLogin($login){
        return Admins::model()->find('login=:login',
                        array(
                            ':login'=>$login,
                        ));
    }
    
    /**
     * Хеш пароля
     * @param string $password
     * @param string $email
     * @return string
     */
    public function getHashPasswd($password, $email){
        return md5($password.md5($email));
    }
    
    
    /**
     * Доступ для админ панели
     * @return boolean
     */
    public function accessAdmin(){
        return (Yii::app()->user->isGuest)? false: true;
    }
    
    /**
     * Определение класса для меню
     * @param string $controller
     * @param string $action
     * @return string
     */
    public function classOfMenu($controller, $action=false){
        if($action){
            if(Yii::app()->controller->id == $controller && Yii::app()->controller->action->id == $action)
                return 'active';
        }
        elseif(is_array($controller)){
            if(in_array(Yii::app()->controller->id, $controller))
                return 'active';  
        }
        elseif(Yii::app()->controller->id == $controller)
            return 'active';
        return '';
    }
    
    /**
     * Булевая переменная
     * @param boolean/null $num
     * @return int
     */
    public function getBoolean($num = NULL,$null=false){
        $switch = array(0=>'Выкл',1=>'Вкл');
        if($num == NULL){
            return ($null)? array_merge(array(''=>''),$switch): $switch;
        }
        return $switch[$num];
    }
}