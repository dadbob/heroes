<?php

namespace App\Repositories;

use App\Hero;

class HeroRepository
{
    /**
     * @var Hero
     */
    protected $hero;

    /**
     * HeroRepository constructor.
     *
     * @param Hero $hero
     */
    public function __construct(Hero $hero)
    {
        $this->hero = $hero;
    }

    /**
     * Get all heros.
     *
     * @return Hero $hero
     */
    public function getAll()
    {
        return $this->hero
            ->paginate(10);;
    }

    public function search($search_input)
    {
         return $this->hero->where(function($query) use ($search_input) {
            $query->where('real_name', 'like', '%' . $search_input . '%')
                ->orWhere('hero_name', 'like', '%' . $search_input . '%')
                ->orWhere('publisher', 'like', '%' . $search_input . '%');
        })->paginate(10);
    }


    /**
     * Get hero by id
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->hero
            ->where('id', $id)
            ->get();
    }

    /**
     * Save Hero
     *
     * @param $data
     * @return Hero
     */
    public function save($data)
    {
        $hero = new $this->hero;

        $hero->forceFill([
            'publisher' => @$data['publisher'],
            'real_name' => @$data['real_name'],
            'hero_name' => @$data['hero_name'],
            'appearance_at' => @$data['appearance_at'],
        ])->save();

        return $hero->fresh();
    }

    /**
     * Update Hero
     *
     * @param $data
     * @return Hero
     */
    public function update($data, $id)
    {
        $hero = $this->hero->find($id);

        $hero->forceFill([
            'publisher' => $data['publisher'],
            'real_name' => $data['real_name'],
            'hero_name' => $data['hero_name'],
            'appearance_at' => $data['appearance_at'],
        ])->save();

        return $hero;
    }

    /**
     * Update Hero
     *
     * @param $data
     * @return Hero
     */
    public function delete($id)
    {

        $hero = $this->hero->find($id);
        if($hero)
        {
            $hero->delete();

        }

        return $hero;
    }

}
