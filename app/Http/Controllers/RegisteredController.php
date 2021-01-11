<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registered;


class RegisteredController extends Controller {
    public function index(){
        $registered = Registered::select(
            'ID', 'NOMBRES', 'APELLIDOS', 'IDENTIFICADOR', 'CORREO','REGISTRO PROPUESTA as PROPUESTA', 'TIPO DE PROPUESTA'
        )->orderBy('ID', 'Desc')->get();
        return $registered->toJson();
    }

    public function show($id){
        $investigador = Registered::where('ID', $id)
            ->select(
                'REGISTRO PROPUESTA as PROPUESTA', 'NOMBRES', 'APELLIDOS', 'IDENTIFICADOR', 'CORREO', 'ESTADO', 'MUNICIPIO', 'CELULAR', 'ESPECIALIDAD',
                 'ESTATUS PRODUCTO as ESTATUS', 'DESTINO PRODUCTO as DESTINO', 'LINEA DE INVESTIGACION as LineaInv', 
                 'MOTOR', 'AREA', 'SUB AREA as SubArea', 'RESUMEN'
            )->get();
        return $investigador;
    }
}
