<?php

class Abstract_Abstract_AbstractController extends EhrlichAndreas_Mvc_Controller
{
    
    public function preDispatch()
    {
        $this->resetLocalViewByConfig();
        
        if (! isset($this->_view->invokeParams))
        {
            $invokeParams = $this->getRequestInvokeParams();

            $this->_view->assign('invokeParams', $invokeParams);
        }
    }
    
    public function resetLocalViewByConfig()
    {
        $viewConfig = $this->getViewConfigForRequest();
        
        if (!empty($viewConfig))
        {
            $view = new EhrlichAndreas_Mvc_View();

            $view->addConfig($viewConfig);

            $this->setView($view);
        }
    }
    
    public function resetGlobalViewByConfig()
    {
        $viewConfig = $this->getViewConfigForRequest();
        
        if (!empty($viewConfig))
        {
            $mvc = EhrlichAndreas_Mvc_FrontController::getInstance();

            $mvc->addViewConfig($viewConfig);
        }
    }
    
    public function getViewConfigForRequest()
    {
        $invokeParams = $this->getRequest()->getParams();
        
        unset($invokeParams['bootstrap']);
        
        unset($invokeParams['_optionsDb']);

        unset($invokeParams['__NAMESPACE__']);

        unset($invokeParams['__CONTROLLER__']);

        unset($invokeParams['__ACTION__']);
        
        $module = $invokeParams['module'];
        
        $submodule = $invokeParams['submodule'];
        
        $config = EhrlichAndreas_Mvc_Registry::get('config');
        
        $viewConfig = false;
            
        $viewConfigDefault = (array) $config['view'];
        
        if (!isset($config['modules']))
        {
            return false;
        }
        
        if (!isset($config['modules'][$module]))
        {
            return false;
        }
        
        if (!isset($config['modules'][$module]['view']))
        {
            if (!isset($config['modules'][$module]['submodules']))
            {
                return false;
            }
            
            if (!isset($config['modules'][$module]['submodules'][$submodule]))
            {
                return false;
            }
            
            if (!isset($config['modules'][$module]['submodules'][$submodule]['view']))
            {
                return false;
            }
        }
        
        if (isset($config['modules'][$module]['submodules'][$submodule]['view']))
        {
            $viewConfigSubmodule = (array) $config['modules'][$module]['submodules'][$submodule]['view'];
            
            $viewConfig = array_merge($viewConfigDefault, $viewConfigSubmodule);
        }
        elseif (isset($config['modules'][$module]['view']))
        {
            $viewConfigModule = (array) $config['modules'][$module]['view'];
            
            $viewConfig = array_merge($viewConfigDefault, $viewConfigModule);
        }
        
        if ($viewConfig !== false)
        {
            $arrayDiff = array_diff_assoc($viewConfig, $viewConfigDefault);
            
            if (!empty($arrayDiff))
            {
                return $viewConfig;
            }
        }
        
        return false;
    }
    
    /**
     * 
     * @return array
     */
    public function getRequestInvokeParams()
    {
        $request = EhrlichAndreas_Mvc_FrontController::getInstance()->getRequest();
        
        if (is_null($request))
        {
            $invokeParams = $this->getRequest()->getParams();
        }
        else
        {
            $invokeParams = $request->getParams();
        }
        
        unset($invokeParams['bootstrap']);
        
        unset($invokeParams['_optionsDb']);

        unset($invokeParams['__NAMESPACE__']);

        unset($invokeParams['__CONTROLLER__']);

        unset($invokeParams['__ACTION__']);
        
		if (get_magic_quotes_gpc())
        {
			$invokeParams = json_decode(stripslashes(json_encode($invokeParams)), true);
		}
        
        return $invokeParams;
    }
    
    /**
     * 
     * @param string $key
     * @return EhrlichAndreas_Db_Adapter_Abstract
     */
    public function getDbConnection($key = 'default')
    {
        $index = 'dbconnection' . $key;
        
        if (! EhrlichAndreas_Mvc_Registry::isRegistered($index))
        {
            $config = EhrlichAndreas_Mvc_Registry::get('config');
            
            if (isset($config['db'][$key]))
            {
                $dbConfig = $config['db'][$key];

                $dbConnection = EhrlichAndreas_Db_Db::factory($dbConfig);
                
                EhrlichAndreas_Mvc_Registry::set($index, $dbConnection);
                
                return $dbConnection;
            }
        }
        
        return EhrlichAndreas_Mvc_Registry::get($index);
    }
}

