<?php

class Portlet extends CWidget
{
    public $visible=true;
    
    public function getViewPath()
    {
        $themeManager=Yii::app()->themeManager;
        return $themeManager->basePath.DIRECTORY_SEPARATOR.Yii::app()->theme->name.DIRECTORY_SEPARATOR.'views/portlets';
    }

    public function init()
    {
        if(!$this->visible)
            return;
    }

    public function run()
    {
        if(!$this->visible)
            return;
        $this->renderContent();
    }

    protected function renderContent()
    {
    }
}