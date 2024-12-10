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
$route['cancel_appointment/(:any)/(:any)'] = 'pages/cancel_appointment/$1/$2';
$route['appoint_admit/(:any)'] = 'pages/appoint_admit/$1';
$route['appoint_readmit/(:any)/(:any)'] = 'pages/appoint_readmit/$1/$2';
$route['admitpatient/(:any)'] = 'pages/admitpatient/$1';
$route['view_appointment/(:any)'] = 'pages/view_appointment/$1';
$route['search_appointment'] = 'pages/search_appointment';
$route['appointment'] = 'pages/appointment';
$route['upload_user_picture'] = 'pages/upload_user_picture';
$route['update_user_password'] = 'pages/update_user_password';
$route['update_user_profile'] = 'pages/update_user_profile';
$route['userprofile'] = 'pages/userprofile';
$route['print_rx/(:any)'] = 'pages/print_rx/$1';
$route['delete_rx/(:any)/(:any)'] = 'pages/delete_rx/$1/$2';
$route['add_rx'] = 'pages/add_rx';
$route['active_patient'] = 'pages/active_patient';
$route['patient_discharged/(:any)'] = 'pages/patient_discharged/$1';
$route['patientprofile/(:any)'] = 'pages/patientprofile/$1';
$route['patientdetails/(:any)'] = 'pages/patientdetails/$1';
$route['submitadmission'] = 'pages/submitadmission';
$route['re_admission/(:any)'] = 'pages/re_admission/$1';
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
