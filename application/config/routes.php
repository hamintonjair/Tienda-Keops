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

/*tienda*/
$route['default_controller'] = 'tienda';
$route['login/logout'] = 'login/Logout';

$route['tienda'] = 'tienda/Tienda';

//carrito
$route['carrito'] = 'tienda/Carrito_compra';
$route['carrito/procesarpago'] = 'tienda/ProcesarPago';

$route['servicios'] = 'servicios/Services';
$route['contacto'] = 'contacto/Contact';
$route['nosotros'] = 'nosotros/Mas';
$route['vista'] = 'tienda/Ver';
$route['preguntas-frecuentes'] = 'tienda/Preguntas';


/*administrador*/
$route['login'] = 'login/Login';
$route['dashboard'] = 'administrador/Dashboard';
$route['roles'] = 'roles/Rol';
$route['dashboard/permisos'] = 'permisos/PermisosRol';
$route['configuracion'] = 'configuracion/Configuracion';
$route['fotos'] = 'fotos/Fotos';

$route['dashboard/editar'] = 'permisos/editar';

//usuario
$route['dashboard/usuarios'] = 'usuarios/VerUsuarios';
//cliente
$route['dashboard/clientes'] = 'Clientes/VerClientes';
//categorias
$route['dashboard/categorias'] = 'Categorias/VerCategorias';
//productos
$route['productos'] = 'Productos/VerProductos';
//pedidos
$route['pedidos'] = 'Pedidos/VerPedidos';
//suscriptores
$route['suscriptores'] = 'suscriptores/Suscriptor';
//contastos
$route['contactos'] = 'contactos/Contactos';
//sucursales
$route['sucursales'] = 'sucursales/Sucursales';
//paginas
$route['paginas'] = 'paginas/Paginas';
/**error */
$route['error'] = 'error_Page/Error_page';


$route['404_override'] = 'error_Page/Error_page';
$route['translate_uri_dashes'] = FALSE;
