<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['dhys/admin/profile']                     = "dhys/admin/admin/profile";
$route['dhys/admin/dashboard']                   = "dhys/admin/admin/dashboard";
$route['dhys/admin/subscribers']                 = "dhys/admin/admin/subscribers";
$route['dhys/admin/admin-users']                 = "dhys/admin/admin/users";
$route['dhys/admin/admin-users/setup']           = "dhys/admin/admin/setup";
$route['dhys/admin/admin-users/setup/(:any)']    = "dhys/admin/admin/setup/$1";
$route['dhys/admin/admin-users/commit/(:any)']   = "dhys/admin/admin/commit/$1";
$route['dhys/admin/admin-users/commit']          = "dhys/admin/admin/commit";
$route['dhys/admin/forgot-password']             = "dhys/admin/admin/forgot_password";
$route['dhys/admin/site-settings']               = "dhys/admin/admin/site_settings";
$route['dhys/admin/reset-password/(:any)']       = "dhys/admin/admin/reset_password/$1";
$route['dhys/admin/logout']                      = "dhys/admin/admin/logout";
$route['dhys/admin/login']                       = "dhys/admin/admin/check_login";
$route['dhys/admin']                             = "dhys/admin/admin";

$route['car/search/(:num)']             = "car/search/$1";
$route['gallery']                       = "home/gallery";
//$route['age-gate']                      = "page/age_gate";
//$route['about-us']                      = "page/about-us";
$route['about-us']                      = "home/about-us";
$route['contact-us']                    = "home/contact-us";
$route['our-services']                  = "home/our-services";
$route['cancellation']                  = "home/cancellation";
$route['privacy-policy']                = "home/privacy-policy";
$route['terms']                         = "home/terms";

$route['page/(:any)']                   = "page/index/$1";
$route['default_controller']            = 'home';
$route['404_override']                  = 'home/notFound';
$route['translate_uri_dashes']          = TRUE;