<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;

class empleados_controller extends Controller
{
    public function nuevo_empleado(Request $request){

        $id_empleado = DB::table('empleados')->insertGetId([
            'nombre' => $request['nombre'],
            'correo' => $request['correo'],
            'puesto' => $request['puesto'],
            'nacimiento' => $request['nacimiento'],
            'domicilio' => $request['domicilio'],
        ]);

        $habilidades = explode(",", $request['habilidad']);

        foreach ($habilidades as $habilidad) {
            $hab = explode("-", $habilidad);

            $insert = DB::table('habilidad')->insert([
                'nombre' => $hab[0],
                'id_empleado' => $id_empleado,
                'calificacion' => $hab[1],
            ]);
        }

        if ($insert) {
            return ['ok' => 100];
        } else {
            return ['ok' => 0];
        }
    }

    public function consulta_empleado(Request $request){

        $empleado = DB::table('empleados')
        ->select([
            'empleados.id',
            'empleados.nombre as nombre_empleado',
            'empleados.correo',
            'empleados.puesto',
            'empleados.nacimiento',
            'empleados.domicilio',
            'habilidad.nombre as nombre_habilidad',
            'habilidad.calificacion',
            ])
            ->join('habilidad', 'empleados.id', '=', 'habilidad.id_empleado')
            ->where([
                "empleados.id" => $request['id_empleado'],
            ])
            ->get();

        if ($empleado) {
            return ['ok' => 100, "datos" => $empleado];
        } else {
            return ['ok' => 0];
        }
    }

    public function consulta_empleados(Request $request){

        $empleados = DB::table('empleados')
            ->get();

        if ($empleados) {
            return ['ok' => 100, "datos" => $empleados];
        } else {
            return ['ok' => 0];
        }
    }
}
