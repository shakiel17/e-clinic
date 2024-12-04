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
|	https://codeigniter.com/userguide3/general/routing.html
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
//start of admin route
$route['admin'] = 'pages/admin';
$route['adminmain'] = 'pages/adminmain';
$route['admin_authentication'] = 'pages/admin_authentication';
$route['admin_logout'] = 'pages/admin_logout';
$route['manage_doctor'] = 'pages/manage_doctor';
$route['manage_user'] = 'pages/manage_user';
$route['doctor_profile'] = 'pages/doctor_profile';

//start of user route
$route['submitadmission'] = 'pages/submitadmission';
$route['new_admission'] = 'pages/new_admission';
$route['user_logout'] = 'pages/user_logout';
$route['main'] = 'pages/main';
$route['authentication'] = 'pages/authentication';
$route['registration'] = 'pages/registration';
$route['register'] = 'pages/register';
$route['default_controller'] = 'pages/index';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
