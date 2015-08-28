<?php

namespace sn\base\log;

/**
 * A base Logger class with defaults for log levels.
 * 
 * @abstract
 * @implements \sn\base\log\I_Logger
 */
abstract class Logger implements \sn\base\log\I_Logger {
    
    
    const ERROR = 0;
    
    const WARN = 1;
    
    const INFO = 2;
    
    const DEBUG = 3;
    
    
    /**
     * Logs a message to a writable source. True will be returned if the log was
     *  successful, false otherwise.
     * 
     * @access public
     * @abstract
     * @param int $severity
     * @param string $message
     * @param string $source (default: '')
     * @return bool
     */
    abstract public function log( $severity, $message, $source = '' );
}