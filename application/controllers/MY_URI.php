<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_URI extends CI_URI {
  
  var $_get_params = array();

  function _fetch_uri_string() {
    
    parse_str($_SERVER['QUERY_STRING'], $this->_get_params);
       
    $_GET = array();
    $_SERVER['QUERY_STRING'] = ''; 
    
    parent::_fetch_uri_string();  

  }
  
  function getParam($key) {
    if (isset($this->_get_params[$key])) {
      return $this->_get_params[$key];
    } else {
      return false;
    }
  }
  
  function getParams() {
    return $this->_get_params;
  }

}