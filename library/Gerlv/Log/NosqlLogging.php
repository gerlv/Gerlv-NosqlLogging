<?php

/**
 * @category Gerlv
 * @package Gerlv_Log
 * @subpackage Gerlv_Log_NosqlLogging
 * @author Oleg Gerasimenko
 * @copyright New BSD License
 * @uses Shanty_Mongo_Document
 */
class Gerlv_Log_NosqlLogging extends Shanty_Mongo_Document
{
    protected static $_db = null;
    protected static $_collection = null;
    
    protected static $_requirements = array(
        'time' => 'Required',
        'message' => 'Required',
        'priority' => 'Required'
    );
    
    public function __construct(array $config) {
        self::$_db = $config['db'];
        self::$_collection = $config['collection'];
        parent::__construct();
    }
}