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
$route['404_override'] = '';
$route['default_controller'] = "main";
$route['login'] = 'main/login';
$route['new_user/signup'] = 'main/signup';


$route['home'] = 'patient/home';
$route['explore'] = 'patient/explore';
$route['appointment'] = 'patient/appointment';
$route['appointmentv3'] = 'patient/appointmentv3';
$route['appointmentv4'] = 'patient/appointmentv4';
$route['view_allrejected_patient'] = 'patient/viewRejectedAppointments';


$route['home_doctor'] = 'doctor/home_doctor';
$route['makeAnnouncement_doctor'] = 'doctor/makeAnnouncement';
$route['manage_schedules'] = 'doctor/manage_schedules';
$route['manage_appointment'] = 'doctor/manage_appointment';
$route['manage_appointmentv2'] = 'doctor/manage_appointmentv2';
$route['view_appointment'] = 'doctor/view_appointment';
$route['view_allrejected_doctor'] = 'doctor/viewRejectedAppointments';
$route['generateToDoc'] = 'doctor/generateToDoc';
$route['viewAnnouncement'] = 'doctor/viewAnnouncement';

$route['makeAnnouncement'] = 'admin/makeAnnouncement';
$route['view_announcement'] = 'admin/view_announcement';
$route['add_user'] = 'admin/add_user';
$route['manage_user'] = 'admin/manage_user';
$route['add_clinic'] = 'admin/add_clinic';
$route['view_clinic'] = 'admin/view_clinic';


/* End of file routes.php */
/* Location: ./application/config/routes.php */