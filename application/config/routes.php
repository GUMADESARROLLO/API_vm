<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'servicio_controllers';

$route['ARTICULOS'] = 'Servicio_controllers/Articulos';
$route['CLIENTES'] = 'Servicio_controllers/Clientes';
$route['vstCLA'] = 'Servicio_controllers/vstCLA';
$route['vtsArticulos'] = 'Servicio_controllers/vtsArticulos';
$route['vtsCliente'] = 'Servicio_controllers/vtsCliente';
//$route['vtsTotales'] = 'Servicio_controllers/vtsTotales';
$route['MvstCLA'] = 'Servicio_controllers/MvstCLA';
$route['Mcuotas'] = 'Servicio_controllers/Mcuotas';
$route['HstItemFacturados'] = 'Servicio_controllers/HstItemFacturados';
$route['LOTES'] = 'Servicio_controllers/LOTES';
$route['PUNTOS'] = 'Servicio_controllers/PUNTOS';

$route['MvtsArticulos'] = 'Servicio_controllers/MvtsArticulos';
$route['MvtsCliente'] = 'Servicio_controllers/MvtsCliente';
$route['Farmacias'] = 'Servicio_controllers/Farmacias';

$route['Llaves'] = 'Servicio_controllers/Llaves';
$route['DeleteFarmacia'] = 'Servicio_controllers/DeleteFarmacia';
$route['DeleteMedicos'] = 'Servicio_controllers/DeleteMedicos';
$route['ROUND'] = 'Servicio_controllers/ROUND';
$route['Especialidades'] = 'Servicio_controllers/Especialidades';
$route['Medicos'] = 'Servicio_controllers/Medicos';

$route['Logs'] = 'Servicio_controllers/Logs';




$route['Login'] = 'Servicio_controllers/Login';

$route['IUMedicos'] = 'Servicio_controllers/guardarCambiosMedicos';