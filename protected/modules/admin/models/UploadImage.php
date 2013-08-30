<?php

class UploadImage extends CFormModel
{
    public $file;
    public static $instanse = false;
    
    /**
     * Синглатон модели
     * @return object
     */
    public static function model(){
        if(!self::$instanse)
            self::$instanse = new self;
        return self::$instanse;
    }            
    
    /**
     * Правила валидации
     * @return array
     */
    public function rules(){
        return array(
            //устанавливаем правила для файла, позволяющие загружать
            // только картинки!
            array('file', 'file', 'types'=>'jpg, gif, png, jpeg'),
        );
    }
    
    /**
     * Генерация нового имени
     * @return string
     */
    public function getNewName(){
        return md5(uniqid());
    }
    
    /**
     * Проверка на существование файла
     * @param stinrg $dir_file
     * @return boolean
     */
    public function isFile($dir_file){
        return (is_file(Yii::getPathOfAlias('webroot').$dir_file) && file_exists(Yii::getPathOfAlias('webroot').$dir_file))? true: false;
    }
    
    /**
     * Вывод изображения
     * @param string $dir_file
     * @param string $default
     * @return string
     */
    public function getImage($dir_file, $default='<i>Пусто</i>'){
        return ($this->isFile($dir_file))? CHtml::image($dir_file): $default;
    }
    
    /**
     * Удаление файла
     * @param stinrg $dir_file
     */
    public function deleteFile($dir_file){
        if($this->isFile($dir_file))
            unlink(Yii::getPathOfAlias('webroot').$dir_file);
    }
    
    /**
     * Умная обрезка изображения
     * @param string $preview
     * @param int/float $width
     * @param int/float $height
     * @return \Iwi
     */
    public function genCropFile($preview,$width,$height){
        Yii::import('ext.iwi.Iwi');

        $picture = new Iwi($preview);
        $picture_aspect_ratio = $picture->width/$picture->height;

        if ($picture->width<=$picture->height){
            $picture->resize($width*(1/$picture_aspect_ratio),$height,Iwi::WIDTH);
            $picture->crop($width,$height);
        }else  if ($picture->width>$picture->height){
            $picture->resize($width,$height*$picture_aspect_ratio,Iwi::HEIGHT);                
            $picture->crop($width,$height);
        }

        return $picture;
    }
}
