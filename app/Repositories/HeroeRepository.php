<?php
namespace App\Repositories;

use App\Models\Hero;
use Exception;
use App\Repositories\PoderRepository;

class HeroeRepository {
    protected $PoderRepository;

    public function __construct(PoderRepository $PoderRepository){
        $this->PoderRepository = $PoderRepository;
    }


    public function createHero(array $data){
        try{
            $hero = Hero::create([
                "nombre" => $data["nombre"],
                "vida" => $data['vida'],
                "habilidad" => $data['habilidad'],
                "rol_id" => $data['rol_id']
            ]);

            $poderes = [];

            foreach($data["poderes"] as $poderData){
                
            $poder = $this->PoderRepository -> nuevoPoder([
                "nombre" => $poderData["nombre"],
                "descripcion" => $poderData["descripcion"]
            ]);

            $hero->poderes()->attach($poder->id);
            $poderes[] = $poder;
            }

            return [
                "heroe" => $hero,
                "poderes" => $poderes
            ];
        }
        catch(Exception $e){
            return [
                "mensaje" => $e->getMessage()
            ];
        }
    }

    public function listaHeroes(){
        try {
            $heroes = Hero::with(['poderes', 'rol'])->get();
            return $heroes;
        }
        catch(Exception $e){
            return [
                "mensaje" => $e->getMessage()
            ];
        }
    }

    // ! NEW
    // retorna heroe con mas de un poder
    public function OPheroe(){
        return Hero::with('poderes')->has('poderes', '>', 1)->get();
    }

    public function updateHero(int $id, array $data){
        try {
            $hero = Hero::find($id);
            $hero->update([
                "nombre" => $data['nombre'] ?? $hero->nombre,
                "vida" => $data['vida'] ?? $hero->vida,
                "habilidad" => $data['habilidad'] ?? $hero->habilidad
            ]);

            if(isset($data["poderes"])){
                foreach($data["poderes"] as $poderData){
                    $poder = $hero -> poderes() -> where("poderes.id", $poderData["id"])->first();
                    if($poder){
                        $poder->update([
                            "nombre" => $poderData["nombre"], "descripcion" => $poderData["descripcion"]
                        ]);
                    }
                }
            }

            return "heroe actualizado";

        }
        catch(Exception $e){
            return [
                "mensaje" => $e->getMessage()
            ];
        }
    }

    public function eliminarHero(int $id){
        try {
            $hero = Hero::find($id);
            $hero->delete();

            return "eliminado correctamente";
        }
        catch(Exception $e){
            return [
                "mensaje" => $e->getMessage()
            ];
        }
    }

}