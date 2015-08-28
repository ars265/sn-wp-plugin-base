<?php

namespace sn\base\component;

interface I_Component {
    
    public function __construct();
    
    public function register();
    
    public function get_name();
}