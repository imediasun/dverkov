<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "main";
$route['404_override'] = '';
$route['(ru|en|chi)'] = $route['default_controller'];
$route['(ru|en|chi)/(.+)'] = "$2";
// $route['catalog/(:any)/photos'] = 'country/photos/$1';
$route['catalog/(:any)'] = 'catalog/index/$1';
$route['catalog/(:any)/(:num)'] = 'places/index/$1/$2';
$route['dveri/(:any)'] = 'dveri/index/$1';
$route['dveri/(:any)/(:num)/(:num)'] = 'dveri/index/$1/$2/$3';
$route['door/(:any)'] = 'door/index/$1';
$route['dveri_edit/(:any)'] = 'dveri_edit/index/$1';
$route['dveri_edit/(:any)/(:num)/(:num)'] = 'dveri_edit/index/$1/$2/$3';
$route['door_edit/(:any)'] = 'door_edit/index/$1';
$route['producer_edit/(:any)/(:num)'] = 'producer_edit/index/$1/$2';
$route['auth_form/(:any)'] = 'auth_form/index/$1';
$route['materials_edit/(:any)'] = 'materials_edit/index/$1';
$route['admin/pages/(:any)/(:num)'] = 'admin/pages/$1/$2';
$route['functions_images/(:any)/(:num)'] = 'functions_images/index/$1';
/* End of file routes.php */
/* Location: ./application/config/routes.php */