<?php

class Frontend_Main_IntranetController extends Frontend_Abstract_AbstractController
{
    /**
     *
     * @var Dobild_UserCms_Module 
     */
    protected $userCmsModule = null;
    
    public function preDispatch()
    {
		parent::preDispatch();
        
        $dbConfig = $this->getDbConnection();
        
        $userCmsModule = new Dobild_UserCms_Module($dbConfig);
        
        $userCmsModule->install();
        
        $this->userCmsModule = $userCmsModule;
    }
    
    public function indexAction()
    {
        return $this->_view->render('register/index');
    }
    
    public function registrationAction()
    {
        $error = array();
        
        $invokeParams = $this->getRequestInvokeParams();
        
        if ($this->getRequest()->isPost())
        {
            if (!isset($invokeParams['salutation']))
            {
                $error['salutation'][] = 'instranet-frontend-main-instranet-registration-form-error-salutation-set';
            }
            elseif (!is_string($invokeParams['reg_gender']))
            {
                $error['salutation'][] = 'instranet-frontend-main-instranet-registration-form-error-salutation-string';
            }
            elseif (!in_array($invokeParams['reg_gender'], array('male', 'female')))
            {
                $error['salutation'][] = 'instranet-frontend-main-instranet-registration-form-error-salutation-invalid';
            }

            $validateName = new \Zend_Validate_StringLength(3, 200);

            $validateName->setDisableTranslator(true);
            
            if (!isset($invokeParams['name']))
            {
                $error['name'][] = 'instranet-frontend-main-instranet-registration-form-error-name-set';
            }
            elseif (!is_string($invokeParams['name']))
            {
                $error['name'][] = 'instranet-frontend-main-instranet-registration-form-error-name-string';
            }
            elseif (! $validateName->isValid($invokeParams['name']))
            {
                $error['name'][] = 'instranet-frontend-main-instranet-registration-form-error-name-invalid';
            }
            
            if (!isset($invokeParams['nickname']))
            {
                $error['nickname'][] = 'instranet-frontend-main-instranet-registration-form-error-nickname-set';
            }
            elseif (!is_string($invokeParams['nickname']))
            {
                $error['nickname'][] = 'instranet-frontend-main-instranet-registration-form-error-nickname-string';
            }
            elseif (! $validateName->isValid($invokeParams['nickname']))
            {
                $error['nickname'][] = 'instranet-frontend-main-instranet-registration-form-error-nickname-invalid';
            }
            
            $validateEmail = new \Zend_Validate_EmailAddress();

            $validateEmail->setDisableTranslator(true);

            $validateEmail->getHostnameValidator()->setDisableTranslator(true);
            
            if (!isset($invokeParams['email']))
            {
                $error['email'][] = 'instranet-frontend-main-instranet-registration-form-error-email-set';
            }
            elseif (!is_string($invokeParams['email']))
            {
                $error['email'][] = 'instranet-frontend-main-instranet-registration-form-error-email-string';
            }
            elseif (! $validateEmail->isValid($invokeParams['name']))
            {
                $error['email'][] = 'instranet-frontend-main-instranet-registration-form-error-email-invalid';
            }

            $validatePassword = new \Zend_Validate_StringLength(6, 200);

            $validatePassword->setDisableTranslator(true);
            
            if (!isset($invokeParams['password']))
            {
                $error['password'][] = 'instranet-frontend-main-instranet-registration-form-error-password-set';
            }
            elseif (!is_string($invokeParams['password']))
            {
                $error['password'][] = 'instranet-frontend-main-instranet-registration-form-error-password-string';
            }
            elseif (! $validatePassword->isValid($invokeParams['password']))
            {
                $error['password'][] = 'instranet-frontend-main-instranet-registration-form-error-password-invalid';
            }
            
            if (!isset($invokeParams['repeat_password']))
            {
                $error['repeat_password'][] = 'instranet-frontend-main-instranet-registration-form-error-repeat_password-set';
            }
            elseif (!is_string($invokeParams['repeat_password']))
            {
                $error['repeat_password'][] = 'instranet-frontend-main-instranet-registration-form-error-repeat_password-string';
            }
            elseif (! $validatePassword->isValid($invokeParams['repeat_password']))
            {
                $error['repeat_password'][] = 'instranet-frontend-main-instranet-registration-form-error-repeat_password-invalid';
            }
            
            if (empty($error['password']) && empty($error['repeat_password']) && $invokeParams['password'] != $invokeParams['repeat_password'])
            {
                $error['repeat_password'][] = 'instranet-frontend-main-instranet-registration-form-error-repeat_password-identical';
            }
            
            if (empty($invokeParams['products']))
            {
                $invokeParams['products'] = '0';
            }
            else
            {
                $invokeParams['products'] = '1';
            }

            $validateTerms = new \Zend_Validate_Regex('#^[1]$#');

            $validateTerms->setDisableTranslator(true);


            if (! isset($invokeParams['agb']))
            {
                $error['agb'][] = 'instranet-frontend-main-instranet-registration-form-error-agb-set';
            }
            elseif (! is_numeric($invokeParams['terms']))
            {
                $error['agb'][] = 'instranet-frontend-main-instranet-registration-form-error-agb-numeric';
            }
            elseif (! $validateTerms->isValid($invokeParams['agb']))
            {
                $error['agb'][] = 'instranet-frontend-main-instranet-registration-form-error-agb-invalid';
            }
        }
        
        if ($this->getRequest()->isPost() && count($error) == 0)
        {
            $userCmsModule = $this->userCmsModule;
        
            $userCmsModule->addUserProfile($invokeParams);
        }
        
        if (!isset($invokeParams['reg_gender']))
        {
            $invokeParams['reg_gender'] = '';
        }
        
        if (!isset($invokeParams['name']))
        {
            $invokeParams['name'] = '';
        }
        
        if (empty($invokeParams['products']))
        {
            $invokeParams['products'] = '0';
        }
        else
        {
            $invokeParams['products'] = '1';
        }
        
        return $this->_view->render('register/registration');
    }
    
    public function emailconfirmAction()
    {
        return $this->_view->render('register/emailconfirmsuccesfull');
    }
}

