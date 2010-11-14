<?php
require_once 'Log/NosqlLogging.php';
/**
 * @category Gerlv
 * @package Gerlv_Log
 * @author Oleg Gerasimenko
 * @copyright New BSD License
 */
class Gerlv_Log extends Zend_Log_Writer_Abstract
{
    private $_config = array();

    public function __construct(array $config)
    {
        $this->_config = $config;
    }

    public function _write($event)
    {
        $collection = new Gerlv_Log_NosqlLogging($this->_config);
        if ($collection === null) {
            require_once 'Zend/Log/Exception.php';
            throw new Zend_Log_Exception('Database connection is null');
        }
        $collection->priority = $event['priority'];
        $collection->message = $event['message'];
        $collection->time = date('c');
        $collection->save();
    }

    public static function factory($config)
    {
        if(is_array($config) 
                && ($config['db'] !== null
                    && !is_string($config['db']))
                || ($config['collection'] !== null
                    && !is_string($config['collection']))
                ) {
            
            require_once 'Zend/Log/Exception.php';
            throw new Zend_Log_Exception('Prorivde database name and document collection');
        }
        return new self($config);
    }    
}