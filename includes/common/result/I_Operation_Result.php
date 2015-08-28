<?php

namespace sn\base\result;

/**
 * A contract for operation results.
 */
interface I_Operation_Result {
    
    /**
     * The constructor for a result.
     * 
     * @access public
     * @param bool $success
     * @param mixed $value
     * @param string $message (default: '')
     * @return void
     */
    public function __construct( $success, $value, $message = '' );
    
    /**
     * Returns the message.
     * 
     * @access public
     * @return string
     */
    public function get_message();
    
    /**
     * Returns whether the operation was successful.
     * 
     * @access public
     * @return bool
     */
    public function get_success();
    
    /**
     * Returns the value produced from the operation.
     * 
     * @access public
     * @return mixed
     */
    public function get_value();
    
    /**
     * An alias of get_success.
     * 
     * @access public
     * @return bool
     */
    public function was_successful();
}