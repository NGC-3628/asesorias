<?php
namespace App\Repositories;
use App\Models\Poder;

class PoderRepository
{
    public function nuevoPoder(array $data){
        try{
            $poder = Poder::create ([
                "nombre" => $data["nombre"],
                "descripcion" => $data["descripcion"]
            ]);

            return $poder;

        }catch (Exception $e){
            return [
                "mensaje" => $e->getMessage()
            ];
        }
    }

    public function obtenerPoderes(){//
        try{
            $poderes = Poder::all();
            return $poderes;

        }
        catch (Exception $e){
            return [
                "mensaje" => $e->getMessage()
            ];
        }
    }
    public function updatePoder($id, array $data){
        try{
            $poder = Poder::find($id);

            $poder->update([
                "nombre" => $data["nombre"],
                "descripcion" => $data["descripcion"]
            ]);
            $poder->save();
            return "poder actualizado";

        }
        catch (Exception $e){
            return [
                "mensaje" => $e->getMessage()
            ];
        }
    }
}