<?php

class Frontend_Abstract_AbstractController extends Abstract_Abstract_AbstractController
{
    
    public function preDispatch()
    {
		parent::preDispatch();
        
        $this->resetGlobalViewByConfig();
    }
}
