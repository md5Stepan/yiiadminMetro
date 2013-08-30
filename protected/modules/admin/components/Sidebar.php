<?php

class Sidebar extends Portlet
{
    public $menu = NULL;
    public function renderContent(){
        $this->render('sidebar',array('menu'=>$this->menu));
    }
}
