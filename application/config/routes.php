<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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

//$route['default_controller'] = "welcome";
//$route['404_override'] = 'errors';

$route['default_controller'] = 'home/view';
$route['home'] = 'home/view';
$route['index'] = 'home/view';
$route['(:any)'] = 'home/view/$1';

$route['home_user'] = 'home_user/view';
$route['home_user/(:any)'] = 'home_user/view/$1';

$route['subscription'] = 'subscription/view';
$route['subscription/(:any)'] = 'subscription/view/$1';

$route['rpg'] = 'rpg_list/view';
$route['rpg/(:any)'] = 'rpg_list/view/$1';
$route['list'] = 'rpg_list/view';
$route['list/(:any)'] = 'rpg_list/view/$1';
$route['rpg_list'] = 'rpg_list/view';
$route['rpg_list/(:any)'] = 'rpg_list/view/$1';

$route['new'] = 'rpg_creation/view';
$route['new/(:any)'] = 'rpg_creation/view/$1';
$route['create'] = 'rpg_creation/view';
$route['create/(:any)'] = 'rpg_creation/view/$1';
$route['creation'] = 'rpg_creation/view';
$route['creation/(:any)'] = 'rpg_creation/view/$1';
$route['rpg_creation'] = 'rpg_creation/view';
$route['rpg_creation/(:any)'] = 'rpg_creation/view/$1';
$route['rpg_creation'] = 'rpg_creation/view';
$route['rpg_creation/(:any)'] = 'rpg_creation/view/$1';



/* End of file routes.php */
/* Location: ./application/config/routes.php */