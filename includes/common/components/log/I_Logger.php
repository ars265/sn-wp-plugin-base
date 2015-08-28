<?php

namespace sn\base\log;

interface I_Logger {
    
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
    public function log( $severity, $message, $source = '' );
}