<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
	}
	
	public static function &get_instance()
	{
		return self::$instance;
	}
	
	private function init_language()
    {
        $language_default = $this->config->item('language_default');
        $session_lang     = $this->session->userdata('lang', true);
       
        // Если AJAX то язык возьмёт из session
        if($this->input->is_ajax_request())
        {
            $current_lang = $session_lang;
        }
        else
        {
            $current_lang = $this->uri->segment(1);
        }
       
       
        if($this->config->item($current_lang, 'languages') && ($language_default != $current_lang))
        {
            $language = $current_lang;
        }
        else
        {
            $language = $this->config->item('language_default');
        }
       
        $this->config->set_item('language', $language);
       
        $this->session->set_userdata('lang', $language);
       
        $this->lang->load('main', $language);
    }
	
	
	   
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */