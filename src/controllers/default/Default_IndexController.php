<?php

class Default_Default_IndexController extends Abstract_Abstract_AbstractController
{
    public function indexAction()
    {
        return $this->_view->render('index');
    }
}

