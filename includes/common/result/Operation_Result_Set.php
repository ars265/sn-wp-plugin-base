<?php

namespace sn\base\result;

/**
 * An implemenation of I_Operation_Result_Set.
 *
 * @implements \sn\base\result\I_Operation_Result_Set
 */
class Operation_Result_Set implements \sn\base\result\I_Operation_Result_Set {
    
    /**
     * Whether the operations ran were successful. This is lazily decided.
     * 
     * (default value: false)
     * 
     * @var bool
     * @access protected
     */
    protected $success = null;
    
    /**
     * The number of results returned.
     * 
     * (default value: 0)
     * 
     * @var int
     * @access protected
     */
    protected $result_count = 0;
    
    /**
     * The result set from the operation.
     * 
     * (default value: array())
     * 
     * @var array
     * @access protected
     */
    protected $result_set = array();
    
    
    /**
     * Creates a new instance of the operation result set.
     * 
     * @access public
     * @static
     * @param array $result_set
     * @return sn\base\result\I_Operation_Result_Set
     */
    public static function create( $result_set ) {
        
        $instance = new static( $result_set );
        return $instance;
    }
    
    /**
     * Returns whether the combined results were succcessful or not.
     * 
     * @access private
     * @static
     * @param array $set
     * @return bool
     */
    private static function was_result_set_successful( $set ) {
        
        $success = true;
        $values = array_values( $set );
        
        for ( $index = 0, $count = count( $set ); $index < $count; $index++ ) {
            
            $value = $values[ $index ];
            
            if ( !$value instanceof \sn\base\result\I_Operation_Result ) {
                throw new \Exception( 'The result set contains non-operation result values.' );
            }
            
            $success &= $value->get_success();
        }
        
        return (bool) $success;
    }
    
    
    /**
     * A constructor that requires a result set. A least one I_Operation_Result
     *  must be provided
     * 
     * @access public
     * @param array $result_set
     * @return void
     */
    public function __construct( $result_set ) {
        
        if ( !is_array( $result_set ) ) {
            throw new \Exception( 'The result set must be an array.' );
        }
        
        $this->result_count = count( $result_set );
        
        if ( 1 > $this->result_count ) {
            throw new \Exception( 'The result set must have at least one operation result.' );
        }
        
        $this->result_set = $result_set;
    }
    
    /**
     * Returns the number of results returned.
     * 
     * @access public
     * @return int
     */
    public function get_result_count() {
        return $this->result_count;
    }
    
    /**
     * Returns the I_Operation_Result at the specified index. False will be
     *  returned for an index that is not a valid result.
     * 
     * @access public
     * @param int $index
     * @return false|sn\base\result\I_Operation_Result
     */
    public function get_result_at( $index ) {
        
        if ( !array_key_exists( $index, $this->result_set ) ) {
            return false;
        }
        
        return $this->result_set[ $index ];
    }
    
    /**
     * Returns all the results that were provided as a result set.
     * 
     * @access public
     * @return array
     */
    public function get_results() {
        return array_values( $this->result_set );
    }
    
    /**
     * Returns an array of values from the result objects.
     * 
     * @access public
     * @return array
     */
    public function get_values() {
        
        //this value should be populated prior to a call to get values to ensure
        // all items were I_Operation_Results. This is a bit hackish but really
        // if the they used it correctly the impact of calling this here is very
        // minimal and if they didn't, shame on them.
        if ( null === $this->success ) {
            $this->success = self::was_result_set_successful( $this->result_set );
        }
        
        return array_map( function( $result ) {
            return $result->get_value();
        }, $this->result_set );
    }
    
    /**
     * Returns whether the combined result was successful.
     * 
     * @access public
     * @return bool
     */
    public function get_success() {
        
        if ( null === $this->success ) {
            $this->success = self::was_result_set_successful( $this->result_set );
        }
        
        return $this->success;
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