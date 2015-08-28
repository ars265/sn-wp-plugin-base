<?php

namespace sn\base\result;

/**
 * A implementation of the operation result interface.
 *
 * @implements \sn\base\result\I_Operation_Result
 */
class Operation_Result implements \sn\base\result\I_Operation_Result {
    
    /**
     * Whether the operation was successful.
     * 
     * (default value: false)
     * 
     * @var bool
     * @access protected
     */
    protected $success = false;
    
    /**
     * The value produced by the operation, if any.
     * 
     * (default value: null)
     * 
     * @var mixed
     * @access protected
     */
    protected $value = null;
    
    /**
     * The message if the operation was not successful.
     * 
     * (default value: '')
     * 
     * @var string
     * @access protected
     */
    protected $message = '';
    
    
    /**
     * Creates an instance of the operation result.
     * 
     * @access public
     * @static
     * @param bool $success
     * @param mixed $value (default: null)
     * @param string $message (default: '')
     * @return sn\base\result\I_Operation_Result
     */
    public static function create( $success, $value = null, $message = '' ) {
        
        $instance = new static( $success, $value, $message );
        return $instance;
    }
    
    
    /**
     * The constructor for a result.
     * 
     * @access public
     * @param bool $success
     * @param mixed $value (default: null)
     * @param string $message (default: '')
     * @return void
     */
    public function __construct( $success, $value = null, $message = '' ) {
        
        $this->success = ( true === $success );
        $this->value = $value;
        $this->message = $message;
        
        if ( !$this->success && empty( $message ) ) {
            throw new \Exception( 'Message is required.' );
        }
    }
    
    /**
     * Returns the message.
     * 
     * @access public
     * @return string
     */
    public function get_message() {
        return $this->message;
    }
    
    /**
     * Returns whether the operation was successful.
     * 
     * @access public
     * @return bool
     */
    public function get_success() {
        return $this->success;
    }
    
    /**
     * Returns the value produced from the operation.
     * 
     * @access public
     * @return mixed
     */
    public function get_value() {
        return $this->value;
    }
    
    /**
     * An alias of get_success.
     * 
     * @access public
     * @return bool
     */
    public function was_successful() {
        return $this->get_success();
    }
    
}