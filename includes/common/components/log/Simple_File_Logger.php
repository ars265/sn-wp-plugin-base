<?php

namespace sn\base\log;

class Simple_File_Logger extends \sn\base\log\Logger {
    
    protected $file_path = '';
    
    protected $file_name = '';
    
    /**
     * Logs a message to a writable source. True will be returned if the log was
     *  successful, false otherwise.
     * 
     * @access public
     * @param int $severity
     * @param string $message
     * @param string $source (default: '')
     * @return bool
     */
    public function log( $severity, $message, $source = '' ) {
        
        $severity_key = 'Error';
        
        switch ( $severity ) {
            
            case self::ERROR:
                
                $severity_key = 'Error';
                break;
            
            case self::WARN:
                
                $severity_key = 'Warning';
                break;
            
            case self::INFO:
                
                $severity_key = 'Info';
                break;
            
            case self::DEBUG:
                
                $severity_key = 'Debug';
                break;
        }
        
        return ( false !== file_put_contents(  __DIR__ . '/logs/log.txt', $message . PHP_EOL, FILE_APPEND ) );
        
    }
}





