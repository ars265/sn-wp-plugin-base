<?php

namespace sn\base\component;

/**
 * A component for logging output.
 * 
 * @implements \sn\base\component\I_Component
 * @implements \sn\base\setting\I_Require_Settings
 */
class Log_Component implements \sn\base\component\I_Component, \sn\base\setting\I_Require_Settings {
    
    protected static $name = 'Log';
    
    protected static $namespace = 'log.component';
    
    protected $logger = null;
    
    protected $log_class = '';
    
    protected $logger_settings = array();
    
    private static $settings_fields = array(
        'log_class'
    );
    
    
    /**
     * Components are required to have a default constructor.
     * 
     * @access public
     * @return void
     */
    public function __construct() { }
    
    /**
     * Registers any classes, autoloaders or other libraries needed for the
     *  component to function correctly.
     * 
     * @access public
     * @return void
     */
    public function register() {
        
        $class = $this->log_class;
        
        if ( empty( $class ) || !class_exists( $class ) ) {
            throw new \Exception( 'Logging class has not been configured.' );
        }
        
        $this->logger = new $class();
        
        //any settings passed in the log namespace, if not used by us are passed
        // to the logger instance for configuration if it takes settings
        if ( $this->logger instanceof \sn\base\setting\I_Require_Settings ) {
            $this->logger->set_settings( $this->logger_settings );
        }
    }
    
    /**
     * A name for the component for when it's registered.
     * 
     * @access public
     * @return string
     */
    public function get_name() {
        return static::$name;
    }
    
    /**
     * Returns the namespace for the component. This can be used in logging,
     *  settings configuration and other senarios. This is not the class namespace.
     * 
     * @access public
     * @return string
     */
    public function get_namespace() {
        return static::$namespace;
    }
    
    /**
     * Returns the value for a specific setting or null if the setting is not
     *  known.
     * 
     * @access public
     * @param string $name
     * @return mixed
     */
    public function get_setting( $name ) {
        
        $settings = $this->compose_settings();
        
        if ( !array_key_exists( $name, $settings ) ) {
            return null;
        }
        
        return $settings[ $name ];
    }
    
    /**
     * Sets the value for the specified setting.
     * 
     * @access public
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function set_setting( $name, $value ) {
        $this->parse_settings( array( $name => $value ) );
    }
    
    /**
     * Returns an array of key value pairs of the current set settings.
     * 
     * @access public
     * @return array
     */
    public function get_settings() {
        return $this->compose_settings();
    }
    
    /**
     * Sets an array of settings.
     * 
     * @access public
     * @param array $array
     * @return void
     */
    public function set_settings( $array ) {
        $this->parse_settings( $array );
    }
    
    /**
     * The settings that need parsed.
     * 
     * @access private
     * @param array $configs
     * @return void
     */
    private function parse_settings( $configs ) {
        
        $passed_settings = array();
        
        if ( is_array( $configs ) ) {
            
            foreach ( $configs as $config => $value ) {
                
                if ( in_array( $config, $this->settings_fields ) ) {
                    $this->{ $config } = $value;
                } else {
                    $passed_settings[ $config ] = $value;
                }
            }
            
            $this->logger_settings = array_merge( $this->logger_settings, $passed_settings );
        }
    }
    
    /**
     * Compiles the settings passed to this logger back to the user.
     * 
     * @access private
     * @return array
     */
    private function compose_settings() {
        
        $settings = $this->logger_settings;
        
        foreach ( $this->settings_fields as $field ) {
            $settings[ $field ] = $this->{ $field };
        }
        
        return $settings;
    }

}