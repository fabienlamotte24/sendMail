<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Vues pour les entreprises
$route['changecompany/(:any)'] = 'entreprises/changecompany/$1';
$route['newcompany'] = 'entreprises/newcompany';
$route['listshow'] = 'entreprises/listshow';
$route['entreprises'] = 'entreprises/index';
$route['entreprises/(:any)'] = 'entreprises/index/$1';

$route['mails'] = 'mails/index';
$route['newmail'] = 'mails/new_mail';
$route['editmail/(:any)'] = 'mails/edit_mail/$1';

$route['default_controller'] = 'pages/view';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
