<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

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

/* Location: ./application/config/routes.php */