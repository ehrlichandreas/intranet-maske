<?php 

/**
 *
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class Intranet_UserCms_Adapter_Pdo_Mysql extends EhrlichAndreas_AbstractCms_Adapter_Pdo_Mysql
{
    /**
     *
     * @var string
     */
    private $tableUserProfile = 'intranet_user_profile';
    
    /**
     *
     * @var string 
     */
    protected $tableVersion = 'intranet_user_version';
    
    /**
     * 
     * @return EhrlichAndreas_NewsletterCms_Adapter_Pdo_Mysql
     */
    public function install ()
    {
        $this->_install_version_10000();
        
        return $this;
    }
    
    /**
     * 
     * @return EhrlichAndreas_NewsletterCms_Adapter_Pdo_Mysql
     */
    protected function _install_version_10000 ()
    {
        $version = '10000';
        
        $dbAdapter = $this->getConnection();
        
        $tableVersion = $this->getTableName($this->tableVersion);
        
        $versionDb = $this->_getVersion($dbAdapter, $tableVersion);
        
        if ($versionDb >= $version)
        {
            return $this;
        }
		
        $tableUserProfile = $this->getTableName($this->tableUserProfile);
		
        
        $queries = array();
        
        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`num` BIGINT(19) NOT NULL AUTO_INCREMENT, ';
        $query[] = '`count` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = 'PRIMARY KEY (`num`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';
		
		$queries[] = str_replace('%table%', $tableVersion, implode("\n", $query));
        
        
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`user_profile_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`salutation` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`gender` INT(5) NOT NULL DEFAULT \'1\', ';
        $query[] = '`name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`firstname` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`secondname` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`email` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`registered` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`registered_ip` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`confirmed` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`confirmed_ip` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`banned` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`unsubscribed` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`unsubscribed_ip` VARCHAR(45) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`nickname` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`password` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`street` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`postcode` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`city` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`iban` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`swift` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`products` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`agb` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`phonenumber` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`received` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`called` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`agent` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`idext` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`birthday` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`date_vk` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`adress_source` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`decline_reason` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`pre_phone_selection` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`comment` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`warrant` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = 'PRIMARY KEY (`user_profile_id`), ';
        $query[] = 'KEY `idx_email` (`email` (255)), ';
        $query[] = 'KEY `idx_name` (`name` (255)), ';
        $query[] = 'KEY `idx_nickname` (`nickname` (255)), ';
        $query[] = 'KEY `idx_nickname_password` (`nickname` (100), `password` (100)), ';
        $query[] = 'KEY `idx_registered_ip` (`registered_ip` (45)) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';
		
		$queries[] = str_replace('%table%', $tableUserProfile, implode("\n", $query));
		
		
		if ($versionDb < $version)
		{
            foreach ($queries as $query)
            {
                $stmt = $dbAdapter->query($query);

                $stmt->closeCursor();
            }
            
			$this->_setVersion($dbAdapter, $tableVersion, $version);
		}
		
		return $this;
    }
}