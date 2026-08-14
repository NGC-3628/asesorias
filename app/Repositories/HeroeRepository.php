<?php

namespace App\Repositories;

use App\Models\Hero;

class HeroeRepository
{
    public function getAll()
    {
        return Hero::with(['rol', 'poderes'])->get();
    }

    public function find($id)
    {
        return Hero::with(['rol', 'poderes'])->find($id);
    }

    public function create(array $data)
    {
        $hero = Hero::create($data);

        if (isset($data['poderes']) && !empty($data['poderes'])) {
            $hero->poderes()->attach($data['poderes']);
        }

        return Hero::with(['rol', 'poderes'])->find($hero->id);
    }

    public function update($id, array $data)
    {
        $hero = Hero::findOrFail($id);
        $hero->update($data);

        if (isset($data['poderes'])) {
            $hero->poderes()->sync($data['poderes']);
        }

        return Hero::with(['rol', 'poderes'])->find($hero->id);
    }

    public function delete($id)
    {
        $hero = Hero::findOrFail($id);
        return $hero->delete();
    }

    public function addPoderes($id, array $poderes)
    {
        $hero = Hero::findOrFail($id);
        $hero->poderes()->attach($poderes);

        return Hero::with(['rol', 'poderes'])->find($hero->id);
    }

    public function getHeroesConMasDeUnPoder()
    {
        return Hero::has('poderes', '>', 1)
                   ->with(['rol', 'poderes'])
                   ->get();
    }
}