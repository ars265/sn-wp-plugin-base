<?php

namespace sn\base\result;

/**
 * A contract for a set of operations for methods that require a dataset with
 *  one or more results. This would include bulk operations.
 */
interface I_Operation_Result_Set {
    
    /**
     * A constructor that requires a result set. A least one I_Operation_Result
     *  must be provided
     * 
     * @access public
     * @param array $result_set
     * @return void
     */
    public function __construct( $result_set );
    
    /**
     * Returns the number of results returned.
     * 
     * @access public
     * @return int
     */
    public function get_result_count();
    
    /**
     * Returns the I_Operation_Result at the specified index. False will be
     *  returned for an index that is not a valid result.
     * 
     * @access public
     * @param int $index
     * @return false|sn\base\result\I_Operation_Result
     */
    public function get_result_at( $index );
    
    /**
     * Returns all the results that were provided as a result set.
     * 
     * @access public
     * @return array
     */
    public function get_results();
    
    /**
     * Returns whether the combined result was successful.
     * 
     * @access public
     * @return bool
     */
    public function get_success();
    
    /**
     * An alias of get_success.
     * 
     * @access public
     * @return bool
     */
    public function was_successful();
}