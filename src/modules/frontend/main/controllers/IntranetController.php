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
            /*
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
             * 
             */

            $validateName = new \Zend_Validate_StringLength(3, 200);

            $validateName->setDisableTranslator(true);
            
            /*
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
             * 
             */
            
            /*
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
             * 
             */
            
            $validateEmail = new \Zend_Validate_EmailAddress();

            $validateEmail->setDisableTranslator(true);

            $validateEmail->getHostnameValidator()->setDisableTranslator(true);
            
            /*
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
             * 
             */
            
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
            
            /*
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
             * 
             */
        }
        
        if ($this->getRequest()->isPost() && count($error) == 0)
        {
            $userCmsModule = $this->userCmsModule;
            
            $invokeParams['warrant'] = intval(!empty($invokeParams['warrant']));
        
            $userCmsModule->addUserProfile($invokeParams);
            
            unset($invokeParams['idext']);
            unset($invokeParams['salutation']);
            unset($invokeParams['firstname']);
            unset($invokeParams['secondname']);
            unset($invokeParams['street']);
            unset($invokeParams['postcode']);
            unset($invokeParams['city']);
            unset($invokeParams['birthday']);
            unset($invokeParams['date_vk']);
            unset($invokeParams['adress_source']);
            unset($invokeParams['decline_reason']);
            unset($invokeParams['pre_phone_selection']);
            unset($invokeParams['email']);
            unset($invokeParams['comment']);
            unset($invokeParams['phonenumber']);
            unset($invokeParams['received']);
            unset($invokeParams['called']);
            unset($invokeParams['agent']);
            unset($invokeParams['warrant']);
        }
        
        if (!isset($invokeParams['idext']))
        {
            $invokeParams['idext'] = '';
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
        
        if (!isset($invokeParams['street']))
        {
            $invokeParams['street'] = '';
        }
        
        if (!isset($invokeParams['postcode']))
        {
            $invokeParams['postcode'] = '';
        }
        
        if (!isset($invokeParams['city']))
        {
            $invokeParams['city'] = '';
        }
        
        if (!isset($invokeParams['birthday']))
        {
            $invokeParams['birthday'] = '';
        }
        
        if (!isset($invokeParams['date_vk']))
        {
            $invokeParams['date_vk'] = '';
        }
        
        if (!isset($invokeParams['adress_source']))
        {
            $invokeParams['adress_source'] = '';
        }
        
        if (!isset($invokeParams['decline_reason']))
        {
            $invokeParams['decline_reason'] = '';
        }
        
        if (!isset($invokeParams['pre_phone_selection']))
        {
            $invokeParams['pre_phone_selection'] = '';
        }
        
        if (!isset($invokeParams['email']))
        {
            $invokeParams['email'] = '';
        }
        
        if (!isset($invokeParams['comment']))
        {
            $invokeParams['comment'] = '';
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
        
        if (!isset($invokeParams['warrant']))
        {
            $invokeParams['warrant'] = '';
        }
        
        $this->getView()->assign('invokeParams', $invokeParams);
        
        $this->getView()->assign('error', $error);
        
        return $this->getView()->render('intranet/registration');
    }
    
    public function exportAction()
    {
        $error = array();
        
        $invokeParams = $this->getRequestInvokeParams();
        
        if ($this->getRequest()->isPost())
        {
            $keys = array
            (
                'user_profile_id'       => 'ID',
                'idext'                 => 'ID_EXT',
                'salutation'            => 'Anrede',
                'firstname'             => 'Vorname',
                'secondname'            => 'Nachname',
                'street'                => 'Straße',
                'postcode'              => 'PLZ',
                'city'                  => 'Stadt',
                'birthday'              => 'Geburtsdatum',
                'date_vk'               => 'Datum VK',
                'adress_source'         => 'Adressherkunft',
                'decline_reason'        => 'Ablehnungsgrund',
                'pre_phone_selection'   => 'Vorwahl',
                'email'                 => 'E-Mail-Adresse',
                'comment'               => 'Bemerkung',
                'phonenumber'           => 'Telefonnummer',
                'received'              => 'Erhalten am',
                'called'                => 'Angerufen am',
                'agent'                 => 'Agent',
                'warrant'               => 'Möchte Vollmacht haben',
            );
        
            $userCmsModule = $this->userCmsModule;

            $dbConnection = $userCmsModule->getConnection();

            $param = array
            (
                'cols' => array
                (
                    'user_profile_id'       => 'user_profile_id',
                    'idext'                 => 'idext',
                    'salutation'            => 'salutation',
                    'firstname'             => 'firstname',
                    'secondname'            => 'secondname',
                    'street'                => 'street',
                    'postcode'              => 'postcode',
                    'city'                  => 'city',
                    'birthday'              => 'birthday',
                    'date_vk'               => 'date_vk',
                    'adress_source'         => 'adress_source',
                    'decline_reason'        => 'decline_reason',
                    'pre_phone_selection'   => 'pre_phone_selection',
                    'email'                 => 'email',
                    'comment'               => 'comment',
                    'phonenumber'           => 'phonenumber',
                    'received'              => 'received',
                    'called'                => 'called',
                    'agent'                 => 'agent',
                    'warrant'               => 'warrant',
                )
            );

            if (!empty($invokeParams['from']))
            {
                $param['where'][] = new EhrlichAndreas_Db_Expr($dbConnection->quoteInto('received >= ?' , $invokeParams['from']));
            }

            if (!empty($invokeParams['to']))
            {
                $param['where'][] = new EhrlichAndreas_Db_Expr($dbConnection->quoteInto('received <= ?' , $invokeParams['to']));
            }

            $rowset = $userCmsModule->getUserProfileList($param);

            $csv = array();

            $header = array_values($keys);

            foreach ($header as $key=>$name)
            {
                $header[$key] = $name.':';
            }

            $csv[] = $header;

            foreach ($rowset as $row)
            {
                $rowTmp = array();
                
                if (empty($row['warrant']))
                {
                    $row['warrant'] = 'nein';
                }
                else
                {
                    $row['warrant'] = 'ja';
                }

                foreach ($keys as $key => $value)
                {
                    if (isset($row[$key]))
                    {
                        $rowTmp[$key] = $row[$key];
                    }
                    else
                    {
                        $rowTmp[$key] = '';
                    }
                }

                $csv[] = $rowTmp;
            }

            foreach ($csv as $key=>$value)
            {
                foreach ($value as $k=>$v)
                {
                    if (preg_match('/[\\n\\r\\t\"\;]/',$v))
                    {
                        $v = str_replace('"','""',$v);
                    }

                    if ($key !== 0 || $k !== 0)
                    {
                        $v = '"'.$v.'"';
                    }

                    $value[$k] = $v;
                }

                $csv[$key] = implode(";",$value);
            }

            $csv = implode("\n",$csv);

            //$csv = chr(0xEF).chr(0xBB).chr(0xBF).$csv;

            $response = array
            (
                'body'  => $csv,
                'headers'   => array
                (
                    array
                    (
                        'name'      => 'Pragma',
                        'value'     => 'no-cache',
                        'replace'   => true,
                    ),
                    array
                    (
                        'name'      => 'Cache-Control',
                        'value'     => 'must-revalidate, post-check=0, pre-check=0',
                        'replace'   => true,
                    ),
                    array
                    (
                        'name'      => 'Cache-Control',
                        'value'     => 'private',
                        'replace'   => false,
                    ),
                    array
                    (
                        'name'      => 'Content-Transfer-Encoding',
                        'value'     => 'binary',
                        'replace'   => true,
                    ),
                    array
                    (
                        'name'      => 'Content-Disposition',
                        'value'     => 'attachment; filename="export.csv"',
                        'replace'   => true,
                    ),
                    array
                    (
                        'name'      => 'Content-Length',
                        'value'     => strlen($csv),
                        'replace'   => true,
                    ),
                    array
                    (
                        'name'      => 'Content-Type',
                        'value'     => 'text/csv; charset=utf-8',
                        'replace'   => true,
                    ),
                    array
                    (
                        'name'      => 'Vary',
                        'value'     => 'Accept-Encoding',
                        'replace'   => true,
                    ),
                ),
            );

            header('HTTP/1.1 200 OK',true,200);


            foreach ($response['headers'] as $header)
            {
                if (isset($header['replace']))
                {
                    header($header['name'].': '.$header['value'],$header['replace']);
                }
                else
                {
                    header($header['name'].': '.$header['value']);
                }
            }

            echo $response['body'];
            die();
        }
        
        if (!isset($invokeParams['from']))
        {
            $invokeParams['from'] = '';
        }
        
        if (!isset($invokeParams['to']))
        {
            $invokeParams['to'] = '';
        }
        
        $this->getView()->assign('invokeParams', $invokeParams);
        
        $this->getView()->assign('error', $error);
        
        return $this->getView()->render('intranet/export');
    }
    
    public function viewAction()
    {
        
    }
}

