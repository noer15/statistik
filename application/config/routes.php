<?php
defined('BASEPATH') or exit('No direct script access allowed');


$route['default_controller'] = 'Login';
$route['signup'] = 'Login/signup';
$route['penyuluh/wilayah/(:num)'] = 'Wilayahpenyuluh/index/$1';
$route['unitkerja/wilayah/(:num)'] = 'Unitkerjawilayah/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
