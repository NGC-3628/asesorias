<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HeroeRepository;
use App\Models\Hero;
use App\Http\Requests\heroesRequest\HeroCreateRequest;
use App\Http\Requests\heroesRequest\HeroUpdateRequest;


class HeroController extends Controller
{
    protected $HeroeRepository;
    
    public function __construct(HeroeRepository $HeroeRepository)
    {
        $this->HeroeRepository = $HeroeRepository;
    }
    public function index()
    {
        $heroes = $this->HeroeRepository->listaHeroes();

        return response()->json([
            "mensaje" => "lista de heroes",
            "data" => $heroes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HeroCreateRequest $request)
    {
         $hero = $this->HeroeRepository->createHero($request->validated());
        return response()->json([
            "mensaje" => "heroe registrado",
            "hero" => $hero
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HeroUpdateRequest $request, string $id)
    {
       $hero = $this->HeroeRepository->updateHero($id, $request->validated());
        return response()->json([
            "mensaje" => $hero
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hero = $this->HeroeRepository->eliminarHero($id);
        return response()->json([
            "mensaje" => $hero
        ]);
    }

    
    // ! NEW
    // METODOS QUE PIDIO KENEDIOS
    public function OPheroe(){
        $heroes = $this ->HeroeRepository->OPheroe();
        return response()->json([
            "mensaje" => "Heroes con mas de un poder (consulta)",
            "data" => $heroes
        ]);
    }

    public function agregarPoder(Request $request, int $id){
    $request->validate([
        "poderes" => "required|array|min:1",
        "poderes.*.nombre" => "required|max:30",
        "poderes.*.descripcion" => "required"
    ]);

    $resultado = $this->HeroeRepository->agregarPoder(
        $id,
        $request->all()
    );

    return response()->json([
        "mensaje" => $resultado
    ]);
}
}
