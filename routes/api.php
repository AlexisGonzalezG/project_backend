<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('nuevo_empleado','App\Http\Controllers\empleados_controller@nuevo_empleado');
Route::post('nueva_habilidad','App\Http\Controllers\empleados_controller@nueva_habilidad');

Route::post('consulta_empleados','App\Http\Controllers\empleados_controller@consulta_empleados');
Route::post('consulta_empleado','App\Http\Controllers\empleados_controller@consulta_empleado');
