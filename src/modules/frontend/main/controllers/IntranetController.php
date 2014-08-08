<?php

class Frontend_Main_IntranetController extends Frontend_Abstract_AbstractController
{
    /**
     *
     * @var Intranet_UserCms_Module 
     */
    protected $userCmsModule = null;
    
    public function preDispatch()
    {
		parent::preDispatch();
        
        $dbConfig = $this->getDbConnection();
        
        $userCmsModule = new Intranet_UserCms_Module($dbConfig);
        
        $userCmsModule->install();
        
        $this->userCmsModule = $userCmsModule;
    }
    
    public function indexAction()
    {
        return $this->getView()->render('register/index');
    }
    
    public function registrationAction()
    {
        $error = array();
        
        $invokeParams = $this->getRequestInvokeParams();
        
        if ($this->getRequest()->isPost())
        {
            if (!isset($invokeParams['salutation']))
            {
                $error['salutation'][] = 'intranet-frontend-main-intranet-registration-form-error-salutation-set';
            }
            elseif (!is_string($invokeParams['salutation']))
            {
                $error['salutation'][] = 'intranet-frontend-main-intranet-registration-form-error-salutation-string';
            }
            elseif (!in_array($invokeParams['salutation'], array('Herr', 'Frau')))
            {
                $error['salutation'][] = 'intranet-frontend-main-intranet-registration-form-error-salutation-invalid';
            }

            $validateName = new \Zend_Validate_StringLength(3, 200);

            $validateName->setDisableTranslator(true);
            
            if (!isset($invokeParams['firstname']))
            {
                $error['firstname'][] = 'intranet-frontend-main-intranet-registration-form-error-firstname-set';
            }
            elseif (!is_string($invokeParams['firstname']))
            {
                $error['firstname'][] = 'intranet-frontend-main-intranet-registration-form-error-firstname-string';
            }
            elseif (! $validateName->isValid($invokeParams['firstname']))
            {
                $error['firstname'][] = 'intranet-frontend-main-intranet-registration-form-error-firstname-invalid';
            }
            
            if (!isset($invokeParams['secondname']))
            {
                $error['secondname'][] = 'intranet-frontend-main-intranet-registration-form-error-secondname-set';
            }
            elseif (!is_string($invokeParams['secondname']))
            {
                $error['secondname'][] = 'intranet-frontend-main-intranet-registration-form-error-secondname-string';
            }
            elseif (! $validateName->isValid($invokeParams['secondname']))
            {
                $error['secondname'][] = 'intranet-frontend-main-intranet-registration-form-error-secondname-invalid';
            }
            
            $validateEmail = new \Zend_Validate_EmailAddress();

            $validateEmail->setDisableTranslator(true);

            $validateEmail->getHostnameValidator()->setDisableTranslator(true);
            
            if (!isset($invokeParams['email']))
            {
                $error['email'][] = 'intranet-frontend-main-intranet-registration-form-error-email-set';
            }
            elseif (!is_string($invokeParams['email']))
            {
                $error['email'][] = 'intranet-frontend-main-intranet-registration-form-error-email-string';
            }
            elseif (! $validateEmail->isValid($invokeParams['email']))
            {
                $error['email'][] = 'intranet-frontend-main-intranet-registration-form-error-email-invalid';
            }
            
            if (!isset($invokeParams['phonenumber']))
            {
                $error['phonenumber'][] = 'intranet-frontend-main-intranet-registration-form-error-phonenumber-set';
            }
            elseif (!is_string($invokeParams['phonenumber']))
            {
                $error['phonenumber'][] = 'intranet-frontend-main-intranet-registration-form-error-phonenumber-string';
            }
            elseif (! $validateName->isValid($invokeParams['phonenumber']))
            {
                $error['phonenumber'][] = 'intranet-frontend-main-intranet-registration-form-error-phonenumber-invalid';
            }
            
            if (!isset($invokeParams['agent']))
            {
                $error['agent'][] = 'intranet-frontend-main-intranet-registration-form-error-agent-set';
            }
            elseif (!is_string($invokeParams['agent']))
            {
                $error['agent'][] = 'intranet-frontend-main-intranet-registration-form-error-agent-string';
            }
            elseif (! $validateName->isValid($invokeParams['agent']))
            {
                $error['agent'][] = 'intranet-frontend-main-intranet-registration-form-error-agent-invalid';
            }
        }
        
        if ($this->getRequest()->isPost() && count($error) == 0)
        {
            $userCmsModule = $this->userCmsModule;
        
            $userCmsModule->addUserProfile($invokeParams);
            
            unset($invokeParams['salutation']);
            unset($invokeParams['firstname']);
            unset($invokeParams['secondname']);
            unset($invokeParams['email']);
            unset($invokeParams['phonenumber']);
            unset($invokeParams['received']);
            unset($invokeParams['called']);
            unset($invokeParams['agent']);
        }
        
        if (!isset($invokeParams['salutation']))
        {
            $invokeParams['salutation'] = '';
        }
        
        if (!isset($invokeParams['firstname']))
        {
            $invokeParams['firstname'] = '';
        }
        
        if (!isset($invokeParams['secondname']))
        {
            $invokeParams['secondname'] = '';
        }
        
        if (!isset($invokeParams['email']))
        {
            $invokeParams['email'] = '';
        }
        
        if (!isset($invokeParams['phonenumber']))
        {
            $invokeParams['phonenumber'] = '';
        }
        
        if (!isset($invokeParams['received']))
        {
            $invokeParams['received'] = '';
        }
        
        if (!isset($invokeParams['called']))
        {
            $invokeParams['called'] = '';
        }
        
        if (!isset($invokeParams['agent']))
        {
            $invokeParams['agent'] = '';
        }
        
        $this->getView()->assign('invokeParams', $invokeParams);
        
        $this->getView()->assign('error', $error);
        
        return $this->getView()->render('intranet/registration');
    }
}

