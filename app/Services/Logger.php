<?php
namespace App\DamaiLibs\V1;

use Illuminate\Support\Facades\Log;

class Logger
{
    protected static $_instance = null;
    protected $_prefix = '';
    protected $_seq    = 1;

    protected function __construct(){}

    public static function getInstance()
    {
        if (self::$_instance == null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    public function setPrefix($prefix)
    {
        $this->_prefix = $prefix;

        return self::$_instance;
    }

    public function emergency($log)
    {
        $this->_log($log, 'emergency');
    }

    public function alert($log)
    {
        $this->_log($log, 'alert');
    }

    public function critical($log)
    {
        $this->_log($log, 'critical');
    }

    public function error($log)
    {
        $this->_log($log, 'error');
    }

    public function warning($log)
    {
        $this->_log($log, 'warning');
    }

    public function notice($log)
    {
        $this->_log($log, 'notice');
    }

    public function info($log)
    {
        $this->_log($log, 'info');
    }

    public function debug($log)
    {
        $this->_log($log, 'debug');
    }

    protected function _log($log, $level = 'info')
    {
        $log = sprintf('(%s)(%s) [%s] %s', getmypid(), $this->_seq++, $this->_prefix, $log);

        switch ($level) {
            case 'emergency':
            case 'alert':
            case 'critical':
            case 'error':
            case 'warning':
            case 'notice':
            case 'info':
            case 'debug':
                Log::{$level}($log);
                break;
            default:
                Log::info($log);
                break;
        }

    }
}
