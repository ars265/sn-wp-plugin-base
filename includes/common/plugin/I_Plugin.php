<?php

namespace sn\base\plugin;

/**
 * A contract for plugins.
 */
interface I_Plugin {
    
    /**
     * A handler called when the plugin is activated.
     *
     * @access public
     * @return void
     */
    public function activate();

    /**
     * A handler called when the plugin is deactivated.
     *
     * @access public
     * @return void
     */
    public function deactivate();
    
    /**
     * A handler that is called when the plugin is initalized.
     *
     * @access public
     * @return void
     */
    public function initialize();
    
    /**
     * Registers the activation hook for the plugin.
     *
     * @access public
     * @return void
     */
    public function register_activation();

    /**
     * Registers the deactivate hook for the plugin.
     *
     * @access public
     * @return void
     */
    public function register_deactivation();
    
    /**
     * Registers the removal of the plugin and it's resources.
     *
     * @access public
     * @return void
     */
    public function register_uninstall();
    
    /**
     * Registers a component with the plugin to get registered on initalization.
     * 
     * @access public
     * @param sn\base\component\I_Component $component
     * @return void
     */
    public function register_component( sn\base\component\I_Component $component );
    
    /**
     * Returns a component that has been previously registered with the plugin by
     *  name or false if the name is not associated.
     * 
     * @access public
     * @param string $name
     * @return false|sn\base\component\I_Component
     */
    public function get_registered_component( $name );
    
    /**
     * Adds a requirement to be verified before the plugin is allowed to perform
     *  any routing. If any of the requirements return false the plugin will be
     *  placed in a deactivated state.
     * 
     * @access public
     * @param sn\base\requirement\I_Requirement $requirement
     * @return void
     */
    public function add_requirement( sn\base\requirement\I_Requirement $requirement );
    
    /**
     * Returns the router that performs routing operations.
     * 
     * @access public
     * @return sn\base\routing\I_Router $router
     */
    public function get_router();
    
    /**
     * Sets the router that the plugin will use to direct traffic and pages.
     * 
     * @access public
     * @param sn\base\routing\I_Router $router
     * @return void
     */
    public function set_router( sn\base\routing\I_Router $router );
    
    /**
     * Returns the pluging version.
     * 
     * @access public
     * @return void
     */
    public function get_version();
    
    /**
     * Returns the name of the plugin.
     * 
     * @access public
     * @return void
     */
    public function get_name();
}