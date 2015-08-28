<?php

namespace sn\base\setting;

/**
 * A contract for requiring settings from any object.
 */
interface I_Require_Settings {
    
    /**
     * Returns the value for a specific setting or null if the setting is not
     *  known.
     * 
     * @access public
     * @param string $name
     * @return mixed
     */
    public function get_setting( $name );
    
    /**
     * Sets the value for the specified setting.
     * 
     * @access public
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function set_setting( $name, $value );
    
    /**
     * Returns an array of key value pairs of the current set settings.
     * 
     * @access public
     * @return array
     */
    public function get_settings();
    
    /**
     * Sets an array of settings.
     * 
     * @access public
     * @param array $array
     * @return void
     */
    public function set_settings( $array );
}