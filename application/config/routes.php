<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'Login';

$route['productos'] = 'productos/index';
$route['productos/nuevo'] = 'productos/nuevo';
$route['productos/guardar'] = 'productos/guardar';
$route['productos/editar/(:num)'] = 'productos/editar/$1';
$route['productos/actualizar/(:num)'] = 'productos/actualizar/$1';
$route['productos/eliminar/(:num)'] = 'productos/eliminar/$1';

$route['proveedores'] = 'productos/proveedores';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['stock'] = 'productos/stock';
$route['stock/actualizar'] = 'productos/actualizar_stock';


// PROVEEDORES

$route['proveedores'] = 'productos/proveedores';

$route['proveedores/nuevo'] = 'productos/nuevo_proveedor';

$route['proveedores/guardar'] = 'productos/guardar_proveedor';

$route['proveedores/editar/(:num)'] = 'productos/editar_proveedor/$1';

$route['proveedores/actualizar/(:num)'] = 'productos/actualizar_proveedor/$1';

$route['proveedores/eliminar/(:num)'] = 'productos/eliminar_proveedor/$1';

$route['login'] = 'login';
$route['login/ingresar'] = 'login/ingresar';
$route['login/salir'] = 'login/salir';

$route['registro'] = 'Registro/index';
$route['registro/guardar'] = 'Registro/guardar';