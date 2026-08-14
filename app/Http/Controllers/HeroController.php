<?php

namespace App\Http\Controllers;

use App\Http\Requests\heroesRequest\HeroCreateRequest;
use App\Http\Requests\heroesRequest\HeroUpdateRequest;
use App\Repositories\HeroeRepository;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    protected $heroeRepository;

    public function __construct(HeroeRepository $heroeRepository)
    {
        $this->heroeRepository = $heroeRepository;
    }

    public function index()
    {
        $heroes = $this->heroeRepository->getAll();

        return response()->json([
            'mensaje' => 'Lista de héroes',
            'data' => $heroes
        ], 200);
    }

    public function show($id)
    {
        $hero = $this->heroeRepository->find($id);

        if (!$hero) {
            return response()->json([
                'mensaje' => 'Héroe no encontrado'
            ], 404);
        }

        return response()->json([
            'mensaje' => 'Detalle del héroe',
            'data' => $hero
        ], 200);
    }

    public function store(HeroCreateRequest $request)
    {
        $hero = $this->heroeRepository->create($request->validated());

        return response()->json([
            'mensaje' => 'Héroe registrado',
            'hero' => $hero
        ], 201);
    }

    public function update(HeroUpdateRequest $request, $id)
    {
        $hero = $this->heroeRepository->update($id, $request->validated());

        return response()->json([
            'mensaje' => 'Héroe actualizado',
            'hero' => $hero
        ], 200);
    }

    public function destroy($id)
    {
        $this->heroeRepository->delete($id);

        return response()->json([
            'mensaje' => 'Héroe eliminado'
        ], 200);
    }

    public function addPoderes(Request $request, $id)
    {
        $request->validate([
            'poderes' => 'required|array',
            'poderes.*' => 'exists:poderes,id'
        ]);

        $hero = $this->heroeRepository->addPoderes($id, $request->poderes);

        return response()->json([
            'mensaje' => 'Poderes agregados al héroe',
            'hero' => $hero
        ], 200);
    }

    public function heroesConMasDeUnPoder()
    {
        $heroes = $this->heroeRepository->getHeroesConMasDeUnPoder();

        return response()->json([
            'mensaje' => 'Lista de héroes con más de un poder',
            'data' => $heroes
        ], 200);
    }
}