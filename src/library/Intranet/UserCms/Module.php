<?php 

/**
 * 
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class Intranet_UserCms_Module extends EhrlichAndreas_AbstractCms_Module
{
    /**
     *
     * @var string
     */
    private $tableUserProfile = 'intranet_user_profile';
    
    /**
     * Constructor
     * 
     * @param array $options
     *            Associative array of options
     * @throws Intranet_UserCms_Exception
     * @return void
     */
    public function __construct ($options = array())
    {
        $options = $this->_getCmsConfigFromAdapter($options);
        
        if (! isset($options['adapterNamespace']))
        {
            $options['adapterNamespace'] = 'Intranet_UserCms_Adapter';
        }
        
        if (! isset($options['exceptionclass']))
        {
            $options['exceptionclass'] = 'Intranet_UserCms_Exception';
        }
        
        parent::__construct($options);
    }
    
    /**
     * 
     * @return Intranet_UserCms_Module
     */
    public function install()
    {
        $this->adapter->install();
        
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getTableUserProfile ()
    {
        return $this->adapter->getTableName($this->tableUserProfile);
    }

    /**
     * 
     * @return array
     */
    public function getFieldsUserProfile ()
    {
        return array
		(
			'user_profile_id'       => 'user_profile_id',
            'published'             => 'published',
            'updated'               => 'updated',
            'enabled'               => 'enabled',
            'salutation'            => 'salutation',
            'gender'                => 'gender',
            'name'                  => 'name',
            'firstname'             => 'firstname',
            'secondname'            => 'secondname',
            'email'                 => 'email',
            'registered'            => 'registered',
            'registered_ip'         => 'registered_ip',
            'confirmed'             => 'confirmed',
            'confirmed_ip'          => 'confirmed_ip',
            'unsubscribed'          => 'unsubscribed',
            'unsubscribed_ip'       => 'unsubscribed_ip',
            'banned'                => 'banned',
            'nickname'              => 'nickname',
            'password'              => 'password',
            'street'                => 'street',
            'postcode'              => 'postcode',
            'city'                  => 'city',
            'iban'                  => 'iban',
            'swift'                 => 'swift',
            'products'              => 'products',
            'agb'                   => 'agb',
            'phonenumber'           => 'phonenumber',
            'received'              => 'received',
            'called'                => 'called',
            'agent'                 => 'agent',
            'idext'                 => 'idext',
            'birthday'              => 'birthday',
            'date_vk'               => 'date_vk',
            'adress_source'         => 'adress_source',
            'decline_reason'        => 'decline_reason',
            'pre_phone_selection'   => 'pre_phone_selection',
            'comment'               => 'comment',
            'warrant'               => 'warrant',
		);
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsUserProfile ()
    {
        return array
		(
			'user_profile_id'   => 'user_profile_id',
		);
    }

	/**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
    public function addUserProfile ($params = array(), $returnAsString = false)
    {
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00' || $params['published'] == '')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00' || $params['updated'] == '')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        if (! isset($params['salutation']))
        {
            $params['salutation'] = '';
        }
        if (! isset($params['gender']))
        {
            $params['gender'] = '1';
        }
        if (! isset($params['name']))
        {
            $params['name'] = '';
        }
        if (! isset($params['firstname']))
        {
            $params['firstname'] = '';
        }
        if (! isset($params['secondname']))
        {
            $params['secondname'] = '';
        }
        if (! isset($params['email']))
        {
            $params['email'] = '';
        }
        if (! isset($params['registered']))
        {
            $params['registered'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['registered_ip']))
        {
            $params['registered_ip'] = '';
        }
        if (! isset($params['confirmed']) || $params['confirmed'] == '0000-00-00 00:00:00' || $params['confirmed'] == '')
        {
            $params['confirmed'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['confirmed_ip']))
        {
            $params['confirmed_ip'] = '';
        }
        if (! isset($params['unsubscribed']) || $params['unsubscribed'] == '0000-00-00 00:00:00' || $params['unsubscribed'] == '')
        {
            $params['unsubscribed'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['unsubscribed_ip']))
        {
            $params['unsubscribed_ip'] = '';
        }
        if (! isset($params['banned']) || $params['banned'] == '0000-00-00 00:00:00' || $params['banned'] == '')
        {
            $params['banned'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['username']))
        {
            $params['username'] = '';
        }
        if (! isset($params['password']))
        {
            $params['password'] = '';
        }
        if (! isset($params['street']))
        {
            $params['street'] = '';
        }
        if (! isset($params['postcode']))
        {
            $params['postcode'] = '';
        }
        if (! isset($params['city']))
        {
            $params['city'] = '';
        }
        if (! isset($params['iban']))
        {
            $params['iban'] = '';
        }
        if (! isset($params['swift']))
        {
            $params['swift'] = '';
        }
        if (! isset($params['products']))
        {
            $params['products'] = '0';
        }
        if (! isset($params['agb']))
        {
            $params['agb'] = '0';
        }
        if (! isset($params['phonenumber']))
        {
            $params['phonenumber'] = '';
        }
        if (! isset($params['received']) || $params['received'] == '0000-00-00 00:00:00' || $params['received'] == '')
        {
            $params['received'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['called']) || $params['called'] == '0000-00-00 00:00:00' || $params['called'] == '')
        {
            $params['called'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['agent']))
        {
            $params['agent'] = '';
        }
		
		$function = 'UserProfile';
		
		return $this->_add($function, $params, $returnAsString);
    }
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function deleteUserProfile ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
		$function = 'UserProfile';
		
		return $this->_delete($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function editUserProfile ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00' || $params['updated'] == '0001-01-01 00:00:00' || $params['updated'] == '')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
		
		$function = 'UserProfile';
		
		return $this->_edit($function, $params, $returnAsString);
	}

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getUserProfile ($params = array(), $returnAsString = false)
    {
		$function = 'UserProfile';
		
		return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getUserProfileList ($where = array())
    {
		$function = 'UserProfile';
		
		return $this->_getList($function, $where);
    }
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function disableUserProfile ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        $params['enabled'] = '0';
		
		return $this->editUserProfile($params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function enableUserProfile ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        $params['enabled'] = '1';
		
		return $this->editUserProfile($params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function softDeleteUserProfile ($params = array(), $returnAsString = false)
	{
		return $this->disableUserProfile($params, $returnAsString);
	}
}
