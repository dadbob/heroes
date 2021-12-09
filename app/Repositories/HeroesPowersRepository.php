<?php

namespace App\Repositories;

use App\HeroesPowers;
use Illuminate\Support\Facades\DB;
use Exception;

class HeroesPowersRepository
{
    /**
     * @var HeroesPowers
     */
    protected $heroesPowers;

    /**
     * HeroesPowersRepository constructor.
     *
     * @param HeroesPowers $heroesPowers
     */
    public function __construct(HeroesPowers $heroesPowers)
    {
        $this->heroesPowers = $heroesPowers;
    }

    /**
     * Get all heroesPowerss.
     *
     * @return HeroesPowers $heroesPowers
     */
    public function getAll()
    {
        return $this->heroesPowers
            ->get();
    }

    /**
     * Get heroesPowers by id
     *
     * @param $hero_id
     * @return mixed
     */
    public function getByHeroId($hero_id)
    {
        return $this->heroesPowers
            ->where('hero_id', '=', $hero_id)
            ->get('power_id as id');
    }

    /**
     * Save Teams
     *
     * @param $data
     * @param $hero_id
     * @return HeroesPowers
     */
    public function save($data, $hero_id)
    {
        if(!empty($data['powers']))
        {
            foreach ($data['powers']['data'] as $team)
            {
                $heroesPowers = new $this->heroesPowers;

                $heroesPowers->forceFill([
                    'hero_id' => $hero_id,
                    'power_id' => $team['id'],
                ])->save();
            }

            return $this->heroesPowers->where('hero_id','=',$hero_id)->get('power_id as id');

        }
    }

    /**
     * Update Teams
     *
     * @param $data
     * @param $hero_id
     * @return HeroesPowers
     * @throws Exception
     */
    public function update($data, $hero_id)
    {
        if(!empty($data['powers']) && !empty($hero_id)) {

            DB::beginTransaction();
            try {

                $this->heroesPowers->where('hero_id','=',$hero_id)->delete();

                foreach ($data['powers']['data'] as $team)
                {
                    $heroesPowers = new $this->heroesPowers;

                    $heroesPowers->forceFill([
                        'hero_id' => $hero_id,
                        'power_id' => $team['id'],
                    ])->save();
                }

                DB::commit();

                return $this->heroesPowers->where('hero_id','=',$hero_id)->get('power_id as id');

            } catch (Exception $e) {
                DB::rollback();
                throw $e;
            }

        }

    }

    public function deleteByHero($hero_id)
    {
        if($hero_id) {
            $this->heroesPowers->where('hero_id', '=', $hero_id)->delete();
        }
    }

    /**
     * Update Teams
     *
     * @param $data
     * @return HeroesPowers
     */
    public function delete($id)
    {

        $heroesPowers = $this->heroesPowers->find($id);
        $heroesPowers->delete();

        return $heroesPowers;
    }

}
