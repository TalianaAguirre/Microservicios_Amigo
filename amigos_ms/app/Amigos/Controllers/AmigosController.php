<?php
namespace App\Amigos\Controllers;

use App\Amigos\Models\Amigo;
use Exception;

class AmigosController {

    function getAmigos(){
        $rows = Amigos::all();
        return $rows->toJson();
    }
    
    function guardarAmigos($data){
        $amigo = new Amigos();
        $amigo->nombre = $data['nombre'];
        $amigo->apodo = $data['apodo'];
        $amigo->email = $data['email'];
        $amigo->telefono = $data['telefono'];
        $amigo->save();
        return $amigo->toJson();
    }

    function getAmigos($id){
        //$amigo = amigo::where('id', $id)->get()[0];
        $amigo = Amigos::find($id);
        if(empty($amigo)){
            throw new Exception("El amigo $id no existe", 1);
        }
        return $amigo;
    }

    function modificarAmigos($id, $data){
        $amigo = $this->getAmigos($id);
        $amigo->nombre = $data['nombre'];
        $amigo->apodo = $data['apodo'];
        $amigo->email = $data['email'];
        $amigo->telefono = $data['telefono'];
        $amigo->save();
        return $amigo;
    }

    function borrarAmigos($id){
        $amigo = $this->getAmigos($id);
        $amigo->delete();
    }
}