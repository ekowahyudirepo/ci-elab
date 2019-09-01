<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['admin'] = 'admin/login';
$route['login'] = 'session/auth';
$route['default_controller'] = 'welcome';
$route['404_override'] = '404/home';
$route['translate_uri_dashes'] = FALSE;
